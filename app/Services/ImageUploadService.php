<?php


namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class ImageUploadService
{
    public function uploadImageFromRequest(Request $request, Model $model, string $requestParam = 'image_url', string $collection=''): void
    {
        if ($request->has($requestParam) && $request[$requestParam] != null) {
            $imagePath = explode(config('app.url').'/', $request[$requestParam]);
            try {
                $model->addMedia(public_path($imagePath[1]))
                    ->preservingOriginal()
                    ->toMediaCollection($collection);
            } catch (FileCannotBeAdded $e) {
                abort(413, 'File size to big or there was some issue with the upload. Please try again later.' . $e->getMessage());
            }
        }
    }

    public function uploadFromRequest(Request $request, Model $model, string $filename, string $collection): void
    {
        if ($request->hasFile($filename) && $request->file($filename)->isValid()) {
            try {
                $model->addMediaFromRequest($filename)
                    ->preservingOriginal()
                    ->toMediaCollection($collection);
            } catch (FileDoesNotExist | FileIsTooBig $e) {
                abort(413, 'File size is too big or there was some issue with the upload. Please try again later.');
            }
        }
    }

    public function uploadMultipleMediaFromRequest(Request $request, Model $model, string $requestParam = 'images', string $collection=''): void
    {
        if ($request->has($requestParam) && $request[$requestParam] != null) {
            $gallery_image_urls = explode(',', $request[$requestParam]);
            foreach ($gallery_image_urls as $gallery_image_path) {
                $imagePath = explode(config('app.url').'/', $gallery_image_path);
                try {
                    $model->addMedia(public_path($imagePath[1]))
                        ->preservingOriginal()
                        ->toMediaCollection($collection);
                } catch (FileCannotBeAdded $e) {
                    abort(413, 'File size is too big or there was some issue with the upload. Please try again later.');
                }
            }
        }
    }
}
