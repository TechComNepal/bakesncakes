<?php

namespace App\Http\Controllers\Employee;

use App\Contracts\Profiles\AdminProfileContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private $imageUploadService;
    private $adminProfileRepository;
    public function __construct(AdminProfileContract $adminProfileRepository, ImageUploadService $imageUploadService)
    {
        $this->adminProfileRepository=$adminProfileRepository;
        $this->imageUploadService=$imageUploadService;
    }

    public function index()
    {
        $this->setPagetitle('Profile', '');
        $user=auth()->user();
        return view('cms.employees.profiles.index', compact('user'));
    }

    public function update(User $user, ProfileUpdateRequest $request)
    {
        try {
            $user=$this->adminProfileRepository->updateProfile($user->id, $request->validated());
            if ($user) {
                $this->imageUploadService->uploadImageFromRequest($request, $user, 'avatar', 'avatars');
            }
        } catch (\Throwable $exception) {
            return $this->responseBackWithException($exception);
        }
        return $this->responseRedirect('employee.profiles.index', 'Profile Updated Successfully Created.', 'success');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user=Auth::user();
        $userPassword=$user->password;

        $request->validated();
        if (!Hash::check($request->current_password, $userPassword)) {
            return back()->withErrors(['current_password'=>'password doesn\'t match']);
        }
        if (strcmp($request->current_password, $request->password)==0) {
            return back()->withErrors(['password'=>'current password and new password cannot be same']);
        }
        $user->password=$request->password;
        if ($user->save()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('auth.login.show')->with('success', 'Password Updated Successfully');
        }
    }
}
