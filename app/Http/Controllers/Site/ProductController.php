<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function singleProductShow($slug)
    {
        $product=Product::find($slug);
        $gallerys=$product->getMedia('gallery_image')->take(4);

        $user_rating=Rating::where('user_id', Auth::id())->where('rateable_id', $product->id)->first();
        return view('site.pages.products.singleProduct', [
            'singleProduct'=> $product->with(['ratings'])->where('id', $slug)->FirstOrFail(),
            'products'=> $product->where('category_id', $product->category_id)->get(),
            'gallerys'=>$gallerys,
            'user_rating'=>$user_rating,
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
