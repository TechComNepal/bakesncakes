<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationController extends Controller
{
    public function showVerifyEmail()
    {
        $this->setPageTitle('Verify Email', '');
        return view('auth.verify-email');
    }


    public function verifyRequestLink(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('homepage');
    }

    public function requestNewVerificationLink()
    {
        auth()->user()->sendEmailVerificationNotification();

        return back()
            ->with('success', 'Verification link sent!');
    }
}
