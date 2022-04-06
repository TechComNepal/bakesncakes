<?php

namespace App\Http\Controllers\Site;

use App\Models\Qrcode;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Shipping;
use App\Models\Promocode;
use Illuminate\Http\Request;
use App\Services\PaymentGateway;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ShippingRequest;
use App\Models\CustomerShippingAddress;

class SiteOrderController extends Controller
{
    private $paymentGateway;

    public function __construct(PaymentGateway $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }
    public function cashOnDelivery(Request $request)
    {
        try {
            return $this->paymentGateway->cashOnDelivery($request->all());
        } catch (\Throwable $throwable) {
            return $this->responseBackWithException($throwable);
        }
    }


    protected function shippingAddress(ShippingRequest $request)
    {
        $collection=collect($request->validated());
        $user_id = Auth::user()->id;
        $merge = $collection->merge(compact('user_id'));

        return CustomerShippingAddress::create($merge->all())
            ? redirect()->back()->withInput(['tab'=>'pills-address'])->withSuccess('Shipping Address has been created successfully.')
            : redirect()->back()->withError('There was problem with server. Please try again later.');
    }

    protected function editShippingAddress($id)
    {
        $data['shipping_address'] = CustomerShippingAddress::findOrFail($id);
        $data['shippings'] = Shipping::all();
        $returnHTML = view('site._layouts._partials.edit_address_modal', $data)->render();
        return response()->json(array('data' => $data, 'html'=>$returnHTML));
    }

    protected function updateShippingAddress(ShippingRequest $request, $id)
    {
        $collection = collect($request->validated());
        $user_id = Auth::user()->id;
        $merge = $collection->merge(compact('user_id'));
        $shipping_address = CustomerShippingAddress::findOrFail($id);

        return $shipping_address->update($merge->all())
            ? redirect()->back()->withInput(['tab'=>'pills-address'])->withSuccess('Shipping Address has been updated successfully.')
            : redirect()->back()->withError('There was problem with server. Please try again later.');
    }

    public function deleteShippingAddress($id)
    {
        $data = CustomerShippingAddress::findOrFail($id);
        $data->delete();
        return $data
            ? response()->json([ 'status' => 'success', 'message' => 'Shipping Address Successfully Deleted.'])
            : response()->json([ 'status' => 'error', 'message' => 'There was some issue with the server. Please try again.']);
    }

