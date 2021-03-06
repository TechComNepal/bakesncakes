 <!-- header -->
 <div class="container">
     <header class="header-area header-style-1 header-height-2">
         <div class="mobile-promotion">
             <span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3 days</strong> left</span>
         </div>
         <div class="header-top header-top-ptb-1 d-none d-lg-block">
             <div class="container">
                 <div class="row align-items-center">
                     <div class="col-xl-3 col-lg-4">
                         <div class="header-info">
                             <ul>
                                 <li><a href="{{ route('site.page.aboutus') }}">About Us</a></li>
                                 <li><a href="{{ route('user.dashboard') }}">My Account</a></li>
                                 <li><a href="{{ route('wishlist.index') }}">Wishlist</a></li>

                             </ul>
                         </div>
                     </div>
                     <div class="col-xl-6 col-lg-4">
                         <div class="text-center">
                             <div id="news-flash" class="d-inline-block">
                                 <ul>
                                     <li>100% Secure delivery without contacting the courier</li>
                                     <li>Supper Value Deals - Save more with coupons</li>
                                     <li>Trendy 25silver jewelry, save up 35% off today</li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                     <div class="col-xl-3 col-lg-4">
                         <div class="header-info header-info-right">
                             <ul>
                                 <li>Need help? Call Us: <strong class="text-brand">
                                         {{ $setting->company_phone }}</strong></li>
                             </ul>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class=" header-middle header-middle-ptb-1 d-none d-lg-block">
             <div class="container">
                 <div class="header-wrap">
                     <div class="logo logo-width-1">
                         <a href="{{ route('site.page') }}"><img src="{{ asset('new_frontend\assets\imgs\theme\bakes-img-assets\mini-pasal.png') }}" alt="logo"></a>
                     </div>
                     <div class=" header-right">
                         <div class="search-style-2">
                             <form action="#">
                                 <select class="select-active">
                                     <option>All Categories</option>
                                     @foreach ($menucategories as $menucategorie)
                                     <option><a href="">{{ $menucategorie->name }}</a></option>
                                     @endforeach
                                 </select>

                                 <form action="#">
                                     <!-- <input type="text" placeholder="Search for items..." name="query"> -->
                                     @livewire('filter')
                                 </form>
                             </form>
                         </div>
                         <div class="header-action-right">
                             <div class="header-action-2">
                                 <!-- <div class="search-location">
                                 <form action="#">
                                         <select class="select-active">
                                             <option>Your Location
                                             </option>
                                             <option>Alabama</option>
                                             <option>Alaska</option>
                                             <option>Arizona</option>
                                             <option>Delaware</option>
                                             <option>Florida</option>
                                             <option>Georgia</option>
                                             <option>Hawaii</option>
                                             <option>Indiana</option>
                                             <option>Maryland</option>
                                             <option>Nevada</option>
                                             <option>New Jersey</option>
                                             <option>New Mexico</option>
                                             <option>New York</option>
                                         </select>
                                     </form>
                                 </div> -->

                                <div class="header-action-icon-2" id="compare">
                                    @include(
                                    'site._layouts._partials._new_partials.compare'
                                    )

                                </div>
                                <div class="header-action-icon-2 wishlist">
                                    @include(
                                    'site._layouts._partials._new_partials.wishlist'
                                    )

                                </div>
                                <span id="refresh_cart">
                                    @include(
                                    'site._layouts._partials._new_partials.new_cart'
                                    )
                                </span>

                                <div class="header-action-icon-2">
                                    <a href="{{ route('user.dashboard') }}">
                                        <img class="svgInject" alt="Nest"
                                            src="{{ asset('new_frontend\assets\imgs\theme\icons\icon-user.svg') }}">
                                    </a>
                                    <a href="{{ route('user.dashboard') }}"><span class="lable ml-0">Account</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            @auth
                                            <li>
                                                <a href="{{ route('user.dashboard') }}"><i
                                                        class="fi fi-rs-user mr-10"></i>My
                                                    Account</a>
                                            </li>


                                            <li>
                                                <a href="{{ route('wishlist.index') }}"><i
                                                        class="fi fi-rs-heart mr-10"></i>My
                                                    Wishlist</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('logout') }}"><i
                                                        class="fi fi-rs-sign-out mr-10"></i>Sign
                                                    out</a>
                                            </li>
                                            @endauth

                                            @guest
                                            <li>
                                                <a href="{{ route('auth.login.show') }}"><i
                                                        class="fi fi-rs-sign-out mr-10"></i>Login
                                                    in</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('auth.register.show') }}"><i
                                                        class="fi fi-rs-user mr-10"></i>
                                                    Register</a>
                                            </li>

                                            @endguest
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="index.html"><img src="{{ asset('new_frontend\assets\imgs\theme\bakes-img-assets\mini-pasal.png') }}"
                                alt="logo"></a>
                    </div>
                    <div class=" header-nav d-none d-lg-flex">
                        <div class="main-categori-wrap d-none d-lg-block">
                            <a class="categories-button-active" href="#">
                                <span class="fi-rs-apps"></span> <span class="et">Browse</span> All
                                Categories
                                <i class="fi-rs-angle-down"></i>
                            </a>
                            <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                                <div class="d-flex categori-dropdown-inner">
                                    <ul>
                                        @foreach ($menucategories->take(6) as $menucategorie)
                                        <li>
                                            <a href="shop-grid-right.html "> <img
                                                    src="{{ $menucategorie->getFirstOrDefaultMediaUrl('image', 'thumb') }}"
                                                    alt="" class="rounded-circle">
                                                {{ $menucategorie->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <ul class=" end">
                                        @foreach ($menucategories->skip(6)->take(6) as $menucategorie)
                                        <li>
                                            <a href="shop-grid-right.html"> <img
                                                    src="{{ $menucategorie->getFirstOrDefaultMediaUrl('image', 'thumb') }}"
                                                    alt="" class="rounded-circle">{{ $menucategorie->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class=" more_slide_open" style="display: none">
                                    <div class="d-flex categori-dropdown-inner">
                                        <ul>
                                            @foreach ($menucategories->skip(12)->take(2) as $menucategorie)
                                            <li>
                                                <a href="shop-grid-right.html"> <img
                                                        src="{{ $menucategorie->getFirstOrDefaultMediaUrl('image', 'thumb') }}"
                                                        alt="" class="rounded-circle">{{ $menucategorie->name }}</a>
                                            </li>
                                            @endforeach

                                        </ul>
                                        <ul class=" end">


                                            @foreach ($menucategories->skip(14)->take(2) as $menucategorie)
                                            <li>
                                                <a href="shop-grid-right.html"> <img
                                                        src="{{ $menucategorie->getFirstOrDefaultMediaUrl('image', 'thumb') }}"
                                                        alt="" class="rounded-circle">{{ $menucategorie->name }}</a>
                                            </li>
                                            @endforeach

                                         </ul>
                                     </div>
                                 </div>
                                 <div class=" more_categories"><span class="icon"></span> <span class="heading-sm-1">Show
                                         more...</span>
                                 </div>
                             </div>
                         </div>
                         <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                             <nav>
                                 <ul>

                                     <a href="{{ route('site.page') }}">Home</a>
                                     </li>

                                    <li>
                                        <a href="{{ route('site.category') }}">Shop</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('site.page.aboutus') }}">About</a>
                                    </li>

                                    <li><!-- 
                                        <a href="{{ route('site.page.vendor') }}">Vendors <i
                                                class="fi-rs-angle-down"></i></a> -->
                                                <a href="{{ route('site.page.vendor') }}">Vendors List</a>
                                        <!-- <ul class="sub-menu">
                                            <li>
                                            </li>
                                            <li><a href="{{ route('site.page.vendor_guide') }}">Vendor Guide</a>
                                            </li>
                                        </ul> -->
                                    </li>
                                    <!-- <li class="position-static">
                                        <a href="#">Mega menu <i class="fi-rs-angle-down"></i></a>
                                        <ul class="mega-menu">
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Fruit &
                                                    Vegetables</a>
                                                <ul>
                                                    <li><a href="shop-product-right.html">Meat
                                                            & Poultry</a></li>
                                                    <li><a href="shop-product-right.html">Fresh
                                                            Vegetables</a></li>
                                                    <li><a href="shop-product-right.html">Herbs
                                                            & Seasonings</a></li>
                                                    <li><a href="shop-product-right.html">Cuts
                                                            & Sprouts</a></li>
                                                    <li><a href="shop-product-right.html">Exotic
                                                            Fruits & Veggies</a></li>
                                                    <li><a href="shop-product-right.html">Packaged
                                                            Produce</a></li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Breakfast &
                                                    Dairy</a>
                                                <ul>
                                                    <li><a href="shop-product-right.html">Milk
                                                            & Flavoured Milk</a></li>
                                                    <li><a href="shop-product-right.html">Butter
                                                            and Margarine</a></li>
                                                    <li><a href="shop-product-right.html">Eggs
                                                            Substitutes</a></li>
                                                    <li><a href="shop-product-right.html">Marmalades</a>
                                                    </li>
                                                    <li><a href="shop-product-right.html">Sour
                                                            Cream</a></li>
                                                    <li><a href="shop-product-right.html">Cheese</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Meat &
                                                    Seafood</a>
                                                <ul>
                                                    <li><a href="shop-product-right.html">Breakfast
                                                            Sausage</a></li>
                                                    <li><a href="shop-product-right.html">Dinner
                                                            Sausage</a></li>
                                                    <li><a href="shop-product-right.html">Chicken</a>
                                                    </li>
                                                    <li><a href="shop-product-right.html">Sliced
                                                            Deli Meat</a></li>
                                                    <li><a href="shop-product-right.html">Wild
                                                            Caught Fillets</a></li>
                                                    <li><a href="shop-product-right.html">Crab
                                                            and Shellfish</a></li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-34">
                                                <div class="menu-banner-wrap">
                                                    <a href="shop-product-right.html"><img
                                                            src="{{ asset('new_frontend\assets\imgs\banner\banner-menu.png') }}"
                                                            alt="Nest"></a>
                                                    <div class=" menu-banner-content">
                                                        <h4>Hot deals</h4>
                                                        <h3>
                                                            Don't miss<br>
                                                            Trending
                                                        </h3>
                                                        <div class="menu-banner-price">
                                                            <span class="new-price text-success">Save
                                                                to 50%</span>
                                                        </div>
                                                        <div class="menu-banner-btn">
                                                            <a href="shop-product-right.html">Shop
                                                                now</a>
                                                        </div>
                                                    </div>
                                                    <div class="menu-banner-discount">
                                                        <h3>
                                                            <span>25%</span>
                                                            off
                                                        </h3>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li> -->
                                    <li>
                                        <a href="{{ route('site.page.blog') }}">Blog</a>
                                    </li>
                                     <li>
                                         <a href="{{ route('site.page.contact') }}">Contact</a>
                                     </li>
                                 </ul>
                             </nav>
                         </div>
                     </div>

                     <div class="header-action-icon-2 d-block d-lg-none">
                         <div class="burger-icon burger-icon-white">
                             <span class="burger-icon-top"></span>
                             <span class="burger-icon-mid"></span>
                             <span class="burger-icon-bottom"></span>
                         </div>
                     </div>
                     <!--Possible Mobile View for top header -->
                     <div class="header-action-right d-block d-lg-none">
                         <div class="header-action-2">
                             <div class="header-action-icon-2">
                                 <a href="shop-wishlist.html">
                                     <img alt="Nest" src="{{ asset('new_frontend\assets\imgs\theme\icons\icon-heart.svg') }}">
                                     <span class="pro-count white">4</span>
                                 </a>
                             </div>
                             <div class="header-action-icon-2">
                                 <a class="mini-cart-icon" href="#">
                                 <span id="refresh_cart">
                                        @include(
                                        'site._layouts._partials._new_partials.new_cart'
                                        )
                                </span>
                                 </a>
                               <!--   <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                     <ul>
                                         <li class="refresh-cart">
                                            
                                         </li>
                                     </ul>
                                     <div class="shopping-cart-footer">
                                         <div class="shopping-cart-button">
                                             <a href="shop-cart.html">View cart</a>
                                             <a href="shop-checkout.html">Checkout</a>
                                         </div>
                                     </div>
                                 </div> -->
                             </div>
                         </div>
                     </div>
                     <!-- End Possible Mobile View for top header  -->
                 </div>
             </div>
         </div>
     </header>
     <div class="">
         <div class="mobile-header-active mobile-header-wrapper-style">
             <div class="mobile-header-wrapper-inner">
                 <div class="mobile-header-top">
                     <div class="mobile-header-logo">
                         <a href="{{ route('site.page') }}"><img src="{{ asset('new_frontend\assets\imgs\theme\bakes-img-assets\mini-pasal.png') }}" alt="logo"></a>
                     </div>
                     <div class=" mobile-menu-close close-style-wrap close-style-position-inherit">
                         <button class="close-style search-close">
                             <i class="icon-top"></i>
                             <i class="icon-bottom"></i>
                         </button>
                     </div>
                 </div>
                 <div class="mobile-header-content-area">
                    <!--  <div class="mobile-search search-style-3 mobile-header-border">
                         <form action="#">
                             <input type="text" placeholder="Search for items???">
                             <button type="submit"><i class="fi-rs-search"></i></button>
                         </form>
                     </div> -->
                     <div class="mobile-menu-wrap mobile-header-border">
                         <!-- mobile menu start -->
                         <nav>
                             <ul class="mobile-menu font-heading">
                                 <li class="menu-item-has-children">
                                     <a href="{{route('site.page')}}">Home</a>


                                </li>
                                <li class="menu-item-has-children">
                                    <a href="{{ route('site.category') }}">shop</a>

                                </li>
                                <li class="menu-item-has-children">
                                    <a href="{{ route('site.page.vendor') }}">Vendors</a>
                                    <li><a href="{{ route('site.page.vendor') }}">Vendors List</a></li>
                                    <!-- <ul class="dropdown"> -->
                                        <!-- <li><a href="{{ route('site.page.vendor_guide') }}">Vendor Guide</a></li>
                                        <li><a href="{{ route('site.page.vendor_guide') }}">Hello</a></li> -->
                                    </ul>
                                </li>
                                <!-- <li class="menu-item-has-children">
                                    <a href="#">Mega menu</a>
                                    <ul class="dropdown">
                                        <li class="menu-item-has-children">
                                            <a href="#">Women's Fashion</a>
                                            <ul class="dropdown">
                                                <li><a href="shop-product-right.html">Dresses</a></li>
                                                <li><a href="shop-product-right.html">Blouses & Shirts</a></li>
                                                <li><a href="shop-product-right.html">Hoodies & Sweatshirts</a></li>
                                                <li><a href="shop-product-right.html">Women's Sets</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="#">Men's Fashion</a>
                                            <ul class="dropdown">
                                                <li><a href="shop-product-right.html">Jackets</a></li>
                                                <li><a href="shop-product-right.html">Casual Faux Leather</a></li>
                                                <li><a href="shop-product-right.html">Genuine Leather</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="#">Technology</a>
                                            <ul class="dropdown">
                                                <li><a href="shop-product-right.html">Gaming Laptops</a></li>
                                                <li><a href="shop-product-right.html">Ultraslim Laptops</a></li>
                                                <li><a href="shop-product-right.html">Tablets</a></li>
                                                <li><a href="shop-product-right.html">Laptop Accessories</a></li>
                                                <li><a href="shop-product-right.html">Tablet Accessories</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
 -->
                                <li class="menu-item-has-children">
                                    <a href="{{ route('site.page.blog') }}">Blog</a>

                                </li>
                                <!-- <li class="menu-item-has-children">
                                     <a href="#">Pages</a>
                                     <ul class="dropdown">
                                         <li><a href="{{ route('site.page.aboutus') }}">About Us</a></li>
                                         <li><a href="{{ route('site.page.contact') }}">Contact</a></li>
                                         <li><a href="page-account.html">My Account</a></li>
                                         <li><a href="{{ route('auth.login.show') }}">Login</a></li>
                                         <li><a href="page-register.html">Register</a></li>
                                         <li><a href="page-purchase-guide.html">Purchase Guide</a></li>
                                         <li><a href="page-privacy-policy.html">Privacy Policy</a></li>
                                         <li><a href="page-terms.html">Terms of Service</a></li>
                                         <li><a href="page-404.html">404 Page</a></li>
                                     </ul>
                                 </li> -->

                            </ul>
                        </nav>
                        <!-- mobile menu end -->
                    </div>
                    <div class="mobile-header-info-wrap">
                        <div class="single-mobile-header-info">
                            <a href="page-contact.html"><i class="fi-rs-marker"></i> Our location </a>
                        </div>
                        <div class="single-mobile-header-info">
                            <a href="{{ route('auth.register.show') }}"><i class="fi-rs-user"></i>Log In / Sign
                                Up </a>
                        </div>
                        <div class="single-mobile-header-info">
                            <a href="#"><i class="fi-rs-headphones"></i>(+977) 9801075755 </a>
                        </div>
                    </div>
                    <div class="mobile-social-icon mb-50">
                        <h6 class="mb-15">Follow Us</h6>
                        <a href="#"><img
                                src="{{ asset('new_frontend\assets\imgs\theme\icons\icon-facebook-white.svg') }}"
                                alt=""></a>
                        <a href="#"><img
                                src="{{ asset('new_frontend\assets\imgs\theme\icons\icon-twitter-white.svg') }}"
                                alt=""></a>
                        <a href="#"><img
                                src="{{ asset('new_frontend\assets\imgs\theme\icons\icon-instagram-white.svg') }}"
                                alt=""></a>
                        <a href="#"><img
                                src="{{ asset('new_frontend\assets\imgs\theme\icons\icon-pinterest-white.svg') }}"
                                alt=""></a>
                        <a href="#"><img
                                src="{{ asset('new_frontend\assets\imgs\theme\icons\icon-youtube-white.svg') }}"
                                alt=""></a>
                    </div>
                    <!-- <div class="site-copyright">Copyright 2021 ?? Nest. All rights reserved. Powered by AliThemes.
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!--End header-->
