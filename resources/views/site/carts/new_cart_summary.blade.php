<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('site.page') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Shop
                <span></span> Cart
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h1 class="heading-2 mb-10">Your Cart</h1>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">There are <span class="text-brand">{{ count($carts) }}</span>
                        products in your cart</h6>
                </div>
            </div>
        </div>
        @if (count($carts) > 0)
        <div class="row">
            <div class="col-lg-8">
                @php
                $total = 0;
                $subtotal = 0;
                $tax = 0;
                @endphp

                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                            <tr class="main-heading">

                                <th class="">Product</th>
                                <th class="">Unit Price</th>
                                <th class=" text-center">Quantity</th>
                                <th class="text-start">Subtotal</th>
                                <th class="">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                            @php
                            $product = \App\Models\Product::find($cart['product_id']);
                            $total = $total + ($cart['price'] + $cart['tax']) * $cart['quantity'];
                            $subtotal = $subtotal + $cart['price'] * $cart['quantity'];
                            $tax = $tax + $cart['tax'] * $cart['quantity'];
                            @endphp

                            <tr class="pt-30">

                                <td class="image product-thumbnail pt-40">
                                    <img
                                            src="{{ $product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}"
                                    alt>
                                </td>

                                <td class="price" data-title="Price">
                                    @if ($product->discount === 0)
                                    <h4 class="text-body">Rs. {{ $product->selling_price }} </h4>
                                    @else
                                    @if ($product->discount_type === 'percent')
                                    <h4 class="text-body">Rs.
                                        {{ $product->selling_price * (1 - $product->discount / 100) }}
                                    </h4>
                                    @else
                                    <h4 class="text-body">Rs.
                                        {{ $product->selling_price - $product->discount }}</h4>
                                    @endif
                                    @endif

                                </td>
                                <td class="ps-product__quantity">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button type="button btn-minus" class="minus ps-plus-minus number-input"
                                            data-type="minus" data-field="quantity[{{ $cart->id }}]"><i
                                                class="fa fa-minus"></i></button>
                                        <input class="quantity single-product-input"
                                            min="{{ $product->min_purchase_unit }}" max="{{ $product->quantity }}"
                                            name="quantity[{{ $cart->id }}]" value="{{ $cart->quantity }}" type="number"
                                            onchange="updateQuantity({{ $cart->id }}, this)">
                                        <button type="button" class="plus ps-plus-minus number-input" data-type="plus"
                                            data-field="quantity[{{ $cart->id }}]"><i class="fa fa-plus"></i></button>
                                    </div>
                                </td>
                                <td class="price" data-title="Price">
                                    <h4 class="text-brand">
                                        Rs.{{ ($cart->price + $cart->tax) * $cart->quantity }} </h4>
                                </td>
                                <td class="action text-center" data-title="Remove"><a href="javascript:void(0)"
                                        onclick="removeFromCartView(event, {{ $cart['id'] }})" class="text-body"><i
                                            class="fi-rs-trash"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="divider-2 mb-30"></div>
                <div class="cart-action d-flex justify-content-between">
                    <a class="btn "><i class="fi-rs-arrow-left mr-10"></i>Continue Shopping</a>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="border p-md-4 cart-totals ml-30">
                    <div class="table-responsive">
                        <table class="table no-border">
                            <tbody>
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Subtotal</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">Rs. {{ $subtotal }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="col" colspan="2">
                                        <div class="divider-2 mt-10 mb-10"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Tax</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h5 class="text-heading text-end">Rs. {{ $tax }}</h5>
                                    </td>
                                </tr>

                                <tr>
                                    <td scope="col" colspan="2">
                                        <div class="divider-2 mt-10 mb-10"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Total</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">Rs. {{ $total }}</h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @auth
                    <a href="{{ route('user.shipping.info') }}" class="btn mb-20 mt-4 w-100">Proceed To CheckOut<i
                            class="fi-rs-sign-out ml-15"></i></a>

                    @endauth
                    @guest
                    <a href="{{ route('auth.login.show') }}" class="btn mb-20 w-100">Login to
                        checkout<i class="fi-rs-sign-out ml-15"></i></a>
                    @endguest

                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-12 col-md-7 col-lg-9">
                <h3 class="ps-shopping__title">Your cart is empty</h3>
            </div>
        </div>
        @endif
    </div>
</main>