    public function priceAfterApplyCoupon(Request $request)
    {
        $promocode = Promocode::with(['categories', 'products'])->where('coupon_code', $request->coupon)->where('start_from', '<=', Carbon::today())->where('expires_on', '>=', Carbon::today())->first();
        $carts = Cart::where('user_id', Auth::user()->id)->pluck('product_id')->toArray();
        $total = 0;
        if ($promocode) {
            if (count($promocode->products) > 0) {
                $products = $promocode->products->pluck('id')->toArray();

                $product_found = (count(array_intersect($carts, $products))) ? true : false;
                if ($product_found) {
                    if ($promocode->type == 'percent') {
                        $total += $promocode->rate / 100;
                    } else {
                        $total += $promocode->rate;
                    }

                    foreach ($promocode->products as $product) {
                        Cart::where('user_id', Auth::user()->id)
                                                ->where('product_id', $product->id)
                                                ->update([
                                                    'coupon_discount' => $total
                                                ]);
                    }

                    $request->session()->put('coupon_discount_amount', Cart::where('user_id', Auth::user()->id)->sum('coupon_discount'));
                    return response()->json(['message' => 'Coupon successfully matched.', 'text_class' =>'text-success', 'status' => 'success', 'type' => 'Products', 'total' => Cart::where('user_id', Auth::user()->id)->sum('coupon_discount')]);
                } else {
                    Cart::where('user_id', Auth::user()->id)
                        ->update([
                            'coupon_discount' => 0
                        ]);
                    $request->session()->forget('coupon_discount_amount');
                    $request->session()->put('coupon_discount_amount', 0);
                    return response()->json(['message' => 'Coupon doesn\'t match.', 'text_class' =>'text-danger', 'status' => 'error']);
                }
            }
            if (count($promocode->categories) > 0) {
                foreach ($promocode->categories as $category) {
                    $category_products = $category->products->pluck('id')->toArray();

                    $product_found = (count(array_intersect($carts, $category_products))) ? true : false;
                    if ($product_found) {
                        if ($promocode->type == 'percent') {
                            $total += $promocode->rate/100;
                        } else {
                            $total += $promocode->rate;
                        }

                        foreach ($category->products as $product) {
                            Cart::where('user_id', Auth::user()->id)
                                ->where('product_id', $product->id)
                                ->update([
                                    'coupon_discount' => $total
                                ]);
                        }

                        $request->session()->forget('coupon_discount_amount');
                        $request->session()->put('coupon_discount_amount', Cart::where('user_id', Auth::user()->id)->sum('coupon_discount'));
                        return response()->json(['message' => 'Coupon successfully matched.', 'text_class' =>'text-success', 'status' => 'success', 'type' => 'Products', 'total' => Cart::where('user_id', Auth::user()->id)->sum('coupon_discount')]);
                    } else {
                        Cart::where('user_id', Auth::user()->id)
                            ->update([
                                'coupon_discount' => 0
                            ]);
                        $request->session()->forget('coupon_discount_amount');
                        $request->session()->put('coupon_discount_amount', 0);
                        return response()->json(['message' => 'Coupon doesn\'t match .', 'text_class' =>'text-danger', 'status' => 'error']);
                    }
                }
            }
        }

        Cart::where('user_id', Auth::user()->id)
            ->update([
                'coupon_discount' => 0
            ]);

        $request->session()->forget('coupon_discount_amount');
        $request->session()->put('coupon_discount_amount', $total);
        return response()->json(['message' => 'Coupon doesn\'t match.', 'text_class' =>'text-danger', 'status' => 'error']);
    }

    public function setDefaultShippingAddress($id)
    {
        foreach (Auth::user()->shipping_address as $key => $address) {
            $address->set_default = 0;
            $address->save();
        }
        $address = CustomerShippingAddress::findOrFail($id);
        $address->set_default = 1;
        $address->save();

        return back();
    }


    public function get_shipping_info()
    {
        return view('site.checkouts.new_shipping_info', [
            'carts' => Cart::where('user_id', Auth::user()->id)->get(),
            'shippings' => Shipping::all(),
            'qrcode' => Qrcode::first(),
        ]);
    }

    public function store_shipping_info(Request $request)
    {
        if ($request->address_id == null) {
            return back();
        }

        $carts = Cart::where('user_id', Auth::user()->id)->get();

        foreach ($carts as $key => $cartItem) {
            $cartItem->address_id = $request->address_id;
            $cartItem->save();
        }

        return view('site.checkouts.new_delivery_info', compact('carts'));
    }

    public function store_delivery_info(Request $request)
    {
        $carts = Cart::where('user_id', Auth::user()->id)
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('site.page')->withError('Your Cart is empty.');
        }

        $shipping_info = CustomerShippingAddress::where('id', $carts[0]['address_id'])->first();
        $total = 0;
        $tax = 0;
        $shipping = 0;
        $subtotal = 0;

        if ($carts && count($carts) > 0) {
            foreach ($carts as $key => $cartItem) {
                $product = \App\Models\Product::find($cartItem['product_id']);
                $tax += $cartItem['tax'] * $cartItem['quantity'];
                $subtotal += $cartItem['price'] * $cartItem['quantity'];

                $cartItem['shipping_cost'] = 0;

                $shipping_address = CustomerShippingAddress::where('id', $cartItem['address_id'])->where('user_id', Auth::user()->id)->first();
                $cartItem['shipping_cost'] = $shipping_address->shipping->delivery_charge ?? '0';


                $shipping += $cartItem['shipping_cost'];
                $cartItem->save();
            }
            $total = $subtotal + $tax + $shipping;

            $qrcode = Qrcode::first();
            return view('site.checkouts.new_payment_select', compact('carts', 'shipping_info', 'total', 'qrcode'));
        } else {
            return redirect()->route('site.page')->withErrors('Your Cart is Empty');
        }
    }
}
