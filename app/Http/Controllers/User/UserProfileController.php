<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\ProfileUpdateRequest;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;

class UserProfileController extends Controller
{
    public function index()
    {
        $user=auth()->user();
        $shippings = Shipping::all();
        $this->setPageTitle('User Profile', '');
        return view('cms.users.profiles.new_index', compact('user', 'shippings'));
    }

    public function update(User $user, ProfileUpdateRequest $request)
    {
        try {
            $collection= collect($request->validated())->except('avatar');

            $user->update($collection->all());
        } catch (\Throwable $exception) {
            return response($exception->getMessage());
        }


        return redirect()->route('user.profiles.index')->with('success', 'User Profile Updated Successfully');
    }


    public function changePassword(Request $request)
    {
        $user = auth()->user();

        $userPassword = $user->password;

        if (!Hash::check($request->current_password, $userPassword)) {
            return back()->withErrors(['current_password'=>'password doesnot match']);
        }

        $request->validate([
            'current_password' => 'required',
            'password'=>['required',
            Password::min(8)->letters()->numbers()->mixedCase()->symbols()->uncompromised() ],
            'confirm_password' => 'required|same:password',
        ]);


        if (strcmp($request->current_password, $request->password)==0) {
            return back()->withErrors(['password'=>'current password and new password cannot be same']);
        }

        $user->password= $request->password;
        if ($user->save()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('auth.login.show')->with('success', 'Password Updated Successfully');
        } else {
            return back()->withErrors(['password'=>'Oops! Some problem occured. Please try again later.']);
        }
    }

    public function changeAvatar(Request $request)
    {
        if (Auth::check()) {
            if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
                try {
                    $user = User::findOrFail(Auth::user()->id);
                    $user->addMediaFromRequest('avatar')->preservingOriginal()->toMediaCollection('avatars');
                } catch (FileDoesNotExist | FileIsTooBig $e) {
                    return redirect()->back()->withErrors('File size too big or there was some issue with upload. Please try again.');
                }
            }
            return redirect()->back()->withSuccess('Avatar has been updated successfully.');
        } else {
            return redirect(route('auth.login.show'))->withErrors('Please Login first.');
        }
    }
}
