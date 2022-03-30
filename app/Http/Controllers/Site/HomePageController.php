<?php

namespace App\Http\Controllers\Site;

use App\Models\Blog;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Spatie\Searchable\ModelSearchAspect;
use Spatie\Searchable\Search;

class HomePageController extends Controller
{
    public function index()
    {
        return view('site.new_index', [
        'categories'=> Category::where('featured', 1)->where('status', 1)->limit(4)->orderBy('id', 'desc')->get(),
        'products'=> Product::all(),
        'blogs'=> Blog::limit(3)->orderBy('id', 'desc')->get(),
        ]);
    }



}
