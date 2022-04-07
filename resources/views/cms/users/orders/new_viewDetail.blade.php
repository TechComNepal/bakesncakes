<x-new-site-master-layout :pageTitle="$pageTitle">
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> My Account
                </div>
            </div>
        </div>

        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">

                            <!--left col-->
                            @include('site._layouts._partials.sidebar')

                            <div class="col-12 col-md-9 mt-4 ">
                                <div class="panel">
                                    <div class="bio-graph-heading">
                                        {{ $pageTitle }}
                                    </div>
                                    <div class="panel-body bio-graph-info" style="border: 1px solid #fbc02d;">
                                        <div class="mt-5 mb-5">
                                            <div class="d-flex justify-content-center row">
                                                <div class="col-md-12">
                                                    <div class="receipt bg-white p-5 rounded">
                                                        <h4 class="mt-2 mb-3">Your order is
                                                            {{ ucfirst($order->status) }}!
                                                        </h4>

                                                        <hr>
                                                        <div
                                                            class="d-flex flex-row justify-content-between align-items-center order-details">
                                                            <div><span class="d-block fs-12">Order date</span><span
                                                                    class="font-weight-bold">{{ $order->created_at->isoFormat('MMMM Do YYYY') }}
                                                                </span></div>
                                                            <div><span class="d-block fs-12">Order number</span><span
                                                                    class="font-weight-bold">{{ $order->order_code }}</span>
                                                            </div>
                                                            <div><span class="d-block fs-12">Payment method</span><span
                                                                    class="font-weight-bold">{{ $order->payment_method }}</span>
                                                            </div>
                                                            <div><span class="d-block fs-12">Delivery
                                                                    Address</span><span
                                                                    class="font-weight-bold text-success">{{ $shipping_address['delivery_address'] }}</span>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        @php
                                                            $total_tax = 0;
                                                        @endphp
                                                        @foreach ($order->products as $product)
                                                            @php
                                                                $total_tax = $total_tax + $product->pivot->tax;
                                                            @endphp


                                                            <div
                                                                class="d-flex justify-content-between align-items-center product-details p-4">
                                                                <div class="d-flex flex-row product-name-image">
                                                                    <img class="rounded"
                                                                        src="{{ $product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}"
                                                                        width="80">
                                                                    <div
                                                                        class="d-flex flex-column justify-content-between ml-2">
                                                                        <div class="ml-2">
                                                                            <span
                                                                                class="d-block font-weight-bold p-name">{{ $product->name }}</span>
                                                                            <span
                                                                                class="fs-12">{{ $product->brand->name ?? '' }}</span>
                                                                        </div>
                                                                        <span class="fs-12 ml-2">Delivery Date:
                                                                            {{ Carbon\Carbon::parse($product->pivot->delivery_date)->format('d-M-Y G:ia') }}
                                                                        </span>
                                                                        <span class="fs-12">Qty:
                                                                            {{ $product->pivot->quantity }}
                                                                            {{ $product->units }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="product-price">
                                                                    <h5> Rs. {{ $product->pivot->price }}
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            <hr />
                                                        @endforeach

                                                        <div class="mt-5 amount row">
                                                            <div class="d-flex justify-content-center col-md-6">

                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="billing">
                                                                    <div class="d-flex justify-content-between">
                                                                        <span>Subtotal</span><span
                                                                            class="font-weight-bold">Rs.
                                                                            {{ $order->orderProducts->sum('price') }}
                                                                        </span>
                                                                    </div>

                                                                    <div class="d-flex justify-content-between mt-2">
                                                                        <span>Discount
                                                                            Amount</span><span
                                                                            class="font-weight-bold">Rs
                                                                            {{ $order->coupon_discount }}</span>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between mt-2">
                                                                        <span>Subtotal
                                                                            after
                                                                            discount</span><span
                                                                            class="font-weight-bold">Rs
                                                                            {{ $order->billing_total - $order->delivery_charge - $total_tax }}
                                                                        </span>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between mt-2">
                                                                        <span>Tax
                                                                            Amount
                                                                        </span><span class="font-weight-bold">Rs
                                                                            {{ $total_tax }}
                                                                        </span>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between mt-2">
                                                                        <span>Shipping
                                                                            fee</span><span class="font-weight-bold">Rs
                                                                            {{ $order->delivery_charge }}</span>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="d-flex justify-content-between mt-1">
                                                                        <span class="font-weight-bold">Total</span><span
                                                                            class="font-weight-bold text-success">Rs
                                                                            {{ $order->billing_total }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div
                                                            class="d-flex justify-content-between align-items-center footer">
                                                            <div class="thanks"><span
                                                                    class="d-block font-weight-bold">Thanks for
                                                                    shopping</span><span>{{ $setting->company_name }}</span>
                                                            </div>
                                                            <div
                                                                class="d-flex flex-column justify-content-end align-items-end">
                                                                <span class="d-block font-weight-bold">Need
                                                                    Help?</span><span>Call -
                                                                    {{ $setting->primary_phone }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

</x-new-site-master-layout>
