<?php

namespace App\Http\Controllers\Site;

use App\Models\User;
use App\Models\CustomOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use App\Notifications\UserCustomOrder;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\CustomOrderStoreRequest;
use App\Http\Requests\CustomOrdersStoreRequest;

class CustomOrderController extends Controller
{
    public function store(CustomOrdersStoreRequest $request)
    {
        // dd($request->all());
        try {
            $collection=collect($request->validated())->except('gallery_image');
            $customOrder=CustomOrder::create($collection->all());
            $admins=User::role(['admin','superadmin'])->get();
            Notification::send($admins, new UserCustomOrder($customOrder));


            if ($request->hasFile('gallery_image')) {
                foreach ($request->file('gallery_image') as $photo) {
                    $customOrder->addMedia($photo)->toMediaCollection('gallery_image');
                }
            }
 

         
            return redirect()->route('site.page')->with('success', 'Thank you for your Custom Order, We promise to respond to you as quickly as we can.!');
        } catch (\Throwable $exception) {
            return $exception->getMessage();
        }
    }
}
