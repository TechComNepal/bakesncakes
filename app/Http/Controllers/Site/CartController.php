<?php

namespace App\Http\Controllers\Site;

use PDO;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index(Request $request)
    {
        if (!is_null(auth()->user())) {
            $user_id = Auth::user()->id;
            if ($request->session()->get('tmp_user_id')) {
                Cart::where('tmp_user_id', $request->session()->get('tmp_user_id'))
                    ->update([
                        'user_id' => $user_id,
                        'tmp_user_id' => null
                    ]);

                Session::forget('tmp_user_id');
            }
            $carts = Cart::where('user_id', $user_id)->get();
        } else {
            $tmp_user_id = $request->session()->get('tmp_user_id');
            $carts = ($tmp_user_id != null) ? Cart::where('tmp_user_id', $tmp_user_id)->get() : [] ;
        }

        return view('site.carts.new_index', compact('carts'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->id);
        $carts = [];
        $data = [];
        if (Auth::user() != null) {
            $user_id = Auth::user()->id;
            $data['user_id'] = $user_id;
            $carts = Cart::where('user_id', $user_id)->where('product_id', $request->id)->get();
        } else {
            if ($request->session()->get('tmp_user_id')) {
                $tmp_user_id = $request->session()->get('tmp_user_id');
            } else {
                $tmp_user_id = bin2hex(random_bytes(10));
                $request->session()->put('tmp_user_id', $tmp_user_id);
            }
            $data['tmp_user_id']= $tmp_user_id;
            $carts= Cart::where('tmp_user_id', $tmp_user_id)->where('product_id', $product->id)->get();
        }
        $data['product_id'] = $product->id;
       
        $tax = 0;
        $price=$product->selling_price;

        //minimun purchase unit
        if ($request->quantity < $product->min_purchase_unit) {
            return [
                'status' => 0,
                'cart_count' => count($carts),
                'modal_view' => view('site._layouts._partials.minQtyNotSatisfied', [ 'min_qty' => $product->min_purchase_unit ])->render(),
                'nav_cart_view' => view('site._layouts._partials._new_partials.new_cart')->render(),
            ];
        }

        if ($product->discount !== 0) {
            if ($product->discount_type=='flat') {
                $price-=$product->discount;
            } elseif ($product->discount_type=='percent') {
                $discount=($product->discount/100)*$product->selling_price;
                $price-=$discount;
            }
        }
        if ($product->is_taxable == true) {
            if ($product->tax_type=='percent') {
                $tax += ($price*$product->tax_amount)/100;
            } elseif ($product->tax_type=='flat') {
                $tax+= $product->tax_amount;
            }
        }
        $data['quantity']=$request->quantity;
        $data['delivery_date']=$request->delivery_date;
        $data['user_note']=$request->user_note;
        $data['price']=$price;
        $data['tax']=$tax;

        if ($carts && count($carts) > 0) {
            foreach ($carts as $key => $cartItem) {
                if (($product->quantity < ($cartItem['quantity'] + $request['quantity']))) {
                    return [
                        'status' => 0,
                        'cart_count' => count($carts),
                        'modal_view' => view('site._layouts._partials.outOfStockCart')->render(),
                        'nav_cart_view' => view('site._layouts._partials._new_partials.new_cart')->render(),
                    ];
                }

                $cartItem['quantity'] += $request['quantity'];
                $cartItem->save();
            }
        } else {
            if ($product->quantity < $request['quantity']) {
                return [
                    'status' => 0,
                    'cart_count' => count($carts),
                    'modal_view' => view('site._layouts._partials.availableProductLessThanRequested', [ 'available_product' => $product->quantity ])->render(),
                     'nav_cart_view' => view('site._layouts._partials._new_partials.new_cart')->render(),

                ];
            } else {
                Cart::create($data);
            }
        }
        return [
            'status' => 1,
            'cart_count' => count($carts),
            'modal_view' => view('site._layouts._partials.addedToCart', compact('product', 'data'))->render(),
             'nav_cart_view' => view('site._layouts._partials._new_partials.new_cart')->render(),
        ];
    }

    public function removeFromCart(Request $request)
    {
        Cart::destroy($request->id);
        if (auth()->user()!= null) {
            $user_id=auth()->user()->id;
            $carts=Cart::where('user_id', $user_id)->get();
        } else {
            $tmp_user_id=$request->session()->get('tmp_user_id');
            $carts = Cart::where('tmp_user_id', $tmp_user_id)->get();
        }
        return [
            'cart_count' => count($carts),
            'cart_view' => view('site.carts.new_cart_summary', compact('carts'))->render(),
            'nav_cart_view' => view('site._layouts._partials._new_partials.new_cart')->render(),
        ];
    }
    public function updateQuantity(Request $request)
    {
        $object = Cart::findOrFail($request->id);

        if ($object['id'] == $request->id) {
            $product = Product::find($object['product_id']);
            $quantity = $product->quantity;

            if ($quantity >= $request->quantity) {
                if ($request->quantity >= $product->min_purchase_unit) {
                    $object['quantity'] = $request->quantity;
                }
            }

            $object->save();
        }

        if (auth()->user() != null) {
            $user_id = Auth::user()->id;
            $carts = Cart::where('user_id', $user_id)->get();
        } else {
            $tmp_user_id = $request->session()->get('tmp_user_id');
            $carts = Cart::where('tmp_user_id', $tmp_user_id)->get();
        }

        return [
            'cart_count' => count($carts),
            'cart_view' => view('site.carts.new_cart_summary', compact('carts'))->render(),
            'nav_cart_view' => view('site._layouts._partials._new_partials.new_cart')->render(),
        ];
    }
}
