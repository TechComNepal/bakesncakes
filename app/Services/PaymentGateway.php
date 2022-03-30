<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\CustomerShippingAddress;
use App\Notifications\UserOrderNotification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;

class PaymentGateway
{
    public function cashOnDelivery(array $params)
    {
        DB::beginTransaction();
        $couponDiscount= Session::get('coupon_discount_amount');
        $collection=collect($params)->except('_token');
        $user_id=Auth::user()->id;

        $carts= Cart::where('user_id', $user_id)->get();
        $billing_total = 0;
        $shipping_address = CustomerShippingAddress::where('id', $collection['address_id'])->where('user_id', Auth::user()->id)->first();
        $delivery_charge = $shipping_address->shipping->delivery_charge ?? '0';
        if (!($carts->isEmpty())) {
            foreach ($carts as $cart) {
                $billing_total = $billing_total + ($cart->price+$cart->tax) * $cart->quantity;
            }
            $order_code = 'ORD-' . strtoupper(uniqid());
            $order = Order::create([
                'order_code'      => $order_code,
                'user_id'         => $user_id,
                'billing_email'   => Auth::user()->email,
                'delivery_charge' => $delivery_charge,
                'payment_method'  => $params['payment_method'],
                'billing_total'   => ($billing_total+$delivery_charge) - $couponDiscount,
                'shipping_address' => json_encode($shipping_address),
                'coupon_discount'=>$couponDiscount,
            ]);

            if ($order) {
                foreach ($carts as $cart) {
                    $product = Product::where('id', $cart->product_id)->first();
                    $orderProduct = OrderProduct::create([
                        'order_id'   => $order->id,
                        'product_id' => $product->id,
                        'user_id'    => $user_id,
                        'price'      => $cart->price,
                        'quantity'   => $cart->quantity,
                        'tax'        => $cart->tax,
                        'total'      => ($cart->price + $cart->tax) * $cart->quantity,
                        'status'     => true,
                        'delivery_date'=>$cart->delivery_date,
                        'user_note'=> $cart->user_note,
                    ]);
                    $product->update([
                        'quantity' => ($product->quantity - $cart->quantity)
                    ]);
                    Cart::destroy($cart->id);

                    $mail_details=[
                        'order_code'=>$order_code,
                        'billing_total'   => ($billing_total+$delivery_charge) - $couponDiscount,
                        'delivery_address' => $shipping_address->delivery_address,
                    ];
                    Mail::to(Auth::user()->email)->send(new OrderConfirmationMail($mail_details));

                    //Admin Notification
                    $admins=User::role(['admin','superadmin'])->get();
                    Notification::send($admins, new UserOrderNotification($order));
                }
                Session::forget('coupon_discount_amount');
                DB::commit();

                return response()->json([
                    'id'             => $order->id,
                    'total_price'    => $order->billing_total,
                    'ref_id'         => $order->order_code,
                    'payment_method' => $this->payment_method,
                    'success'        => 'Order has been placed successfully.',
                    'redirect'       => route('site.page')
                ]);
            } else {
                DB::rollback();

                return 'Oops! Some Problem occured. Please try again later.';
            }
        }
    }
}
