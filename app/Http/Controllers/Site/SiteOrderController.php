<?php

namespace App\Http\Controllers\Site;

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

                    $request->session()->put('coupon_discount_amount', $total);
                    return response()->json(['message' => 'Coupon successfully matched.', 'text_class' =>'text-success', 'status' => 'success', 'type' => 'Products', 'total' => $total]);
                } else {
                    $request->session()->put('coupon_discount_amount', $total);
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

                        $request->session()->put('coupon_discount_amount', $total);
                        return response()->json(['message' => 'Coupon successfully matched.', 'text_class' =>'text-success', 'status' => 'success', 'type' => 'Products', 'total' => $total]);
                    } else {
                        $request->session()->put('coupon_discount_amount', $total);
                        return response()->json(['message' => 'Coupon doesn\'t match.', 'text_class' =>'text-danger', 'status' => 'error']);
                    }
                }
            }
        }

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
}
