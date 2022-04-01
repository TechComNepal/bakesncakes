<x-site-master-layout>
    <div class="row mt-5">
        <div class="ps-checkout">
            <div class="container">
                <ul class="ps-breadcrumb">
                    <li class="ps-breadcrumb__item"><a href="{{ route('site.page') }}">Home</a></li>
                    <li class="ps-breadcrumb__item active" aria-current="page"> Checkout</li>
                </ul>

                @php
                    $total = 0;
                @endphp

                @if (!$carts->isEmpty())
{{--                    **************************************************** --}}
                    <form class="form-default"  action="#" role="form" method="POST">
                        @csrf
                        @php
                            $seller_products = [];
                            $product_ids = [];

                            foreach ($carts as $key => $cartItem){
                                $product = \App\Models\Product::find($cartItem['product_id']);

                                $product_ids = array();
                                if(isset($seller_products[$product->user_id])){
                                    $product_ids = $seller_products[$product->user_id];
                                }
                                array_push($product_ids, $cartItem['product_id']);
                                $seller_products[$product->user_id] = $product_ids;

                            }
                        @endphp
                        @if (!empty($seller_products))
                            @foreach ($seller_products as $key => $seller_product)
                                <div class="card mb-3 shadow-sm border-0 rounded">
                                    <div class="card-header p-3">
                                        <h5 class="fs-16 fw-600 mb-0">{{ \App\Models\User::where('id', $key)->first()->name }} Products</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($seller_product as $cartItem)
                                                @php
                                                    $product = \App\Models\Product::find($cartItem);
                                                @endphp
                                                <li class="list-group-item">
                                                    <div class="d-flex">
                                                <span class="mr-2">
                                                    <img
                                                        src="{{ $product->getFirstOrDefaultMediaUrl('image', 'square-sm-thumb') }}"
                                                        class="img-fit size-60px rounded"
                                                        alt="{{  $product->name  }}"
                                                    >
                                                </span>
                                                        <span class="fs-14 opacity-60">{{ $product->name }}</span>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="pt-4 d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn fw-600 btn-primary">Continue to Payment</button>
                        </div>


                    </form>
{{--                    **************************************************** --}}

{{--                    <form method="post" id="checkout-form">--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" name="seller_id" value="{{ $carts[0]['seller_id'] }}">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-12 col-lg-8">--}}
{{--                                <div class="ps-checkout__form">--}}
{{--                                    <h3 class="ps-checkout__heading">Billing details</h3>--}}
{{--                                    <hr />--}}
{{--                                    <div id="reset-address">--}}
{{--                                        <div class="row">--}}
{{--                                            @if (!is_null(Auth::user()->shipping_address))--}}
{{--                                                @foreach (Auth::user()->shipping_address as $key => $address)--}}
{{--                                                    <div class="col-md-6 mb-3">--}}
{{--                                                        <div class="border p-3 rounded mb-3 c-pointer bg-white h-100">--}}
{{--                                                            <label class="d-block bg-white mb-0">--}}
{{--                                                                <input type="radio" name="address_id"--}}
{{--                                                                       value="{{ $address->id }}"--}}
{{--                                                                       data-charge="{{ $address->shipping->delivery_charge }}"--}}
{{--                                                                       @if ($address->set_default) checked @endif--}}
{{--                                                                       required>--}}
{{--                                                                <span class="d-flex p-3">--}}
{{--                                                                    <span class="flex-shrink-0 mt-1"></span>--}}
{{--                                                                    <span class="flex-grow-1 pl-3 text-left">--}}
{{--                                                                        <div>--}}
{{--                                                                            <span style="opacity: 0.6">Delivery--}}
{{--                                                                                Address:</span>--}}
{{--                                                                            <span class="ml-2"--}}
{{--                                                                                  style="font-weight: 600">{{ $address->delivery_address }}</span>--}}
{{--                                                                        </div>--}}
{{--                                                                        <div>--}}
{{--                                                                            <span style="opacity: 0.6">Landmark--}}
{{--                                                                                Address:</span>--}}
{{--                                                                            <span class="ml-2"--}}
{{--                                                                                  style="font-weight: 600">{{ $address->landmark }}</span>--}}
{{--                                                                        </div>--}}
{{--                                                                        <div>--}}
{{--                                                                            <span style="opacity: 0.6">City:</span>--}}
{{--                                                                            <span class="ml-2"--}}
{{--                                                                                  style="font-weight: 600">{{ $address->shipping->shipping_address }}</span>--}}
{{--                                                                        </div>--}}
{{--                                                                        <div>--}}
{{--                                                                            <span style="opacity: 0.6">Name:</span>--}}
{{--                                                                            <span class="ml-2"--}}
{{--                                                                                  style="font-weight: 600">{{ $address->name }}</span>--}}
{{--                                                                        </div>--}}
{{--                                                                        <div>--}}
{{--                                                                            <span style="opacity: 0.6">Phone:</span>--}}
{{--                                                                            <span class="ml-2"--}}
{{--                                                                                  style="font-weight: 600">{{ $address->phone_no }}</span>--}}
{{--                                                                        </div>--}}
{{--                                                                    </span>--}}
{{--                                                                </span>--}}
{{--                                                            </label>--}}

