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
        return view('site.pages.categories.index', compact('categories','products'));
    }

    public function getCategoryProducts($slug){
        return view('site.pages.categories.all_products', compact('slug'));
    }




}
