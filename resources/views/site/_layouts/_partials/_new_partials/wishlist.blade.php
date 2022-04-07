 <a href="{{ route('wishlist.index') }}">
     <img class="svgInject" alt="Nest" src="{{ asset('new_frontend\assets\imgs\theme\icons\icon-heart.svg') }}">
     @if (Auth::check())
         <span class="pro-count blue">{{ count(Auth::user()->wishlists) }}</span>
     @else
         <span class="pro-count blue">0</span>
     @endif

 </a>
 <a href="{{ route('wishlist.index') }}"><span class="lable">Wishlist</span></a>
