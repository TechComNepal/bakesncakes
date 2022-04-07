<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SiteCategoryController extends Controller
{

    public function categoryShow(Request $request)
    {
        
        $categories = Category::where('parent_id', Null)->limit(8)->OrderBy('id', 'desc')->get();
        $products = Product::orderBy('id', 'desc')->paginate(8);
        $trending_products = Product::where('is_trending', 1)->orderBy('created_at', 'desc')->limit(4)->get();
        $featured_products = Product::orderBy('created_at', 'desc')->get();
        $new_products = Product::orderBy('created_at', 'desc')->limit(4)->get(); 
        
        return view('site.pages.categories.new_index', compact('categories','products','trending_products','featured_products', 'new_products'));
    }

    public function getCategoryProducts($slug){
        
        return view('site.pages.categories.all_products', compact('slug'));
    }




}
