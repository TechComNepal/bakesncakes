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
 <div class="header-action-icon-2">
     <a class="mini-cart-icon" href="#" id="cart-mini">
         <img alt="Nest" src="{{ asset('new_frontend\assets\imgs\theme\icons\icon-cart.svg') }}">
         @if (isset($cart) && count($cart) > 0)
             <span class="pro-count blue">{{ count($cart) }}</span>
         @else
             <span class="pro-count blue">0</span>
         @endif

     </a>
     <a href="shop-cart.html"><span class="lable">Cart</span></a>
     <div class="ps-cart--mini cart-dropdown-wrap cart-dropdown-hm2">
         <ul>
             @php $total = 0; @endphp
             @if (isset($cart) && count($cart) > 0)
                 @foreach ($cart as $key => $cartItem)
                     @php
                         $product = \App\Models\Product::find($cartItem->product_id);
                         $total += $cartItem->price * $cartItem->quantity;
                     @endphp
                     @if ($product != null)
                         <li>
                             <div class="shopping-cart-img">
                                 <a href="#">
                                     <img src="{{ $product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}"
                                         alt="alt">
                                 </a>
                             </div>
                             <div class=" shopping-cart-title">
                                 <h4><a href="#">{{ \Illuminate\Support\Str::limit($product->name, '30') }}</a></h4>


                                 <h3><span>{{ $cartItem['quantity'] }} × </span>Rs.{{ $cartItem['price'] }} </h3>
                             </div>
                             <div class="shopping-cart-delete">
                                 <a href="javascript:void(0)" onclick="removeFromCart({{ $cartItem['id'] }})"><i
                                         class="fi-rs-cross-small"></i></a>
                             </div>
                         </li>
                     @endif
                 @endforeach
             @endif
         </ul>
         @if (isset($cart) && count($cart) > 0)
             <div class="shopping-cart-footer">
                 <div class="shopping-cart-total">
                     <h4>Total <span>Rs. {{ $total }}</span></h4>
                 </div>
                 <div class="shopping-cart-button">
                     <a href="{{ route('cart.index') }}">View cart</a>
                     <a href="{{ route('user.shipping.info') }}">Checkout</a>
                 </div>
             </div>
         @else
             <div class="shopping-cart-total"><span>Your Cart is empty </span></div>
         @endif
     </div>
 </div>
