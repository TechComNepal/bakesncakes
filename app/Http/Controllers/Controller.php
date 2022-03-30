<?php

namespace App\Http\Controllers;

use App\Traits\FlashMessage;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    use FlashMessage;

    protected function setPageTitle($title, $subTitle = null)
    {
        view()->share(['pageTitle' => $title , 'subTitle' => $subTitle]);
    }

    protected function showErrorPage($errorCode = 404, $message = null): Response
    {
        $data['message'] = $message;

        return response()->view('errors.' . $errorCode, $data, $errorCode);
    }

    protected function responseJson($error = true, $responseCode = 200, $message = [], $data = null): JsonResponse
    {
        return response()->json([
            'error' => $error,
            'response_code' => $responseCode,
            'message' => $message,
            'data' => $data
        ]);
    }

    protected function responseRedirect($route, $message, $type = 'info', $error = false, $withOldInputWhenError = false): RedirectResponse
    {
        $this->setFlashMessage($message, $type); // Setting the flash Message.
        $this->showFlashMessages();              // Showing the Flash message which are actually setting the messages to session.

        // If there is an error with input, return else, redirect to the route provided.
        return ($error && $withOldInputWhenError)
            ? redirect()->back()->withInput()
            : redirect()->route($route);
    }

    protected function responseRedirectBack($message, $type = 'info', $error = false, $withOldInputWhenError = false): RedirectResponse
    {
        $this->setFlashMessage($message, $type);
        $this->showFlashMessages();

        return redirect()->back();
    }

    protected function responseBackWithException($throwable, $message = 'Something went wrong. Please try again.'): RedirectResponse
    {
        return back()->with('custom-error', $message)->with('console-log', $throwable->getMessage());
    }
}
