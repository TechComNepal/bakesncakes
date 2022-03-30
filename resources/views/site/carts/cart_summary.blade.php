<div class="container cart_summary">
    <ul class="ps-breadcrumb">
        <li class="ps-breadcrumb__item"><a href="index.html">Home</a></li>
        <li class="ps-breadcrumb__item active" aria- rrent="page">Shopping cart</li>
    </ul>
    <h3 class="ps-shopping__title">Shopping cart<sup>({{ count($carts) }})</sup></h3>
    <div class="ps-shopping__content">
        @if (count($carts) > 0)
            <div class="row">
                <div class="col-12 col-md-7 col-lg-9">
                    <ul class="ps-shopping__list">
                        @php
                            $total = 0;
                            $subtotal = 0;
                            $tax = 0;
                        @endphp

                </ul>
                <div class="ps-shopping__table">
                    <table class="table ps-table ps-table--product">
                        <thead>
                            <tr>
                                <th class="ps-product__remove ps-head">Remove</th>
                                <th class="ps-product__thumbnail ps-head">Image</th>
                                <th class="ps-product__name ps-head">Product name</th>
                                <th class="ps-product__meta ps-head">Unit price</th>
                                <th class="ps-head">Tax</th>
                                <th class="ps-product__quantity ps-head">Quantity</th>
                                <th class="ps-product__subtotal ps-head">Subtotal</th>
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

                                    <tr>
                                        <td class="ps-product__remove">
                                            <a href="javascript:void(0)"
                                                onclick="removeFromCartView(event, {{ $cart['id'] }})"
                                                class="btn btn-icon btn-sm btn-soft-primary btn-circle">
                                                <i class="fa fa-close"></i>
                                            </a>
                                        </td>
                                        <td class="ps-product__thumbnail"><a class="ps-product__image" href="">
                                                <figure><img
                                                        src="{{ $product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}"
                                                        alt></figure>
                                            </a></td>
                                        <td class="ps-product__name">
                                            <a href="javascript:void(0)">{{ $product->name }}</a>
                                            <input value="{{ $product->id }}" type="hidden" name="productId[]">
                                            <br />

                                </td>
                                <td class="ps-product__meta">
                                    @if ($product->discount === 0)
                                    <span class="ps-product__price">Rs.
                                        {{ $product->selling_price }}</span>
                                    @else
                                    @if ($product->discount_type === 'percent')
                                    <span class="ps-product__price">Rs.
                                        {{ $product->selling_price * (1 - $product->discount / 100) }}</span>
                                    <span class="ps-product__del">Rs.
                                        {{ $product->selling_price }}</span>
                                    @else
                                    <span class="ps-product__price">Rs.
                                        {{ $product->selling_price - $product->discount }}</span>
                                    <span class="ps-product__del">Rs.
                                        {{ $product->selling_price }}</span>
                                    @endif
                                    @endif
                                </td>
                                <td class="">
                                    <span class="ps-product__price">Rs. {{ $cart->tax }}</span>
                                </td>
                                <td class="ps-product__quantity">
                                    <div class="def-number-input plus-minus number-input safari_only">
                                        <button type="button" class="minus number-input" data-type="minus"
                                            data-field="quantity[{{ $cart->id }}]"><i class="fa fa-minus"></i></button>
                                        <input class="quantity" min="{{ $product->min_purchase_unit }}"
                                            max="{{ $product->quantity }}" name="quantity[{{ $cart->id }}]"
                                            value="{{ $cart->quantity }}" type="number"
                                            onchange="updateQuantity({{ $cart->id }}, this)">
                                        <button type="button" class="plus number-input" data-type="plus"
                                            data-field="quantity[{{ $cart->id }}]"><i class="fa fa-plus"></i></button>
                                    </div>
                                </td>
                                <td class="ps-product__subtotal">
                                    {{ ($cart->price + $cart->tax) * $cart->quantity }}
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- </form> --}}
            </div>
          
                <!-- Cart Totals -->
                <div class="col-12 col-md-5 col-lg-3 shadow-lg p-4 cart-add">
                    <div class="ps-shopping__label-cart text-center">Cart Total</div>
                    <div class="ps-shopping__box">
                        <div class="ps-shopping__row">
                            <div class="ps-shopping__label">Subtotal</div>
                            <div class="ps-shopping__price">Rs. {{ $subtotal }}</div>
                        </div>
                        <div class="ps-shopping__row">
                            <div class="ps-shopping__label">Tax</div>
                            <div class="ps-shopping__price">Rs. {{ $tax }}</div>
                        </div>
                        <div class="ps-shopping__row">
                            <div class="ps-shopping__label">Total</div>
                            <div class="ps-shopping__price">Rs. {{ $total }}</div>
                        </div>
                        <div class="ps-shopping__checkout">
                            @auth
                                <a class="ps-btn ps-btn--address" href="{{ route('checkout') }}">Proceed to checkout</a>
                            @endauth
                            @guest
                                <a class="ps-btn ps-btn--warning" href="{{ route('auth.login.show') }}">Login to
                                    checkout</a>
                            @endguest

                            <a class="ps-shopping__link ps-btn ps-btn--address"
                                href="{{ route('site.page') }}">Continue
                                Shopping</a>
                        </div>
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
</div>
