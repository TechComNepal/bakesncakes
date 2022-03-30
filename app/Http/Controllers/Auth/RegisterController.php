<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\RegistrationSuccess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use Laravel\Socialite\Facades\Socialite;

class RegisterController extends Controller
{
    public function show()
    {
        $this->setPageTitle('Regsiter');
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::create($request->validated());
            $user->assignRole('user');

            auth()->login($user);

            auth()->user()->sendEmailVerificationNotification();
            Mail::to($user->email)->send(new RegistrationSuccess());
            event(new Registered($user));

            return redirect()->route('site.page')->with('success', "Account successfully registered.");
        });
        return redirect()->back()->with('errors', 'There was problem with server. Please try again later.');
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->with(["prompt" => "select_account"])->redirect();
    }


    public function callback($provider)
    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();

            $finduser = User::where('email', $user->getEmail())->first();

            if ($finduser) {
                Auth::login($finduser, true);

                return redirect()->intended(route('homepage'));
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'username' => $user->name,
                    'email' => $user->email,
                    'provider_id' => $user->getId(),
                    'provider' => $provider,
                    'password' => Hash::make($user->name),
                ]);
                $newUser->assignRole('user');
                event(new Registered($user));


                Auth::login($newUser, true);

//                auth()->user()->sendEmailVerificationNotification();
//                Mail::to($user->email)->send(new RegistrationSuccess());

                return redirect()->intended(route('site.page'));
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
