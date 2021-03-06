<!-- footer -->
<footer class="main">
    <section class="newsletter mb-15 wow animate__animated animate__fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="position-relative newsletter-inner">
                        <div class="newsletter-content">
                            <h2 class="mb-20 text-white">
                                Stay home & get your daily <br>
                                needs from our shop
                            </h2>
                            <p class="mb-45 text-white">Start You'r Daily Shopping with <span class="text-brand">{{ config('app.name') ?? 'Bakes n Cakes' }}</span>
                            </p>

                            <form class="form-subcriber d-flex" id="news-form">
                                <input type="email" name="email" id="email" placeholder="Your email address">
                                <button id="news-btn" class="btn" type="submit">Subscribe</button>
                                <span class="text-warning error-text email_error ml-5"></span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="featured section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mb-md-4 mb-xl-0">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <div class="banner-icon">
                            <img src="{{asset('new_frontend/assets/imgs/theme/bakes-img-assets/best-price.png')}}" alt=''>
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Best offers</h3>
                            <p>Orders $50 or more</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <div class="banner-icon">
                            <img src="{{ asset('new_frontend/assets/imgs/theme/bakes-img-assets/delivery.png' ) }}" alt=''>
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Free delivery</h3>
                            <p>24/7 amazing services</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <div class="banner-icon">
                            <img src="{{ asset('new_frontend\assets\imgs\theme\bakes-img-assets\great-deal.png' ) }}" alt='great-deal'>
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Great daily deal</h3>
                            <p>When you sign up</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                        <div class="banner-icon">
                            <img src="{{asset('new_frontend\assets\imgs\theme\bakes-img-assets\wide-assortment.png')}}" alt='wide-assortment'>
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Wide assortment</h3>
                            <p>Mega Discounts</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                        <div class="banner-icon">
                            <img src="{{ asset('new_frontend\assets\imgs\theme\bakes-img-assets\easy-return.png') }}" alt='easy-return'>
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Easy returns</h3>
                            <p>Within 30 days</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-xl-none">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".5s">
                        <div class="banner-icon">
                            <img src="{{ asset('new_frontend\assets\imgs\theme\bakes-img-assets\delivery.png')}}" alt='delivery service'>
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Safe delivery</h3>
                            <p>Within 24 Hours</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col">
                    <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <div class="logo mb-30">
                            <a href="index.html" class="mb-15"><img src="{{ asset('new_frontend\assets\imgs\theme\MINIPASAL@4X-8(1).png') }}" alt="logo"></a>
                            <p class=" font-lg text-heading">Awesome Multipurpose store website </p>
                        </div>
                        <ul class="contact-infor">
                            <li><img src="{{ asset('new_frontend\assets\imgs\theme\bakes-img-assets\location@4x.png') }}" alt=""><strong>Address: </strong> <span> Durbarmarg, Kathmandu, Nepal</span></li>
                            <li><img src="
                                    {{ asset('new_frontend\assets\imgs\theme\bakes-img-assets\headphone@4x.png') }}" alt=""><strong>Call Us:</strong><span> (+977) - 9801075755</span></li>
                            <li><img src="{{ asset('new_frontend\assets\imgs\theme\bakes-img-assets\share@4x.png') }}" alt=""><strong>Email:</strong><span><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="493a28252c09072c3a3d672a2624">avi.pradhan1987@gmail.com</a></span>
                            </li>
                            <li><img src="
                                        {{ asset('new_frontend\assets\imgs\theme\bakes-img-assets\Time@4x.png') }}" alt=""><strong>Hours:</strong><span> 09:00 - 20:00, Sun - Sat</span></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                    <h4 class="widget-title">Company</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="{{ route('site.page.aboutus') }}">About Us</a></li>
                        <li><a href="#">Delivery Information</a></li>
                        <li><a href="{{ route('site.page.privacyAndPolicy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('site.page.termsAndCondition') }}">Terms &amp; Conditions</a></li>
                        <li><a href="{{ route('site.page.contact') }}">Contact Us</a></li>
                        <!-- <li><a href="#">Support Center</a></li> -->
                        <!-- <li><a href="#">Careers</a></li> -->
                    </ul>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                    <h4 class="widget-title">Account</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="{{ route('auth.register.show') }}">Sign In</a></li>
                        <li><a href="{{ route('cart.index') }}">">View Cart</a></li>
                        <!-- <li><a href="#">My Wishlist</a></li>
                        <li><a href="#">Track My Order</a></li>
                        <li><a href="#">Help Ticket</a></li>
                        <li><a href="#">Shipping Details</a></li>
                        <li><a href="#">Compare products</a></li> -->
                    </ul>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                    <h4 class="widget-title">Corporate</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <!-- <li><a href="#">Become a Vendor</a></li> -->
                        <!-- <li><a href="#">Promotions</a></li> -->
                    </ul>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                    <h4 class="widget-title">Popular Product</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <!-- popular category show -->
                        @foreach ($menuproducts->take(6) as $menuproduct)
                        <li>
                            <a href="#">
                                {{ $menuproduct->name }}</a>
                        </li>
                        @endforeach

                    </ul>
                </div>
                <div class="footer-link-widget widget-install-app col wow animate__animated animate__fadeInUp" data-wow-delay=".5s">
                    <h4 class="widget-title">Pay from Anywhere</h4>
                    <p class=" mb-20">Secured Payment Gateways</p>
                    <img class="" src="{{ asset('new_frontend\assets\imgs\theme\payment-method.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>
    <div class="container pb-30 wow animate__animated animate__fadeInUp" data-wow-delay="0">
        <div class="row align-items-center">
            <div class="col-12 mb-30">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <p class="font-sm mb-0">&copy; 2022, <strong class="text-primary">Tech Community Nepal</strong><br>All rights reserved</p>
            </div>
            <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">
                <div class="hotline d-lg-inline-flex mr-30">
                    <img src="{{ asset('new_frontend\assets\imgs\theme\icons\phone-call.svg') }}" alt="hotline">
                    <p>9801075755<span>Working 9:00 - 20:00</span></p>
                </div>
                <!--
                <div class="hotline d-lg-inline-flex">
                    <img src="{{ asset('new_frontend\assets\imgs\theme\icons\phone-call.svg') }}" alt="hotline">
                    <p>014226354<span>24/7 Support Center</span></p>
                </div> -->
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block">
                <div class="mobile-social-icon">
                    <h6>Follow Us</h6>
                    <a href="https://www.facebook.com/BakesnCakes"><img src="{{ asset('new_frontend\assets\imgs\theme\icons\icon-facebook-white.svg') }}" alt=""></a>
                    <a href=" https://twitter.com/bakesncakes"><img src="{{ asset('new_frontend\assets\imgs\theme\icons\icon-twitter-white.svg') }}" alt=""></a>
                    <a href="https://www.instagram.com/bakesncakes_nepal/"><img src="{{ asset('new_frontend\assets\imgs\theme\icons\icon-instagram-white.svg') }}" alt=""></a>
                    <a href=" #"><img src="{{ asset('new_frontend\assets\imgs\theme\icons\icon-pinterest-white.svg') }}" alt=""></a>
                    <a href=" #"><img src="{{ asset('new_frontend\assets\imgs\theme\icons\icon-youtube-white.svg') }}" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->
