<?php

namespace App\Http\Controllers\Site;

use App\Models\User;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function singleProductShow($slug)
    {
        $product=Product::find($slug);
        $gallerys=$product->getMedia('gallery_image')->take(4);
        // //  $vendor=User::where('user_id', $product->user_id)->first();

        // // $vendor->withAvg('ratings','rating')
        // $vendor= User::where('id', $product->user_id)->withAvg('ratings', 'rating')->get();
       
        $user_rating=Rating::where('user_id', Auth::id())->where('rateable_id', $product->id)->first();
        return view('site.pages.products.new_singleProduct', [
            'singleProduct'=> $product->with(['ratings.user','media','user'])->where('id', $slug)->FirstOrFail(),
            'products'=> $product->where('category_id', $product->category_id)->get(),
            'gallerys'=>$gallerys,
            'user_rating'=>$user_rating,
            // 'vendor'=>$vendor,
            ]);
    }


    public function allProductShow()
    {
        return view('site.pages.products.allProduct', [
                    'categories' => Category::where('status', true)->limit(7)->orderBy('id', 'asc')->get(),
                    'products' => Product::limit(7)->orderBy('id', 'asc')->get(),
                    // 'products' => Product::all(),

                       
                   
                    ]);
    }
}
