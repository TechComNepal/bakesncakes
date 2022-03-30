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
                    <form method="post" id="checkout-form">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <div class="ps-checkout__form">
                                    <h3 class="ps-checkout__heading">Billing details</h3>
                                    <hr />
                                    <div id="reset-address">
                                        <div class="row">
                                            @if (!is_null(Auth::user()->shipping_address))
                                                @foreach (Auth::user()->shipping_address as $key => $address)
                                                    <div class="col-md-6 mb-3">
                                                        <div class="border p-3 rounded mb-3 c-pointer bg-white h-100">
                                                            <label class="d-block bg-white mb-0">
                                                                <input type="radio" name="address_id"
                                                                    value="{{ $address->id }}"
                                                                    data-charge="{{ $address->shipping->delivery_charge }}"
                                                                    @if ($address->set_default) checked @endif
                                                                    required>
                                                                <span class="d-flex p-3">
                                                                    <span class="flex-shrink-0 mt-1"></span>
                                                                    <span class="flex-grow-1 pl-3 text-left">
                                                                        <div>
                                                                            <span style="opacity: 0.6">Delivery
                                                                                Address:</span>
                                                                            <span class="ml-2"
                                                                                style="font-weight: 600">{{ $address->delivery_address }}</span>
                                                                        </div>
                                                                        <div>
                                                                            <span style="opacity: 0.6">Landmark
                                                                                Address:</span>
                                                                            <span class="ml-2"
                                                                                style="font-weight: 600">{{ $address->landmark }}</span>
                                                                        </div>
                                                                        <div>
                                                                            <span style="opacity: 0.6">City:</span>
                                                                            <span class="ml-2"
                                                                                style="font-weight: 600">{{ $address->shipping->shipping_address }}</span>
                                                                        </div>
                                                                        <div>
                                                                            <span style="opacity: 0.6">Name:</span>
                                                                            <span class="ml-2"
                                                                                style="font-weight: 600">{{ $address->name }}</span>
                                                                        </div>
                                                                        <div>
                                                                            <span style="opacity: 0.6">Phone:</span>
                                                                            <span class="ml-2"
                                                                                style="font-weight: 600">{{ $address->phone_no }}</span>
                                                                        </div>
                                                                    </span>
                                                                </span>
                                                            </label>

                                                            <a href="javascript:void(0)" type="button"
                                                                data-bs-toggle="tooltip" title="Edit"
                                                                onclick="edit_address('{{ $address->id }}')">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" id="delete-btn"
                                                                data-id="{{ $address->id }}" data-bs-toggle="tooltip"
                                                                title="Delete" data-bs-original-title="Delete"> <i
                                                                    class="fa fa-trash"></i></a>

                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif



                                            <div class="col-md-6 mx-auto mb-3">
                                                <div class="border p-3 rounded mb-3 c-pointer text-center bg-white h-100 d-flex flex-column justify-content-center"
                                                    onclick="add_new_address()">
                                                    <i class="fa fa-plus la-2x mb-3"></i>
                                                    <div class="alpha-7">Add New Address</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-12 col-lg-4 mt-5 shadow-md p-4">
                                <div class="ps-checkout__order ps-shopping__label-cart-billing">
                                    <h3 class="ps-checkout__heading">Your order</h3>
                                    <div class="ps-checkout__row">
                                        <div class="ps-title">Product</div>
                                        <div class="ps-title">Subtotal</div>
                                    </div>

                                    @foreach ($carts as $cart)
                                        @php
                                            $product = \App\Models\Product::where('id', $cart->product_id)->first();
                                            $total = $total + ($cart->price + $cart->tax) * $cart->quantity;
                                        @endphp
                                        <div class="ps-checkout__row ps-product">
                                            <div class="ps-product__name">{{ $product->name }} x <span>
                                                    {{ $cart->quantity }} </span></div>
                                            <div class="ps-product__price">Rs
                                                {{ ($cart->price + $cart->tax) * $cart->quantity }}</div>
                                        </div>
                                    @endforeach

                                    <div class="ps-checkout__row">
                                        <div class="ps-title">Coupon</div>
                                        <div class="form-check">
                                            <input type="text" name="total" placeholder="Enter Coupon" id="coupon">
                                        </div>

                                        <div class="message form-check">
                                            <span><small id="coupon-message" class=""></small></span>
                                        </div>
                                    </div>
                                    <div class="ps-checkout__row" id="coupon_discount">
                                        <div class="ps-title">Coupon Discount</div>
                                        <div class="ps-product__price" id="coupon_charge">
                                        </div>
                                    </div>

                                    <div class="ps-checkout__row">
                                        <div class="ps-title">Shipping Charge</div>
                                        <div class="ps-product__price" id="shipping_charge">
                                            {{ $shipping_address->shipping->delivery_charge ?? '0.00' }} </div>
                                    </div>

                                    <div class="ps-checkout__row">
                                        <div class="ps-title">Total</div>
                                        <input type="hidden" id="total_price"
                                            value="{{ $total + ($shipping_address->shipping->delivery_charge ?? 0) }}">
                                        <div class="ps-product__price" id="total">
                                            {{ $total + ($shipping_address->shipping->delivery_charge ?? 0) }}</div>

                                    </div>
                                    <div class="ps-checkout__payment">
                                        <div class="paypal-method">
                                            <div class="form-check">
                                                <input class="form-check-input" name="payment" type="radio"
                                                    id="cashOnDelivery" value="cashOnDelivery" checked="checked">
                                                <label class="form-check-label" for="cashOnDelivery"> Cash On Delivery
                                                </label>
                                            </div>
                                        </div>


                                        <div class="paypal-method">
                                            <div class="form-check">
                                                <input class="form-check-input" name="payment" type="radio" id="QRCode"
                                                    value="fonePay">
                                                <label class="form-check-label" for="QRCode"> Fone Pay
                                                </label>
                                            </div>
                                        </div>

                                        <div class="check-faq">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="agree-faq" checked
                                                    name="termscondition" required>
                                                <label class="form-check-label" for="agree-faq"> I have read and agree
                                                    to
                                                    the website terms and conditions *</label>
                                            </div>
                                        </div>
                                        <button id="order-button" class="ps-btn ps-btn--warning">Place order</button>

                                    </div>
                                    <div id="address_section">
                                    </div>
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
    </div>


    <div class="modal fade" id="new-address-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">New Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.shipping.address') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <x-input-field :type="'email'" :label="'Email Address'" :name="'email'" :required="TRUE"
                                :placeholder="'Email Address Here'" :col="'6'" />
                            <x-input-field :label="'Name'" :name="'name'" :required="TRUE" :placeholder="'Name Here'"
                                :col="'6'" />
                            <x-input-field :label="'Phone Number'" :name="'phone_no'" :required="TRUE"
                                :placeholder="'Phone Number Here'" :col="'6'" />
                            <x-select-field :label="'Select City'" :name="'city_id'" :required="'TRUE'"
                                :placeholder="'Select City'" :col="'6'">
                                @foreach ($shippings as $shipping)
                                    <option @if (old('shipping_id') == $shipping->id) selected @endif
                                        value="{{ $shipping->id }}"
                                        data-charge="{{ $shipping->delivery_charge }}">
                                        {{ $shipping->shipping_address }} </option>
                                @endforeach
                            </x-select-field>
                            <x-input-field :label="'Delivery Address'" :name="'delivery_address'" :required="TRUE"
                                :placeholder="'Delivery Address Here'" :col="'6'" />
                            <x-input-field :label="'LandMark Address'" :name="'landmark'" :required="TRUE"
                                :placeholder="'LandMark Address Here'" :col="'6'" />

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

    <div class="modal fade" id="edit-address-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <div class="modal-body" id="edit_modal_body">
                    ...
                </div>

            </div>
        </div>
    </div>
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
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Proceed</button>
                </div>

            </div>
        </div>
    </div>

    <!--End QR Code Modal -->


    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
        <script>
            $(function() {
                $('#order-button').click(function(e) {
                    e.preventDefault();
                    var $this = $(this);
                    var $caption = $this.html();

                    let payment_method = $("input[type=radio][name=payment]:checked");
                    let address_id = $('input[type=radio][name="address_id"]:checked').val();
                    let total = $('#total').text();

                    let data = {
                        'payment_method': payment_method.val(),
                        'total': total,
                        'address_id': address_id,
                    }

                    if ($('input:radio[name="address_id"]').is(':checked')) {

                        let checkoutForm = document.getElementById('checkout-form');
                        if (payment_method.val() === 'cashOnDelivery' || payment_method.val() === 'fonePay') {

                            $this.attr('disabled', true).html("Processing...");

                            axios.post("{{ route('order.cashOnDelivery') }}", data)
                                .then(response => {
                                    if (response.data.id === 'undefined') {
                                        return false;
                                    }
                                    console.log(response.data);

                                    alertify.success('Order has been placed successfully.');
                                    $this.attr('disabled', false).html($caption);
                                    window.location = "{{ route('site.page') }}";
                                })
                                .catch(error => {
                                    if (error.response.data.errors.address_id) {
                                        alertify.error(error.response.data.errors.address_id[0]);
                                        $this.attr('disabled', false).html($caption);
                                    }
                                    if (error.response.data.errors.payment_method) {
                                        alertify.error(error.response.data.errors.payment_method[0]);
                                        $this.attr('disabled', false).html($caption);
                                    }

                                    if (error.response.data.errors.total) {
                                        alertify.error(error.response.data.errors.total[0]);
                                    }
                                });
                        }
                    } else {
                        $('#address_section').html(
                            '<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert"> <p class="text-sm text-danger">Please add and select address details before proceeding</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                        );
                    }
                })
            });

            $('#QRCode').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#qr-code-modal').modal('show');
                }
            });


            function add_new_address() {
                $('#new-address-modal').modal('show');
            }

            function edit_address(address) {
                var url = '{{ route('user.shipping.address.edit', ':id') }}';
                url = url.replace(':id', address);

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        $('#edit_modal_body').html(response.html);
                        $('#edit-address-modal').modal('show');
                    }
                })
            }

            $('input:radio[name="address_id"]').on('change', function() {
                if ($(this).is(':checked')) {
                    let charge = $(this).data('charge') ? $(this).data('charge') : 0;
                    let total = {{ $total }};
                    let totalAfterCharge = parseFloat(charge) + parseFloat(total);

                    $('#shipping_charge').html(charge);
                    $('#total').html(totalAfterCharge);
                    $('#total_price').val(totalAfterCharge);
                    $('#coupon').val(null);
                    $('#coupon_charge').html('- ' + 0);
                    $('#coupon-message').removeClass('text-success').html(null);
                }

            });


            $('body').on('click', '#delete-btn', function(event) {
                event.preventDefault();
                event.stopPropagation();
                var id = $(this).data('id');
                var delete_url = "{{ route('user.shipping.address.delete', '') }}/" + id;

                $.ajax({
                    type: "DELETE",
                    url: delete_url,
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            alertify.success(data.message)
                            $('#reset-address').load(location.href + " #reset-address");

                        } else {
                            alertify.error(data.message);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                        console.log('Quick View Error');
                    }
                });
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

</x-site-master-layout>