{{--                                                            <a href="javascript:void(0)" type="button"--}}
{{--                                                               data-bs-toggle="tooltip" title="Edit"--}}
{{--                                                               onclick="edit_address('{{ $address->id }}')">--}}
{{--                                                                <i class="fa fa-edit"></i>--}}
{{--                                                            </a>--}}
{{--                                                            <a href="javascript:void(0)" id="delete-btn"--}}
{{--                                                               data-id="{{ $address->id }}" data-bs-toggle="tooltip"--}}
{{--                                                               title="Delete" data-bs-original-title="Delete"> <i--}}
{{--                                                                    class="fa fa-trash"></i></a>--}}

{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                @endforeach--}}
{{--                                            @endif--}}



{{--                                            <div class="col-md-6 mx-auto mb-3">--}}
{{--                                                <div class="border p-3 rounded mb-3 c-pointer text-center bg-white h-100 d-flex flex-column justify-content-center"--}}
{{--                                                     onclick="add_new_address()">--}}
{{--                                                    <i class="fa fa-plus la-2x mb-3"></i>--}}
{{--                                                    <div class="alpha-7">Add New Address</div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-12 col-lg-4 mt-5 shadow-md p-4">--}}
{{--                                <div class="ps-checkout__order ps-shopping__label-cart-billing">--}}
{{--                                    <h3 class="ps-checkout__heading">Your order</h3>--}}
{{--                                    <div class="ps-checkout__row">--}}
{{--                                        <div class="ps-title">Product</div>--}}
{{--                                        <div class="ps-title">Subtotal</div>--}}
{{--                                    </div>--}}

{{--                                    @foreach ($carts as $cart)--}}
{{--                                        @php--}}
{{--                                            $product = \App\Models\Product::where('id', $cart->product_id)->first();--}}
{{--                                            $total = $total + ($cart->price + $cart->tax) * $cart->quantity;--}}
{{--                                        @endphp--}}
{{--                                        <div class="ps-checkout__row ps-product">--}}
{{--                                            <div class="ps-product__name">{{ $product->name }} x <span>--}}
{{--                                                    {{ $cart->quantity }} </span></div>--}}
{{--                                            <div class="ps-product__price">Rs--}}
{{--                                                {{ ($cart->price + $cart->tax) * $cart->quantity }}</div>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}

{{--                                    <div class="ps-checkout__row">--}}
{{--                                        <div class="ps-title">Coupon</div>--}}
{{--                                        <div class="form-check">--}}
{{--                                            <input type="text" name="total" placeholder="Enter Coupon" id="coupon">--}}
{{--                                        </div>--}}

{{--                                        <div class="message form-check">--}}
{{--                                            <span><small id="coupon-message" class=""></small></span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="ps-checkout__row" id="coupon_discount">--}}
{{--                                        <div class="ps-title">Coupon Discount</div>--}}
{{--                                        <div class="ps-product__price" id="coupon_charge">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="ps-checkout__row">--}}
{{--                                        <div class="ps-title">Shipping Charge</div>--}}
{{--                                        <div class="ps-product__price" id="shipping_charge">--}}
{{--                                            {{ $shipping_address->shipping->delivery_charge ?? '0.00' }} </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="ps-checkout__row">--}}
{{--                                        <div class="ps-title">Total</div>--}}
{{--                                        <input type="hidden" id="total_price"--}}
{{--                                               value="{{ $total + ($shipping_address->shipping->delivery_charge ?? 0) }}">--}}
{{--                                        <div class="ps-product__price" id="total">--}}
{{--                                            {{ $total + ($shipping_address->shipping->delivery_charge ?? 0) }}</div>--}}

{{--                                    </div>--}}
{{--                                    <div class="ps-checkout__payment">--}}
{{--                                        <div class="paypal-method">--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" name="payment" type="radio"--}}
{{--                                                       id="cashOnDelivery" value="cashOnDelivery" checked="checked">--}}
{{--                                                <label class="form-check-label" for="cashOnDelivery"> Cash On Delivery--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}


{{--                                        <div class="paypal-method">--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" name="payment" type="radio" id="QRCode"--}}
{{--                                                       value="fonePay">--}}
{{--                                                <label class="form-check-label" for="QRCode"> Fone Pay--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="check-faq">--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="checkbox" id="agree-faq" checked--}}
{{--                                                       name="termscondition" required>--}}
{{--                                                <label class="form-check-label" for="agree-faq"> I have read and agree--}}
{{--                                                    to--}}
{{--                                                    the website terms and conditions *</label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <button id="order-button" class="ps-btn ps-btn--warning">Place order</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}


{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
                @else
                    <div class="row">
                        <div class="col-12">
                            <div class="ps-checkout__form">
                                <h4 class="text-center">No product in your cart.</h4>
                                <h3 class="ps-checkout__heading text-center"><a class="btn btn-warning btn-lg"
                                                                                href="{{ route('site.page') }}">Continue Shopping</a></h3>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-site-master-layout>
