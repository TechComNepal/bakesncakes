@php
if (auth()->user() != null) {
    $user_id = \Illuminate\Support\Facades\Auth::user()->id;
    $cart = \App\Models\Cart::where('user_id', $user_id)->get();
} else {
    $tmp_user_id = Session()->get('tmp_user_id');
    if ($tmp_user_id) {
        $cart = \App\Models\Cart::where('tmp_user_id', $tmp_user_id)->get();
    }
}
@endphp

<a class="nav-cart" href="#" id="cart-mini">
    <i class='bx bxs-cart'></i>
    @if (isset($cart) && count($cart) > 0)
        <span>{{ count($cart) }}</span>
    @else
        <span>0</span>
    @endif

</a>

<div class="ps-cart--mini">
    <ul class="ps-cart__items">
        @php $total = 0; @endphp
        @if (isset($cart) && count($cart) > 0)
            @foreach ($cart as $key => $cartItem)
                @php
                    $product = \App\Models\Product::find($cartItem->product_id);
                    $total += $cartItem->price * $cartItem->quantity;
                @endphp
                @if ($product != null)
                    <li class="ps-cart__item">
                        <div class="ps-product--mini-cart">
                            <a class="ps-product__thumbnail" href="#">
                                <img src="{{ $product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}"
                                    alt="alt">
                            </a>
                            <div class="ps-product__content"><a class="ps-product__name" href="#">
                                    {{ \Illuminate\Support\Str::limit($product->name, '30') }}</a>
                                <p class="ps-product__meta"> <span class="ps-product__price">Rs
                                        {{ $cartItem['price'] }} x {{ $cartItem['quantity'] }}</span></p>
                            </div>
                            <a class="ps-product__remove " href="javascript:void(0)"
                                onclick="removeFromCart({{ $cartItem['id'] }})"> <i class='fa fa-close fa-lg'></i></a>
                        </div>
                    </li>
                @endif
            @endforeach
        @endif
    </ul>
    @if (isset($cart) && count($cart) > 0)
        <div class="ps-cart__total"><span>Subtotal </span><span>Rs. {{ $total }}</span></div>
        <div class="ps-cart__footer">
            <a class="ps-btn ps-btn--outline" href="{{ route('cart.index') }}">View Cart</a>
            <a class="ps-btn ps-btn--warning" href="{{ route('checkout') }}">Checkout</a>
        </div>
    @else
        <div class="ps-cart__total"><span>Your Cart is empty </span></div>
    @endif

</div>
