<?php

namespace App\Http\Controllers\Site;

use App\Models\Blog;
use App\Models\Cart;
use App\Models\Brand;
use App\Models\Qrcode;
use App\Models\Slider;
use App\Models\AboutUs;
use App\Models\Product;
use App\Models\Service;
use App\Models\Category;
use App\Models\Shipping;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Models\PrivacyAndPolicy;
use App\Models\TermsAndCondition;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerShippingAddress;
use Illuminate\Support\Facades\Session;
use Spatie\Searchable\ModelSearchAspect;

class PagesController extends Controller
{
    public function index()
    {
        $productCategories = Category::with('products')->where('status', 1)->orderBy('id', 'desc')->limit(7)->get();
        return view('site.new_index', [
        'categories'=> Category::where('featured', 1)->orderBy('id', 'desc')->paginate(16),
        'productCategories'=> $productCategories,
        'products'=>Product::orderBy('id', 'asc')->simplepaginate(72),
        'featured_products'=>Product::where('is_featured', 1)->orderBy('id', 'desc')->limit(3)->get(),
        'trending_products'=>Product::where('is_trending', 1)->orderBy('created_at', 'desc')->limit(8)->get(),
        'top_selling_products'=>Product::where('top_selling', 1)->orderBy('id', 'desc')->limit(3)->get(),
        'best_selling_products'=>Product::where('best_selling', 1)->orderBy('id', 'desc')->limit(5)->get(),
        'recent_products'=>Product::orderBy('created_at', 'desc')->limit(3)->get(),
        'services'=> Service::all(),
        'testimonials'=>Testimonial::all(),
        'blogs'=> Blog::limit(3)->orderBy('id', 'desc')->get(),
        'sliders'=>Slider::with('media')->where('status', true)->orderBy('created_at', 'desc')->get(),
        ]);
    }


    public function autoSearch(Request $request)
    {
        $data = Product::select("name")->where("name", 'LIKE', "%{$request->terms}%")->paginate(1);
        return response()->json($data);
    }

    public function aboutus()
    {
        return view('site.pages.aboutus', [
        'about'=> AboutUs::first(),
    ]);
    }
    public function contactus()
    {
        return view('site.pages.contactus');
    }

    public function termsAndCondition()
    {
        return view('site.pages.termsAndCondition', [
        'termsAndCondition'=> TermsAndCondition::first(),
        ]);
    }

    public function privacyAndPolicy()
    {
        return view('site.pages.privacyAndPolicy', [
        'privacyAndPolicy'=> PrivacyAndPolicy::first(),
        ]);
    }


    public function quickView(Request $request)
    {
        $product = Product::findOrFail($request->id);
        return [
            'modal_view' => view('site._layouts._partials.quickView', compact('product'))->render(),
        ];
    }

    public function blog()
    {
        return view('site.pages.blog', [
        'blogs'=> Blog::orderBy('id', 'desc')->paginate(9)
            ,
            ]);
    }

    public function singleBlog($slug)
    {
        return view('site.pages.singleBlog', [
            'blog'=>Blog::where('slug', $slug)->firstOrFail(),
            'blogs'=> Blog::orderBy('id', 'desc')->limit(5)->get(),
            'categories'=> Category::orderBy('id', 'desc')->limit(5)->get(),

            ]);
    }


    public function Service()
    {
        return view('site.pages.service', [
            'services'=> Service::orderBy('id', 'desc')->paginate(9),
            ]);
    }


    public function singleService($slug)
    {
        return view('site.pages.singleService', [
            'service'=> Service::where('slug', $slug)->firstOrFail(),
            'services'=> Service::orderBy('id', 'desc')->get(),
            ]);
    }

    public function checkout()
    {
        if (!is_null(auth()->user())) {
            if (request()->session()->get('tmp_user_id')) {
                Cart::where('tmp_user_id', request()->session()->get('tmp_user_id'))
                    ->update([
                        'user_id' => auth()->user()->id,
                        'tmp_user_id' => null
                    ]);
                Session::forget('tmp_user_id');
            }

            $carts = Cart::where('user_id', Auth::user()->id)->get();
            $shipping_address = CustomerShippingAddress::where('user_id', Auth::user()->id)->first();
            $shippings = Shipping::all();
            $qrcode=Qrcode::first();

            return view('site.checkouts.index', compact('carts', 'shipping_address', 'shippings', 'qrcode'));
        }
        return redirect(route('auth.login.show'));
    }

    public function search(Request $request): View
    {
        $this->setPageTitle('Search');

        $request->validate([
            'query' => 'required|string',
        ]);

        $searchResults = (new Search())
            ->registerModel(Product::class, function (ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect->addSearchableAttribute('name')
                    ->with('media');
            })
            ->registerModel(Category::class, 'name')
            ->registerModel(Brand::class, 'name')
            ->perform($request['query']);

        return view('site.search.index', [
            'searchResults' => $searchResults,
        ]);
    }
}
