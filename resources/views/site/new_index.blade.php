<x-new-site-master-layout>
    <section class="home-slider position-relative mb-30">
        <div class="container">
            <div class="home-slide-cover mt-30">
                <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                    @foreach ($sliders->where('is_popup', '!=', true) as $slider)
                        <div class="single-hero-slider single-animation-wrap"
                            style="background-image: url('{{ $slider->getFirstOrDefaultMediaUrl('desktop') }}')">
                            <!-- <div class="slider-content">
                                    <h1 class="display-2 mb-40">
                                        Don’t miss amazing<br>
                                        grocery deals
                                    </h1>
                                    <p class="mb-65">Sign up for the daily newsletter</p>
                                    <form class="form-subcriber d-flex">
                                        <input type="email" placeholder="Your emaill address">
                                        <button class="btn" type="submit">Subscribe</button>
                                    </form>
                                </div> -->
                        </div>
                    @endforeach

                </div>
                <div class="slider-arrow hero-slider-1-arrow"></div>
                <!-- popup slider -->


                <!-- Modal -->
                <div class="modal fade custom-modal" id="onloadModal" tabindex="-1" aria-labelledby="onloadModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog  carousel slide" id="carouselExampleControls" data-bs-ride="carousel">
                        <button type="button" class="btn-close bg-white cursor-pointer" data-bs-dismiss="modal"
                            aria-label="Close" style="cursor:pointer !important;"></button>
                        <div class=" carousel-inner">
                            @foreach ($sliders->where('is_popup', '!=', true) as $slider)
                                <div class="carousel-item @if ($loop->iteration == 1) active @endif ">
                                    <img src="{{ $slider->getFirstOrDefaultMediaUrl('desktop') }}"
                                        class="d-block w-100 img-fluid" alt="slider-img">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>


                <!-- popup slider -->
            </div>
        </div>
    </section>
    <!--End hero slider-->
    <section class="popular-categories section-padding">
        <div class="container wow animate__animated animate__fadeIn">
            <div class="section-title">
                <div class="title">
                    <h3>Featured Categories</h3>
                    <ul class="list-inline nav nav-tabs links">

                        <li class="list-inline-item nav-item"><a class="nav-link" href="shop-grid-right.html">Cake
                                &
                                Milk</a></li>
                        <!-- <li class="list-inline-item nav-item"><a class="nav-link" href="shop-grid-right.html">Coffes & Teas</a></li>
                                <li class="list-inline-item nav-item"><a class="nav-link active" href="shop-grid-right.html">Pet Foods</a></li>
                                <li class="list-inline-item nav-item"><a class="nav-link" href="shop-grid-right.html">Vegetables</a></li> -->
                    </ul>
                </div>
                <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow"
                    id="carausel-10-columns-arrows"></div>
            </div>
            <div class="carausel-10-columns-cover position-relative">
                <div class="carausel-10-columns" id="carausel-10-columns">
                    @foreach ($categories as $category)
                        <div class="card-2 bg-9 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                            <figure class="img-hover-scale overflow-hidden">
                                <a href="shop-grid-right.html"><img
                                        src="{{ $category->getFirstOrDefaultMediaUrl('image', 'thumb') }}" alt=""></a>
                            </figure>
                            <h6><a href="shop-grid-right.html">Cake & Milk</a></h6>
                            <span>26 items</span>
                        </div>
                    @endforeach
                </div>
            </div>
    </section>
    <!--End category slider-->
    <section class="banners mb-25">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <x-advertisement :placement="'Below Slider'" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-8">
                    <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <img src="{{ asset('new_frontend\assets\imgs\banner\banner-2.png') }}" alt="">
                        <div class="banner-text">
                            <h4>
                                Just send us the requirement for
                                cakes that suits according to your needs.
                            </h4>
                            <button class="btn btn-xs" type="submit" data-bs-toggle="modal"
                                data-bs-target="#largeModal">Custom Order <i
                                    class="fi-rs-arrow-small-right"></i></button>
                        </div>
                    </div>
                    <!-- large custom modal -->
                    <div id="largeModal" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg">

                            <div class="modal-content">
                                <div class="book-table-area ptb-10">
                                    <div class="container">
                                        <div class="book-table-wrap"
                                            style="background-color:#f8eff1ec ;background-image: url({{ asset('../images/toppings.png') }})">
                                            <div class="section-title">
                                                <h2>Custom Order</h2>
                                            </div>
                                            <form action="{{ route('site.page.customOrder.store') }}" method="POST"
                                                id="customOrder" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">

                                                            <input type="text" class="form-control" placeholder="Name"
                                                                value="{{ Auth::user()->name ?? '' }}" minlength="8"
                                                                name="name" id="name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <input type="email" class="form-control"
                                                                placeholder="Email"
                                                                value="{{ Auth::user()->email ?? '' }}" name="email"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="City"
                                                                value="{{ Auth::user()->city ?? '' }}" name="city"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                placeholder="Home Address"
                                                                value="{{ Auth::user()->address ?? '' }}"
                                                                name="address" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                placeholder="Mobile Number"
                                                                value="{{ Auth::user()->phone ?? '' }}"
                                                                name="primary_number" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                placeholder="Alternative Number "
                                                                name="secondary_number">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                placeholder="Quantity" name="quantity" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <input type="datetime-local" class="form-control"
                                                                id="arrive" name="date" name="date" required>
                                                            <label for="date" class="mx-2">(Please add
                                                                Delivery Date and
                                                                Time)</label>
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-12">
                                                        <label for="">Your custom Cake : </label>
                                                        <input type="file" class="form-control dropify"
                                                            name="gallery_image[]" id="avatar-img" multiple="multiple"
                                                            required />
                                                    </div>


                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <br>
                                                            <label for="">Description : </label>
                                                            <textarea id="your_message" class="form-control" rows="10" placeholder="Write a message"
                                                                name="description"></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="text-center">

                                                    <button type="submit" class="btn cmn-btn">Send Order</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end large custom modal -->
                </div>
                <div class="col-lg-3 banner-img wow animate__animated animate__fadeInUp">
                    <x-advertisement :placement="'Below Slider'" />
                </div>
            </div>
        </div>
    </section>
    <!--End banners-->

    <!-- Featured Products-->
    <section class="product-tabs section-padding position-relative">
        <div class="container">
            <div class="section-title style-2 wow animate__animated animate__fadeIn">
                <h3>Featured Products</h3>

            </div>
            <!--End nav-tabs-->
            <div class="tab-content" id="myTabContent">

                <div class="row product-grid-4">
                    @foreach ($featured_products as $featured_product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                data-wow-delay=".1s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{ route('site.page.singleProductShow', $featured_product->id) }}">
                                            <img class="default-img"
                                                src="{{ $featured_product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}">
                                            <img class="hover-img"
                                                src="{{ $featured_product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}">
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Add To Wishlist" class="action-btn featured-products_a"
                                            href="javascript:void(0);" id="{{ $featured_product->id }}"
                                            onclick="addToWishList({{ $featured_product->id }})"><i
                                                class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn featured-products_a"
                                            href="javascript:void(0);" id="{{ $featured_product->id }}"
                                            onclick="addToCompare({{ $featured_product->id }})"><i
                                                class="fi-rs-shuffle"></i></a>
                                        <a aria-label="Quick view" class="action-btn featured-products_a"
                                            id="{{ $featured_product->id }}"
                                            onclick="productview({{ $featured_product->id }})"><i
                                                class="fi-rs-eye"></i></a>
                                        {{-- <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a> --}}
                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        <span class="hot">Hot</span>

                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="javascript:void(0)">{{ $featured_product->category->name }}</a>
                                    </div>
                                    <h2><a href="shop-product-right.html">{{ $featured_product->name }}</a></h2>
                                    <div class="product-rate-cover">
                                        <div class="rating">
                                            @php
                                                $num_rating = number_format($featured_product->averageRating);
                                            @endphp
                                            @for ($i = 0; $i < $num_rating; $i++)
                                                <i class="fa fa-star checked"> </i>
                                            @endfor
                                            @for ($j = $num_rating; $j < 5; $j++)
                                                <i class="fa fa-star"> </i>
                                            @endfor
                                            <span class="font-small ml-5 text-muted">
                                                ({{ round($featured_product->averageRating, 1) }})</span>

                                        </div>
                                    </div>
                                    <div>
                                        <span class="font-small text-muted">By <a
                                                href="vendor-details-1.html">{{ $featured_product->user->name }}</a></span>
                                    </div>
                                    <div class="product-card-bottom">
                                        @if ($featured_product->discount === 0)
                                            <div class="product-price">
                                                <span> Rs.{{ $featured_product->selling_price }}</span>
                                            </div>
                                        @else
                                            @if ($featured_product->discount_type === 'percent')
                                                <div class="product-price">
                                                    <span>
                                                        Rs.{{ $featured_product->selling_price * (1 - $featured_product->discount / 100) }}</span>
                                                    <span
                                                        class="old-price">Rs.{{ $featured_product->selling_price }}</span>
                                                </div>
                                            @else
                                                <div class="product-price">
                                                    <span>
                                                        Rs.
                                                        {{ $featured_product->selling_price - $featured_product->discount }}</span>
                                                    <span class="old-price">
                                                        Rs.{{ $featured_product->selling_price }}</span>
                                                </div>
                                            @endif
                                        @endif
                                        <div class="add-cart">
                                            <a href="javascript:void(0);" class="add"
                                                id="{{ $featured_product->id }}"
                                                onclick="productview({{ $featured_product->id }})"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Add
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <!--End product-grid-4-->


            </div>
            <!--End tab-content-->
        </div>
    </section>
    <!--End Featured Products -->

    <!--Products Tabs-->
    <section class="section-padding pb-5">
        <div class="container">
            <div class="section-title wow animate__animated animate__fadeIn">
                <h3 class="">Daily Best Sells</h3>
                <!--  <ul class="nav nav-tabs links" id="myTab-2" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="nav-tab-one-1" data-bs-toggle="tab" data-bs-target="#tab-one-1" type="button" role="tab" aria-controls="tab-one" aria-selected="true">Featured</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="nav-tab-two-1" data-bs-toggle="tab" data-bs-target="#tab-two-1" type="button" role="tab" aria-controls="tab-two" aria-selected="false">Popular</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="nav-tab-three-1" data-bs-toggle="tab" data-bs-target="#tab-three-1" type="button" role="tab" aria-controls="tab-three" aria-selected="false">New added</button>
                            </li>
                        </ul> -->
            </div>
            <div class="row">
                <div class="col-lg-2 d-none d-lg-flex wow animate__animated animate__fadeIn">
                    <!-- <x-advertisement :placement="'Below Featured Categories'" /> -->
                    <div class="banner-img style-2">
                        <div class="banner-text">
                            <h2 class="mb-25 text-white">Bring Foods into your home</h2>
                            <a href="shop-grid-right.html" class="btn btn-xs home-ad-shop-now">Shop Now <i
                                    class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                    <div class="tab-content" id="myTabContent-1">
                        <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel"
                            aria-labelledby="tab-one-1">
                            <div class="carausel-4-columns-cover arrow-center position-relative">
                                <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow"
                                    id="carausel-4-columns-arrows"></div>
                                <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                    @foreach ($best_selling_products as $best_selling_product)
                                        <div class="product-cart-wrap">


                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="shop-product-right.html">
                                                        <img class="default-img"
                                                            src="{{ $best_selling_product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}">
                                                        <img class="hover-img"
                                                            src="{{ $best_selling_product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        href="javascript:void(0);"
                                                        id="{{ $best_selling_product->id }}"
                                                        onclick="productview({{ $best_selling_product->id }})"> <i
                                                            class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">Save 15%</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a
                                                        href="shop-grid-right.html">{{ $best_selling_product->category->name }}</a>
                                                </div>
                                                <h2><a
                                                        href="shop-product-right.html">{{ $best_selling_product->name }}</a>
                                                </h2>

                                                <div class="rating">
                                                    @php
                                                        $num_rating = number_format($best_selling_product->averageRating);
                                                    @endphp
                                                    @for ($i = 0; $i < $num_rating; $i++)
                                                        <i class="fa fa-star checked">
                                                        </i>
                                                    @endfor
                                                    @for ($j = $num_rating; $j < 5; $j++)
                                                        <i class="fa fa-star"> </i>
                                                    @endfor
                                                    <span class="font-small ml-5 text-muted">
                                                        ({{ round($best_selling_product->averageRating, 1) }})</span>
                                                </div>

                                                @if ($best_selling_product->discount === 0)
                                                    <div class="product-price">
                                                        <span> Rs.{{ $best_selling_product->selling_price }}</span>
                                                    </div>
                                                @else
                                                    @if ($best_selling_product->discount_type === 'percent')
                                                        <div class="product-price">
                                                            <span>
                                                                Rs.{{ $best_selling_product->selling_price * (1 - $best_selling_product->discount / 100) }}</span>
                                                            <span
                                                                class="old-price">Rs.{{ $best_selling_product->selling_price }}</span>
                                                        </div>
                                                    @else
                                                        <div class="product-price">
                                                            <span>
                                                                {{ $best_selling_product->selling_price - $best_selling_product->discount }}</span>
                                                            <span
                                                                class="old-price">{{ $best_selling_product->selling_price }}</span>
                                                        </div>
                                                    @endif
                                                @endif
                                                <div class="sold mt-15 mb-15">
                                                    <div class="progress mb-5">
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: 50%" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    @php
                                                        $total_order_quantity = 0;
                                                        foreach ($best_selling_product->orders as $order) {
                                                            $total_order_quantity = $total_order_quantity + $order->pivot->quantity;
                                                        }
                                                        $total_quantity = $best_selling_product->quantity + $total_order_quantity;
                                                    @endphp
                                                    <span class="font-xs text-heading"> Sold:
                                                        {{ $total_order_quantity }}/{{ $total_quantity }}</span>
                                                </div>
                                                <a href="javascript:void(0);" class="btn w-100 hover-up"
                                                    id="{{ $best_selling_product->id }}"
                                                    onclick="productview({{ $best_selling_product->id }})"><i
                                                        class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
    <!--End Best Sales-->
    <section class="section-padding pb-5">
        <div class="container">
            <div class="section-title wow animate__animated animate__fadeIn" data-wow-delay="0">
                <h3 class="">Deals Of The Day</h3>
                <a class="show-all" href="shop-grid-right.html">
                    All Deals
                    <i class="fi-rs-angle-right"></i>
                </a>
            </div>
            <div class="row">
                @foreach ($trending_products as $trending_product)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="product-cart-wrap style-2 wow animate__animated animate__fadeInUp"
                            data-wow-delay="0">
                            <div class="product-img-action-wrap">
                                <div class="product-img">
                                    <a href="shop-product-right.html">
                                        <img
                                            src="{{ $trending_product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}">
                                    </a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="deals-countdown-wrap">
                                    <div class="deals-countdown" data-countdown="2025/03/25 00:00:00"></div>
                                </div>
                                <div class="deals-content">
                                    <h2><a href="shop-product-right.html">{{ $trending_product->name }}</a></h2>
                                    <div class="product-rate-cover">
                                        <div class="rating">
                                            @php
                                                $num_rating = number_format($trending_product->averageRating);
                                            @endphp
                                            @for ($i = 0; $i < $num_rating; $i++)
                                                <i class="fa fa-star checked"> </i>
                                            @endfor
                                            @for ($j = $num_rating; $j < 5; $j++)
                                                <i class="fa fa-star"> </i>
                                            @endfor
                                            <span class="font-small ml-5 text-muted">
                                                ({{ round($trending_product->averageRating, 1) }})</span>
                                        </div>

                                    </div>
                                    <div>
                                        <span class="font-small text-muted">By <a
                                                href="vendor-details-1.html">{{ $trending_product->user->name }}</a></span>
                                    </div>
                                    <div class="product-card-bottom">
                                        @if ($trending_product->discount === 0)
                                            <div class="product-price">
                                                <span> Rs.{{ $trending_product->selling_price }}</span>
                                            </div>
                                        @else
                                            @if ($trending_product->discount_type === 'percent')
                                                <div class="product-price">
                                                    <span>
                                                        Rs.{{ $trending_product->selling_price * (1 - $trending_product->discount / 100) }}</span>
                                                    <span
                                                        class="old-price">Rs.{{ $trending_product->selling_price }}</span>
                                                </div>
                                            @else
                                                <div class="product-price">
                                                    <span>
                                                        Rs.
                                                        {{ $trending_product->selling_price - $trending_product->discount }}</span>
                                                    <span
                                                        class="old-price">Rs.{{ $trending_product->selling_price }}</span>
                                                </div>
                                            @endif
                                        @endif
                                        <div class="add-cart">
                                            <a class="add" href="shop-cart.html"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Add
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!--
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="product-cart-wrap style-2 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img">
                                        <a href="shop-product-right.html">
                                            <img src="{{ asset('new_frontend\assets\imgs\banner\banner-6.png" alt="') }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="deals-countdown-wrap">
                                        <div class="deals-countdown" data-countdown="2026/04/25 00:00:00"></div>
                                    </div>
                                    <div class="deals-content">
                                        <h2><a href="shop-product-right.html">Perdue Simply Smart Organics Gluten Free</a></h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">Old El Paso</a></span>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span>$24.85</span>
                                                <span class="old-price">$26.8</span>
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 d-none d-lg-block">
                            <div class="product-cart-wrap style-2 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img">
                                        <a href="shop-product-right.html">
                                            <img src="{{ asset('new_frontend\assets\imgs\banner\banner-7.png" alt="') }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="deals-countdown-wrap">
                                        <div class="deals-countdown" data-countdown="2027/03/25 00:00:00"></div>
                                    </div>
                                    <div class="deals-content">
                                        <h2><a href="shop-product-right.html">Signature Wood-Fired Mushroom and Caramelized</a></h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 80%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (3.0)</span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">Progresso</a></span>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span>$12.85</span>
                                                <span class="old-price">$13.8</span>
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 d-none d-xl-block">
                            <div class="product-cart-wrap style-2 wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img">
                                        <a href="shop-product-right.html">
                                            <img src="{{ asset('new_frontend\assets\imgs\banner\banner-8.png" alt="') }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="deals-countdown-wrap">
                                        <div class="deals-countdown" data-countdown="2025/02/25 00:00:00"></div>
                                    </div>
                                    <div class="deals-content">
                                        <h2><a href="shop-product-right.html">Simply Lemonade with Raspberry Juice</a></h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 80%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (3.0)</span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted">By <a href="vendor-details-1.html">Yoplait</a></span>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span>$15.85</span>
                                                <span class="old-price">$16.8</span>
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
            </div>
        </div>
    </section>
    <!--End Deals-->
    <section class="section-padding mb-30">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp"
                    data-wow-delay="0">
                    <h4 class="section-title style-1 mb-30 animated animated">Top Selling</h4>
                    @foreach ($top_selling_products as $top_selling_product)
                        <div class="product-list-small animated animated">
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="shop-product-right.html"><img
                                            src="{{ $top_selling_product->getFirstOrDefaultMediaUrl('image', 'thumb') }}"
                                            alt=""></a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="shop-product-right.html">{{ $top_selling_product->name }}</a>
                                    </h6>
                                    <div class="rating">
                                        @php
                                            $num_rating = number_format($top_selling_product->averageRating);
                                        @endphp
                                        @for ($i = 0; $i < $num_rating; $i++)
                                            <i class="fa fa-star checked"> </i>
                                        @endfor
                                        @for ($j = $num_rating; $j < 5; $j++)
                                            <i class="fa fa-star"> </i>
                                        @endfor
                                        <span class="font-small ml-5 text-muted">
                                            ({{ round($top_selling_product->averageRating, 1) }})</span>
                                    </div>
                                    @if ($top_selling_product->discount === 0)
                                        <div class="product-price">
                                            <span> Rs.{{ $top_selling_product->selling_price }}</span>
                                        </div>
                                    @else
                                        @if ($top_selling_product->discount_type === 'percent')
                                            <div class="product-price">
                                                <span>
                                                    Rs.{{ $top_selling_product->selling_price * (1 - $top_selling_product->discount / 100) }}</span>
                                                <span
                                                    class="old-price">Rs.{{ $top_selling_product->selling_price }}</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span>
                                                    Rs.{{ $top_selling_product->selling_price - $top_selling_product->discount }}</span>
                                                <span
                                                    class="old-price">Rs.{{ $top_selling_product->selling_price }}</span>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp"
                    data-wow-delay=".1s">
                    <h4 class="section-title style-1 mb-30 animated animated">Trending Products</h4>
                    @foreach ($trending_products as $trending_product)
                        <div class="product-list-small animated animated">
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="shop-product-right.html"><img
                                            src="{{ $trending_product->getFirstOrDefaultMediaUrl('image', 'thumb') }}"
                                            alt=""></a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="shop-product-right.html">{{ $trending_product->name }}</a>
                                    </h6>
                                    <div class="rating">
                                        @php
                                            $num_rating = number_format($trending_product->averageRating);
                                        @endphp
                                        @for ($i = 0; $i < $num_rating; $i++)
                                            <i class="fa fa-star checked"> </i>
                                        @endfor
                                        @for ($j = $num_rating; $j < 5; $j++)
                                            <i class="fa fa-star"> </i>
                                        @endfor
                                        <span class="font-small ml-5 text-muted">
                                            ({{ round($trending_product->averageRating, 1) }})</span>
                                    </div>
                                    @if ($trending_product->discount === 0)
                                        <div class="product-price">
                                            <span> Rs.{{ $trending_product->selling_price }}</span>
                                        </div>
                                    @else
                                        @if ($trending_product->discount_type === 'percent')
                                            <div class="product-price">
                                                <span>
                                                    Rs.{{ $trending_product->selling_price * (1 - $trending_product->discount / 100) }}</span>
                                                <span
                                                    class="old-price">Rs.{{ $trending_product->selling_price }}</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span>
                                                    Rs.{{ $trending_product->selling_price - $trending_product->discount }}</span>
                                                <span
                                                    class="old-price">Rs.{{ $trending_product->selling_price }}</span>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </article>
                        </div>
                    @endforeach

                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp"
                    data-wow-delay=".2s">
                    <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
                    @foreach ($recent_products as $recent_product)
                        <div class="product-list-small animated animated">
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="shop-product-right.html"><img
                                            src="{{ $recent_product->getFirstOrDefaultMediaUrl('image', 'thumb') }}"
                                            alt=""></a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="shop-product-right.html">{{ $recent_product->name }}</a>
                                    </h6>
                                    <div class="rating">
                                        @php
                                            $num_rating = number_format($recent_product->averageRating);
                                        @endphp
                                        @for ($i = 0; $i < $num_rating; $i++)
                                            <i class="fa fa-star checked"> </i>
                                        @endfor
                                        @for ($j = $num_rating; $j < 5; $j++)
                                            <i class="fa fa-star"> </i>
                                        @endfor
                                        <span class="font-small ml-5 text-muted">
                                            ({{ round($recent_product->averageRating, 1) }})</span>
                                    </div>
                                    @if ($recent_product->discount === 0)
                                        <div class="product-price">
                                            <span> Rs.{{ $recent_product->selling_price }}</span>
                                        </div>
                                    @else
                                        @if ($recent_product->discount_type === 'percent')
                                            <div class="product-price">
                                                <span>
                                                    Rs.{{ $recent_product->selling_price * (1 - $recent_product->discount / 100) }}</span>
                                                <span
                                                    class="old-price">Rs.{{ $recent_product->selling_price }}</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span>
                                                    Rs.{{ $recent_product->selling_price - $recent_product->discount }}</span>
                                                <span
                                                    class="old-price">Rs.{{ $recent_product->selling_price }}</span>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
                <!-- Top Rated Products -->
                <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp"
                    data-wow-delay=".3s">
                    <h4 class="section-title style-1 mb-30 animated animated">Top Rated</h4>
                    <div class="product-list-small animated animated">
                        @foreach ($rated_products as $rated_product)
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="shop-product-right.html"><img
                                            src="{{ $rated_product->getFirstOrDefaultMediaUrl('image', 'thumb') }}"
                                            alt=""></a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="shop-product-right.html">{{ $rated_product->name }}</a>
                                    </h6>
                                    <div class="rating">
                                        @php
                                            $num_rating = number_format($rated_product->averageRating);
                                        @endphp
                                        @for ($i = 0; $i < $num_rating; $i++)
                                            <i class="fa fa-star checked"> </i>
                                        @endfor
                                        @for ($j = $num_rating; $j < 5; $j++)
                                            <i class="fa fa-star"> </i>
                                        @endfor
                                        <span class="font-small ml-5 text-muted">
                                            ({{ round($rated_product->averageRating, 1) }})</span>
                                    </div>
                                    @if ($rated_product->discount === 0)
                                        <div class="product-price">
                                            <span> Rs.{{ $rated_product->selling_price }}</span>
                                        </div>
                                    @else
                                        @if ($rated_product->discount_type === 'percent')
                                            <div class="product-price">
                                                <span>
                                                    Rs.{{ $rated_product->selling_price * (1 - $rated_product->discount / 100) }}</span>
                                                <span
                                                    class="old-price">Rs.{{ $rated_product->selling_price }}</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span>
                                                    Rs.{{ $rated_product->selling_price - $rated_product->discount }}</span>
                                                <span
                                                    class="old-price">Rs.{{ $rated_product->selling_price }}</span>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                <!--End of top rated products -->
            </div>
        </div>
    </section>
    <!--End 4 columns-->
</x-new-site-master-layout>
