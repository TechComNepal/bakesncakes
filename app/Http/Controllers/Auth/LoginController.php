<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class LoginController extends Controller
{
    public function show()
    {
        $this->setPageTitle('Login', '');
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $request->validated();
        $credentials = $request->getCredentials();

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            $user = Auth::getProvider()->retrieveByCredentials($credentials);

            Auth::login($user);

            return $this->authenticated($request, $user)
                ?: redirect()->intended();
        }
        return redirect()->to('login')->with(['email' => 'Authentication Failed.']);
    }

    private function authenticated(Request $request, $user)
    {
        if ($user->hasRole('admin')) {
            return redirect()->intended(route('admin.dashboard'));
        }

        if ($user->hasRole('user')) {
            return redirect()->intended(route('user.dashboard'));
        }

        if ($user->hasRole('vendor')) {
            return redirect()->intended(route('vendor.dashboard'));
        }

        return redirect()->intended(route('employee.dashboard'));
    }
}
