<x-new-site-master-layout>


    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('site.page') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Shop
                    <span></span> Checkout
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row mt-5">

                @php
                    $total = 0;
                @endphp

                @if (!$carts->isEmpty())
                    <form method="post" id="checkout-form" action="{{ route('new.checkout') }}">
                        @csrf
                        <input type="hidden" name="seller_id" value="{{ $carts[0]['seller_id'] }}">
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <div class="ps-checkout__form">
                                    <h1 class="heading-2 mb-10">select Payment Options</h1>

                                    <hr />
                                    <div class="row">
                                        <div class="col-6 col-md-4">
                                            <label class="payment-label d-block mb-3">
                                                <input class="form-check-input" name="payment" type="radio"
                                                    id="cashOnDelivery" value="cashOnDelivery" checked>
                                                <span class="d-block payment-label-elem p-3">
                                                    <img src="{{ asset('common/payment/cod.png') }}" height="119"
                                                        class="img-fluid mb-2">
                                                    <span class="d-block text-center">
                                                        <span class="d-block fw-600 fs-15">Cash on Delivery</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <label class="payment-label d-block mb-3">
                                                <input class="form-check-input" name="payment" type="radio" id="QRCode"
                                                    value="fonepay">
                                                <span class="d-block payment-label-elem p-3">
                                                    <img src="{{ asset('common/payment/fonepay.png') }}" height="119"
                                                        class="img-fluid mb-2">
                                                    <span class="d-block text-center">
                                                        <span class="d-block fw-600 fs-15">Fonepay</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="check-faq pt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="agree-faq" checked
                                                name="termscondition" required>
                                            <label class="form-check-label" for="agree-faq">
                                                I have read and agree to the website
                                                <a href="{{ route('site.page.termsAndCondition') }}">Terms and
                                                    Conditions</a>,
                                                <a href="{{ route('site.page.privacyAndPolicy') }}">Privacy
                                                    Policy</a>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="border p-md-4 cart-totals ml-30">
                                    <h3 class="heading-2 mb-10">Your Order</h3>
                                    <div class="table-responsive">
                                        <table class="table no-border">
                                            <thead>
                                                <th>
                                                    <h5 class="text-heading ">Product</h5>
                                                </th>
                                                <th>
                                                    <h5 class="text-heading text-end">Total</h5>
                                                </th>
                                            </thead>


                                            <tbody>
                                                @php
                                                    $subtotal = 0;
                                                    $tax = 0;
                                                    $shipping = 0;
                                                    $product_shipping_cost = 0;
                                                @endphp
                                                @foreach ($carts as $cart)
                                                    @php
                                                        $product = \App\Models\Product::where('id', $cart->product_id)->first();
                                                        $subtotal += $cart->price * $cart->quantity;
                                                        $tax += $cart->tax * $cart->quantity;
                                                        $product_shipping_cost = $cart->shipping_cost;
                                                        $shipping += $product_shipping_cost;
                                                        $total = $total + ($cart->price + $cart->tax) * $cart->quantity;
                                                    @endphp
                                                    <tr>
                                                        <td class="cart_total_label">
                                                            <h5 class="text-muted">{{ $product->name }} x <span>
                                                                    {{ $cart->quantity }} </span></h5>
                                                        </td>
                                                        <td class="cart_total_amount">
                                                            <h5 class="text-brand text-end">
                                                                {{ $cart->price * $cart->quantity }}</h5>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                <tr>
                                                    <td class="cart_total_label">
                                                        <h6 class="text-muted">Coupon</h6>
                                                    </td>
                                                    <td class="cart_total_amount">
                                                        <h5 class="text-brand ">
                                                            <div class="form-check">
                                                                <input type="text" name="total"
                                                                    placeholder="Enter Coupon" id="coupon" style="margin-top: 15px; height: 40px; width: 150px;">
                                                            </div>

                                                            <div class="message form-check mt-3">
                                                                <span><small id="coupon-message"
                                                                        class=""></small></span>
                                                            </div>
                                                        </h5>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td class="cart_total_label" id="coupon_discount">
                                                        <h6 class="text-muted">Coupon Discount</h6>
                                                    </td>
                                                    <td class="cart_total_amount">
                                                        <h5 class="text-brand text-end" id="coupon_charge">

                                                        </h5>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="cart_total_label">
                                                        <h6 class="text-muted">Subtotal</h6>
                                                    </td>
                                                    <td class="cart_total_amount">
                                                        <h5 class="text-brand text-end" id="shipping_charge">
                                                            {{ $subtotal }}
                                                        </h5>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="cart_total_label">
                                                        <h6 class="text-muted">Tax</h6>
                                                    </td>
                                                    <td class="cart_total_amount">
                                                        <h5 class="text-brand text-end" id="shipping_charge">
                                                            {{ $tax }}
                                                        </h5>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="cart_total_label">
                                                        <h6 class="text-muted">Shipping Charge</h6>
                                                    </td>
                                                    <td class="cart_total_amount">
                                                        <h5 class="text-brand text-end" id="shipping_charge">
                                                            {{ $shipping }}
                                                        </h5>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td class="cart_total_label">
                                                        <h6 class="text-muted">Total</h6>
                                                    </td>
                                                    @php
                                                        $total = $subtotal + $tax + $shipping;
                                                    @endphp
                                                    <input type="hidden" id="total_price" value="{{ $total }}">
                                                    <td class="cart_total_amount" id="total">
                                                        <h4 class="text-brand text-end">Rs. {{ $total }}</h4>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <button id="order-button" class="btn mb-20 w-100 mt-5">Place
                                        order <i class="fi-rs-sign-out ml-15"></i></button>

                                </div>
                            </div>


                        </div>

                    </form>
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

    </main>


    <!--QR Code Modal -->
    <div class="modal fade" id="qr-code-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">QR Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button><br />

                </div>
                <form action="#" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <span class="text-muted">
                                <p> Please make sure to scan properly and then proceed to place order!!! </p>
                            </span>
                            @if ($qrcode)
                                <img alt="QR Code Image" src="{{ $qrcode->getFirstOrDefaultMediaUrl('qrimage') }}">
                            @else
                                <img alt="QR Code Image" src="{{ asset('demo_images/qr-code/qrcode.jpeg') }}">
                            @endif

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--End QR Code Modal -->


    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
        <script>
            $('#QRCode').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#qr-code-modal').modal('show');
                }
            });

            $('#coupon').on('keyup', function() {
                let coupon = $(this).val();

                $.ajax({
                    url: "{{ route('user.price.after.apply.coupon') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        coupon: coupon
                    },
                    async: true,
                    cache: false,
                    success: function(data) {
                        if (data.status == 'success') {

                            let total_price = $('#total_price').val();
                            let totalAfterCoupon = parseFloat(total_price) - parseFloat(data.total);
                            $('#total').html(totalAfterCoupon);
                            $('#coupon_charge').html('- ' + data.total);
                            console.log('data total = ' + data.total);
                            $('#coupon-message').addClass(data.text_class);
                            $('#coupon-message').removeClass('text-danger');
                        } else {
                            let total_price = $('#total_price').val();
                            $('#total').html(total_price);
                            $('#coupon_charge').html('- ' + 0);

                            $('#coupon-message').addClass(data.text_class);
                            $('#coupon-message').removeClass('text-success');
                        }
                        $('#coupon-message').html(data.message);
                        console.log("success = " + data.message);
                    },
                    error: function(data) {
                        console.log("error = " + data.error);
                    }
                });
            });
        </script>
    @endpush

</x-new-site-master-layout>
