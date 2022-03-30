<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutUsUpdateRequest;
use App\Http\Requests\PrivacyAndPolicyUpdateRequest;
use App\Http\Requests\TermsAndConditionUpdateRequest;
use App\Services\ImageUploadService;

use App\Models\AboutUs;
use App\Models\PrivacyAndPolicy;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    
    private $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    public function termsAndConditionSetting()
    {
        $termsAndCondition = TermsAndCondition::first();
        $this->setPageTitle('Terms And Condition', 'Plase Fill in the required field.');
        return view('cms.admin.pages.termsAndCondition', compact('termsAndCondition'));
    }

    public function termsAndConditionUpdate(TermsAndConditionUpdateRequest $request)
    {

        try {
            $termsAndCondition = TermsAndCondition::firstOrFail();
           if ($termsAndCondition) {
                $this->imageUploadService->uploadImageFromRequest($request, $termsAndCondition, 'image', 'image');
            }
            return $termsAndCondition->update($request->validated())
            ? $this->responseRedirect('admin.termsAndCondition.setting', 'Terms and Condition Successfully Updated.', 'success')
            : $this->responseRedirectBack('Error Occured while Updating Terms And Condition .', 'error');
            } catch (\Throwable $exception) {
            return $exception->getMessage();
        }
       
    }


    public function privacyAndPolicySetting()
    {

        $privacyAndPolicy = PrivacyAndPolicy::first();
        $this->setPageTitle('Privacy And Policy', 'Plase Fill in the required field.');
        return view('cms.admin.pages.privacyAndPolicy', compact('privacyAndPolicy'));
    }

    public function privacyAndPolicyUpdate(PrivacyAndPolicyUpdateRequest $request)
    {
          try {
            
            $privacyAndPolicy = PrivacyAndPolicy::firstOrFail();
            if ($privacyAndPolicy) {
                $this->imageUploadService->uploadImageFromRequest($request, $privacyAndPolicy, 'image', 'image');
            }
           return $privacyAndPolicy->update($request->validated())
            ? $this->responseRedirect('admin.privacyAndPolicy.setting', 'Privacy and policy Successfully Updated.', 'success')
            : $this->responseRedirectBack('Error Occured while Updating Terms And Condition .', 'error');
            } catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }

    public function aboutUsSetting()
    {
        $aboutUs = AboutUs::first();
        $this->setPageTitle('About','Plase Fill in the required field.');
        return view('cms.admin.pages.aboutUs', compact('aboutUs'));
    }

    public function aboutUsUpdate(AboutUsUpdateRequest $request )
    {

        try {
            
            $aboutUs = AboutUs::firstOrFail();
            if ($aboutUs) {
                $this->imageUploadService->uploadImageFromRequest($request, $aboutUs, 'image', 'image');
            }
            return $aboutUs->update($request->validated())
            ? $this->responseRedirect('admin.aboutUs.setting', 'About Us Successfully Updated.', 'success')
            : $this->responseRedirectBack('Error Occured while Updating Terms And Condition .', 'error');
    } catch (\Throwable $exception) {
            return $exception->getMessage();
        }
        
      
    }
}
