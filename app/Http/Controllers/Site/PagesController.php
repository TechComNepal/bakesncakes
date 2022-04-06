<?php

namespace App\Http\Controllers\Site;

use App\Models\Blog;
use App\Models\Cart;
use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Qrcode;
use App\Models\Slider;
use App\Models\AboutUs;
use App\Models\Product;
use App\Models\Service;
use App\Models\Category;
use App\Models\Shipping;
use App\Models\Testimonial;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Models\PrivacyAndPolicy;
use App\Models\TermsAndCondition;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Mail\OrderConfirmationMail;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\CustomerShippingAddress;
use Illuminate\Support\Facades\Session;
use Spatie\Searchable\ModelSearchAspect;
use App\Notifications\UserOrderNotification;
use Illuminate\Support\Facades\Notification;

class PagesController extends Controller
{
    public function index()
    {
        $productCategories = Category::with('products')->where('status', 1)->orderBy('id', 'desc')->limit(7)->get();
        return view('site.new_index', [
        'categories'=> Category::where('featured', 1)->orderBy('id', 'desc')->paginate(16),
        'productCategories'=> $productCategories,
        'products'=>Product::orderBy('id', 'asc')->simplepaginate(72),
        'featured_products'=>Product::where('is_featured', 1)->orderBy('id', 'desc')->limit(5)->get(),
        'trending_products'=>Product::where('is_trending', 1)->orderBy('created_at', 'desc')->limit(3)->get(),
        //'top_selling_products'=>Product::where('top_selling', 1)->orderBy('id', 'desc')->limit(3)->get(),
        'best_selling_products'=>Product::where('best_selling', 1)->orderBy('id', 'desc')->limit(8)->get(),
        'recent_products'=>Product::orderBy('created_at', 'desc')->limit(3)->get(),
      'top_selling_products'=> Product::has('orders')
               ->withSum('orders', 'order_product.quantity')->OrderByDesc('orders_sum_order_productquantity')->limit(3)->get(),
       'rated_products'=> Product::has('ratings')
                 ->withAvg('ratings', 'rating')
                 ->OrderByDesc('ratings_avg_rating')
                 ->limit(3)
                 ->get(),
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
        return view('site.pages.new_about_us', [
        'about'=> AboutUs::first(),
    ]);
    }
    public function contactus()
    {
        return view('site.pages.new_contact_us');
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
        $gallerys=$product->getMedia('gallery_image')->take(4);
        return [
            'modal_view' => view('site._layouts._partials.quickView', compact('product', 'gallerys'))->render(),
        ];
    }

    public function blog()
    {
        return view('site.pages.new_blog', [
        'blogs'=> Blog::orderBy('id', 'desc')->paginate(9)
            ,
            ]);
    }

    /* vendors */
    public function vendor()
    {
        $paginator = User::paginate(8);

        return view('site.pages.vendor', [
            'vendors' => User::role('vendor')->get(),
            'paginator' => $paginator
        ]);
    }
    public function vendor_guide()
    {
        return view('site.pages.vendor_guide');
    }

    public function singleBlog($slug)
    {
        return view('site.pages.new_single_blog', [
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

    
    public function newCheckout(Request $request)
    {
//        dd($request->all());
        DB::beginTransaction();
        if ($request->payment != null) {
            $carts = Cart::where('user_id', Auth::user()->id)->get();

            if ($carts->isEmpty()) {
                DB::rollback();
                return redirect()->route('site.page')->with(['error' => 'Your Cart is empty']);
            }

            $address = CustomerShippingAddress::where('id', $carts[0]['address_id'])->first();

            $seller_products = array();
            $shipping = 0;
            $total = 0;
            $couponDiscount = 0;
            $final_billing_total=0;

            foreach ($carts as $cartItem) {
                $product_ids = array();
                $product = Product::find($cartItem['product_id']);
                if (isset($seller_products[$product->user_id])) {
                    $product_ids = $seller_products[$product->user_id];
                }
                array_push($product_ids, $cartItem);
                $seller_products[$product->user_id] = $product_ids;

                $product_shipping_cost = $cartItem->shipping_cost;
                $shipping += $product_shipping_cost;
                $total = $total + ($cartItem->price + $cartItem->tax) * $cartItem->quantity;
            }
            $mail_details=[];

            foreach ($seller_products as $key=>$seller_product) {
                $order = new Order();
                $order->order_code = 'ORD'.date('Ymd-His') . rand(10, 99);
                $order->user_id = Auth::user()->id;
                $order->billing_email = Auth::user()->email;
                $order->delivery_charge = $shipping;
                $order->payment_method = $request->payment;
                $order->billing_total = $total;
                $order->shipping_address = json_encode($address);
                $order->coupon_discount = $couponDiscount;
                $order->save();

                $subtotal = 0;
                $tax = 0;
                $shipping = 0;
                $coupon_discount = 0;

                //Order Product Storing
                foreach ($seller_product as $cartItem) {
                    $product = Product::find($cartItem['product_id']);

                    $subtotal += $cartItem['price'] * $cartItem['quantity'];
                    $tax += $cartItem['tax'] * $cartItem['quantity'];
                    $coupon_discount += $cartItem['coupon_discount'];


                    $product_stock = $product->where('id', $product->id)->where('quantity', '>', 0)->first();
                    if ($cartItem['quantity'] > $product_stock->quantity) {
                        $order->delete();
                        return redirect()->route('cart.index')->withErrors('The requested quantity is not available for' . $product->name);
                    } else {
                        $product_stock->quantity -= $cartItem['quantity'];
                        $product_stock->save();
                    }

                    $order_detail = new OrderProduct();
                    $order_detail->order_id = $order->id;
                    $order_detail->product_id = $product->id;
                    $order_detail->user_id = Auth::user()->id;
                    $order_detail->price = $cartItem['price'] * $cartItem['quantity'];
                    $order_detail->quantity = $cartItem['quantity'];
                    $order_detail->tax = $cartItem['tax'] * $cartItem['quantity'];
                    $order_detail->total = ($cartItem->price + $cartItem->tax) * $cartItem->quantity;
                    $order_detail->status = true;
                    $order_detail->user_note = $cartItem->user_note;
                    $order_detail->delivery_date = $cartItem->delivery_date;

//                    $order_detail->seller_id = $product->user_id;

//                    $order_detail->shipping_cost = $cartItem['shipping_cost'];

//                    $shipping += $order_detail->shipping_cost;
                    $shipping += $cartItem['shipping_cost'];
                    //End of storing shipping cost

                    $order_detail->save();

                    $product->save();

                    $order->seller_id = $product->user_id;
                }



                $order->billing_total = $subtotal + $tax + $shipping;

                $order->coupon_discount = $coupon_discount;
                $order->billing_total -= $coupon_discount;
                $order->delivery_charge = $shipping;
                $order->save();
                $final_billing_total += $order->billing_total;
                $mail_details[$key]=[
                        'order_code'=>$order->order_code,
                        'billing_total'   => $order->billing_total,
                        'delivery_address' => $address->delivery_address,
                        'final_billing_total'=>$final_billing_total,
                    ];
               

                //Admin Notification
                $admins=User::role(['admin','superadmin'])->get();
                Notification::send($admins, new UserOrderNotification($order));
            }
            Mail::to(Auth::user()->email)->send(new OrderConfirmationMail($mail_details));

          

            foreach ($carts as $cart) {
                Cart::destroy($cart->id);
            }
           

            DB::commit();
            return redirect()->route('site.page')->with(['success' => 'Your order has been placed successfully.']);
        } else {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Select Payment Options']);
        }
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
