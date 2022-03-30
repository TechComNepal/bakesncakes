<x-site-master-layout>

    @push('styles')
    <style>
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/theme-default.min.css" integrity="sha512-8wU/gsExpTv8PS32juUjuZx10OBHgxj5ZWoVDoJKvBrFy524wEKAUgS/64da3Qg4zD5kVwQh3+xFmzzOzFDAtg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush

    <div class="banner-area">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($sliders->where('is_popup', '!=', true) as $slider)
                <div class="carousel-item @if ($loop->iteration == 1) active @endif ">
                    <img src="{{ $slider->getFirstOrDefaultMediaUrl('desktop') }}" class="d-block w-100 img-fluid"
                        alt="slider-img">

                </div>
                @endforeach
            </div>
            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button> --}}
        </div>
        <div class="d-table slider-info">
            <div class="d-table-cell">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="banner-content">
                                <h1>The Perfect <br> Baked Cakes</h1>
                                <p>Bakery and baked goods like breads,
                                    sweet rolls,coffee cake and tortillas</p>
                                <form action="{{ route('site.page.search') }}">
                                    <input class="form-control  slider-search" placeholder="Enter food name" type="text"
                                        name="query">
                                    <button class="btn slider-search-btn" type="submit">Search
                                        Now</button>
                                </form>
                            </div>
                        </div>

                        <!--Slider Section -->
                        {{-- <div class="col-lg-6">
                            <div class="banner-slider owl-theme owl-carousel">
                                @foreach ($sliders->where('is_popup', '!=', true) as $slider)
                                <div class="slider-item">
                                    <img alt="Slider"
                                        src="{{ $slider->getFirstOrDefaultMediaUrl('desktop', 'mid_thumb') }}">
                                </div>
                                @endforeach
                            </div>
                        </div> --}}
                        <!--End Slider Section -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-advertisement :placement="'Below Slider'" />
    <!-- Featured Category -->
    <section class="feature-area pb-70">
        <div class="container">
            <div class="section-title">
                <h2>Featured Categories</h2>
            </div>

            <div class="row">
                @foreach ($categories as $category)
                <div class="col-sm-6 col-lg-3">
                    <div class="feature-item">
                        {{-- <img src="{{  }}" alt="client"> --}}

                        <img alt="Feature" src="{{ $category->getFirstOrDefaultMediaUrl('image', 'thumb') }}">
                        <div class="feature-inner">
                            <ul>
                                <li>
                                    <img alt="Feature" src="{{ asset('site/img/home-one/feature1.png') }}">
                                </li>
                                <li>
                                    <span>{{ $category->name }}</span>
                                </li>
                                <li>
                                    <a href="{{route('site.category')}}">
                                        <i class='bx bx-right-arrow-alt'></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--End Feature Category -->




    
    <!-- custom order -->
    
    <section class="reservation-area">
        <div class="reservation-shape">
            <img alt="Shape" src="{{ asset('demo_images/order-02.jpg') }}">
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="reservation-item">
                        <div class="section-title">
                            <h2>Would you like to place a Custom Order or have a special request? </h2>
                            <p>Our customers can provide their custom orders according to their designs or custom
                                desires. Just send us the requirement for
                                cakes that suits according to your needs.</p>
                        </div>

                        <!-- Large modal -->
                        <button class="ps-btn cmn-btn-outline" type="submit" data-bs-toggle="modal"
                            data-bs-target="#largeModal">Order Now</button>


                    </div>
                </div>
                {{-- <div class="col-lg-6">
                    <div class="reservation-img">
                        <img alt="Reservation" src="{{ asset('site/img/home-one/reservation.png') }}">
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- end custom order -->


    <!--  -->
    
    
    
    <!-- ads -->
    <x-advertisement :placement="'Below Featured Categories'" />


    <!-- food collection -->
    
    <section class="collection-area pb-100">
        <div class="container">
            <div class="section-title">
                <h2>Our Regular Food Collections</h2>
                <p>We make it happen fast! Let us help you with your next special day.
                    .</p>
            </div>
            <div class="sorting-menu">
                <ul>
                    <li class="filter active" data-filter="all">All</li>
                    {{-- <li class="filter" data-filter=".web">Fast Food</li> --}}
                    @foreach ($productCategories as $category)
                    <li class="filter active" data-filter=".{{$category->slug}}">{{ $category->name }}</li>
                    @endforeach

                </ul>
            </div>

            <div class="row" id="Container">



                    @foreach ($productCategories as $category)
                        @foreach($category->products->take(4) as $product)
                            <div class="col-sm-6 col-lg-3 mix {{$product->category->slug}}">
                                <div class="collection-item">
                                    <div class="collection-top">
                                        <a href="{{ route('site.page.singleProductShow', $product->id) }}">
                                            <img alt="Collection"
                                                 src="{{ $product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}">
                                        </a>
                                        <ul>
                                            <li>
                                                <i class='bx bxs-star checked'></i>
                                            </li>

                                            <li>
                                                <i class='bx bxs-star checked'></i>
                                            </li>

                                            <li>
                                                <i class='bx bxs-star checked'></i>
                                            </li>

                                            <li>
                                                <i class='bx bxs-star checked'></i>
                                            </li>

                                            <li>
                                                <i class='bx bxs-star unchecked'></i>
                                            </li>
                                        </ul>

                                        <div class="add-cart">
                                            <a href="javascript:void(0);" id="{{ $product->id }}"
                                               onclick="productview({{ $product->id }})">
                                                <i class='bx bxs-cart'></i>
                                                Add to Cart
                                            </a>
                                        </div>

                                    </div>
                                    <div class="collection-bottom">
                                        <h3>{{ $product->name }}</h3>
                                        <ul>
                                            <li>
                                                <span>Rs.{{ $product->selling_price }}</span>
                                            </li>
                                            <li>

                                                <div class="add-cart-list">
                                                    <a href="javascript:void(0);" id="{{ $product->id }}"
                                                       onclick="productview({{ $product->id }})">
                                                        <i class='bx bxs-cart add-cart-list'></i>
                                                        Add to Cart
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach

                {{-- <div class="row" id="Container">
                    <div class="col-sm-6 col-lg-3 {{ $category->slug }}">
                        <div class="collection-item">
                            <div class="collection-top">
                                <img alt="Collection" src="{{ asset('site/img/home-one/collection/1.jpg') }}">
                                <ul>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                </ul>
                                <div class="add-cart">
                                    <a href="#">
                                        <i class='bx bxs-cart'></i>
                                        Add to Cart
                                    </a>
                                </div>
                            </div>
                            <div class="collection-bottom">
                                <h3>Dark Chocolate Cake</h3>
                                <ul>
                                    <li>
                                        <span>$25</span>
                                    </li>
                                    <li>
                                        <div class="number">
                                            <span class="minus">-</span>
                                            <input class="form-control" type="text" value="1" />
                                            <span class="plus">+</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mix ui">
                        <div class="collection-item">
                            <div class="collection-top">
                                <img alt="Collection" src="{{ asset('site/img/home-one/collection/2.jpg') }}">
                                <ul>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star'></i>
                                    </li>
                                </ul>
                                <div class="add-cart">
                                    <a href="#">
                                        <i class='bx bxs-cart'></i>
                                        Add to Cart
                                    </a>
                                </div>
                            </div>
                            <div class="collection-bottom">
                                <h3>Cake with Drinks</h3>
                                <ul>
                                    <li>
                                        <span>$15</span>
                                    </li>
                                    <li>
                                        <div class="number">
                                            <span class="minus">-</span>
                                            <input class="form-control" type="text" value="1" />
                                            <span class="plus">+</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mix ux ui">
                        <div class="collection-item">
                            <div class="collection-top">
                                <img alt="Collection" src="{{ asset('site/img/home-one/collection/3.jpg') }}">
                                <ul>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star'></i>
                                    </li>
                                </ul>
                                <div class="add-cart">
                                    <a href="#">
                                        <i class='bx bxs-cart'></i>
                                        Add to Cart
                                    </a>
                                </div>
                            </div>
                            <div class="collection-bottom">
                                <h3>Doughnut Chocolate</h3>
                                <ul>
                                    <li>
                                        <span>$20</span>
                                    </li>
                                    <li>
                                        <div class="number">
                                            <span class="minus">-</span>
                                            <input class="form-control" type="text" value="1" />
                                            <span class="plus">+</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mix branding web">
                        <div class="collection-item">
                            <div class="collection-top">
                                <img alt="Collection" src="{{ asset('site/img/home-one/collection/4.jpg') }}">
                                <ul>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star'></i>
                                    </li>
                                </ul>
                                <div class="add-cart">
                                    <a href="#">
                                        <i class='bx bxs-cart'></i>
                                        Add to Cart
                                    </a>
                                </div>
                            </div>
                            <div class="collection-bottom">
                                <h3>Dark Chocolate Cake</h3>
                                <ul>
                                    <li>
                                        <span>$23</span>
                                    </li>
                                    <li>
                                        <div class="number">
                                            <span class="minus">-</span>
                                            <input class="form-control" type="text" value="1" />
                                            <span class="plus">+</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mix web branding">
                        <div class="collection-item">
                            <div class="collection-top">
                                <img alt="Collection" src="{{ asset('site/img/home-one/collection/5.jpg') }}">
                                <ul>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                </ul>
                                <div class="add-cart">
                                    <a href="#">
                                        <i class='bx bxs-cart'></i>
                                        Add to Cart
                                    </a>
                                </div>
                            </div>
                            <div class="collection-bottom">
                                <h3>Sweet Dougnuts</h3>
                                <ul>
                                    <li>
                                        <span>$35</span>
                                    </li>
                                    <li>
                                        <div class="number">
                                            <span class="minus">-</span>
                                            <input class="form-control" type="text" value="1" />
                                            <span class="plus">+</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mix ui web">
                        <div class="collection-item">
                            <div class="collection-top">
                                <img alt="Collection" src="{{ asset('site/img/home-one/collection/6.jpg') }}">
                                <ul>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star'></i>
                                    </li>
                                </ul>
                                <div class="add-cart">
                                    <a href="#">
                                        <i class='bx bxs-cart'></i>
                                        Add to Cart
                                    </a>
                                </div>
                            </div>
                            <div class="collection-bottom">
                                <h3>Birthday Cake</h3>
                                <ul>
                                    <li>
                                        <span>$32</span>
                                    </li>
                                    <li>
                                        <div class="number">
                                            <span class="minus">-</span>
                                            <input class="form-control" type="text" value="1" />
                                            <span class="plus">+</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mix ux branding">
                        <div class="collection-item">
                            <div class="collection-top">
                                <img alt="Collection" src="{{ asset('site/img/home-one/collection/7.jpg') }}">
                                <ul>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star'></i>
                                    </li>
                                </ul>
                                <div class="add-cart">
                                    <a href="#">
                                        <i class='bx bxs-cart'></i>
                                        Add to Cart
                                    </a>
                                </div>
                            </div>
                            <div class="collection-bottom">
                                <h3>Chocolate Ice Cream</h3>
                                <ul>
                                    <li>
                                        <span>$28</span>
                                    </li>
                                    <li>
                                        <div class="number">
                                            <span class="minus">-</span>
                                            <input class="form-control" type="text" value="1" />
                                            <span class="plus">+</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mix branding ui">
                        <div class="collection-item">
                            <div class="collection-top">
                                <img alt="Collection" src="{{ asset('site/img/home-one/collection/8.jpg') }}">
                                <ul>
                                    <li>
                                        <i class='bx bxs-star checked'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star'></i>
                                    </li>
                                    <li>
                                        <i class='bx bxs-star'></i>
                                    </li>
                                </ul>
                                <div class="add-cart">
                                    <a href="#">
                                        <i class='bx bxs-cart'></i>
                                        Add to Cart
                                    </a>
                                </div>
                            </div>
                            <div class="collection-bottom">
                                <h3>Dark Chocolate Cake</h3>
                                <ul>
                                    <li>
                                        <span>$27</span>
                                    </li>
                                    <li>
                                        <div class="number">
                                            <span class="minus">-</span>
                                            <input class="form-control" type="text" value="1" />
                                            <span class="plus">+</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="more-collection">
                    <a href="{{ route('site.category') }}">View More Colletction</a>
                </div>
            </div>
        </div>
    </section>

    <!-- end food collection -->



    <!-- Start Services Area -->
    <section class="service-area ptb-100">
        <div class="container">
            <div class="section-title">
                <h2>Our Services</h2>
                <p>Birthdays, anniversaries, weddings and many more! We design, we create beautiful flavors and we make
                    it happen fast! Let us help you with your next special day.
                    .</p>
            </div>
            <div class="service-slider owl-theme owl-carousel">

                @foreach ($services as $service)
                <div class="service-item">
                    <a href="{{ route('site.page.singleService', $service->slug) }}">
                        <img alt="Service" src="{{ $service->getFirstOrDefaultMediaUrl('image', 'thumb') }}" />
                        <img class="service-shape" src="{{ asset('site/img/home-one/service-shape.png') }}"
                            alt="Service" />

                        <h3>{{ $service->title }}</h3>
                        <p>{!! Str::limit($service->description, '190', '...') !!}</p>
                    </a>

                </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- End Services Area -->
    <x-advertisement :placement="'Below Placement 3'" />

    <div class="restant-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="restant-img">
                        <img alt="Restant" src="{{ asset('demo_images/circle_items/dcrle@4x-8.png') }}">
                        <img alt="Restant" src="{{ asset('demo_images/circle_items/item-01.png') }}"
                            class="restant-img-item">
                        <img alt="Restant" src="{{ asset('demo_images/circle_items/item-02.png') }}"
                            class="restant-img-item">
                        <img alt="Restant" src="{{ asset('demo_images/circle_items/item-03.png') }}"
                            class="restant-img-item">
                        <img alt="Restant" src="{{ asset('demo_images/circle_items/item-04.png') }}"
                            class="restant-img-item">

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="restant-content">
                        <div class="section-title">
                            <h2>Bakes & Cakes Is One Of The Most Hygienic & Trusted Bakery</h2>
                            <p> We are Nepal's best bekery, We provide fresh fluffy Healthy Bread are nutritious,
                                hygienic, and are the top choices for
                                diet-conscious people. Please place your order online for our bread and make your
                                morning healthier. Our crunchy Biscuits, Cookies, and ...</p>
                        </div>
                        <a class="cmn-btn subscribe-cmn-btn mb-5" href="{{ route('site.page.aboutus') }}">Know More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Large modal -->
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
                            <form action="{{ route('site.page.customOrder.store') }}" method="POST" id="customOrder"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <input type="text" class="form-control" placeholder="Name"
                                            value="{{ Auth::user()->name ?? '' }}" minlength="8" name="name"
                                            id="name" required >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email"
                                            value="{{ Auth::user()->email ?? '' }}" name="email" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="City"
                                            value="{{ Auth::user()->city ?? '' }}" name="city" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Home Address"
                                            value="{{ Auth::user()->address ?? '' }}" name="address" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Mobile Number"
                                            value="{{ Auth::user()->phone ?? '' }}" name="primary_number" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Alternative Number "
                                            name="secondary_number">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Quantity"
                                            name="quantity" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="datetime-local" class="form-control" id="arrive" name="date"
                                            name="date" required>
                                        <label for="date" class="mx-2">(Please add Delivery Date and Time)</label>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <label for="">Your custom Cake : </label>
                                    <input type="file" class="form-control dropify" name="gallery_image[]" id="avatar-img"
                                        multiple="multiple" required />
                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <br>
                                        <label for="">Description : </label>
                                        <textarea id="your_message" class="form-control" rows="10"
                                            placeholder="Write a message" name="description"></textarea>
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


    {{-- <section class="chef-area pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <h2>Our Special Chefs</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et
                    dolore magna aliqua.</p>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="chef-item">
                        <div class="chef-top">
                            <img alt="Chef" src="{{ asset('site/img/home-one/chef/1.jpg') }}">
                            <div class="chef-inner">
                                <h3>John Doe</h3>
                                <span>Head of Chef</span>
                            </div>
                        </div>
                        <div class="chef-bottom">
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class='bx bxl-facebook'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class='bx bxl-twitter'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class='bx bxl-instagram'></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="chef-item">
                        <div class="chef-top">
                            <img alt="Chef" src="{{ asset('site/img/home-one/chef/6.jpg') }}">
                            <div class="chef-inner">
                                <h3>John Smith</h3>
                                <span>Assistant Chef</span>
                            </div>
                        </div>
                        <div class="chef-bottom">
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class='bx bxl-facebook'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class='bx bxl-twitter'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class='bx bxl-instagram'></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="chef-item active">
                        <div class="chef-top">
                            <img alt="Chef" src="{{ asset('site/img/home-one/chef/3.jpg') }}">
                            <div class="chef-inner">
                                <h3>Evanaa</h3>
                                <span>Intern Chef</span>
                            </div>
                        </div>
                        <div class="chef-bottom">
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class='bx bxl-facebook'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class='bx bxl-twitter'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class='bx bxl-instagram'></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="chef-item">
                        <div class="chef-top">
                            <img alt="Chef" src="{{ asset('site/img/home-one/chef/7.jpg') }}">
                            <div class="chef-inner">
                                <h3>Knot Doe</h3>
                                <span>Asst. Chef</span>
                            </div>
                        </div>
                        <div class="chef-bottom">
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class='bx bxl-facebook'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class='bx bxl-twitter'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class='bx bxl-instagram'></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}


    <div class="review-area">
        <div class="container-fluid p-0">
            <div class="row m-0 pt-75 align-items-center">
                <div class="col-lg-6 p-0">
                    <div class="review-img">
                        <img alt="Review" src="{{ asset('demo_images/item-square.png') }}">
                        {{-- <img alt="Review" src="{{ asset('site/img/home-one/review2.png') }}"> --}}
                    </div>
                </div>
                <div class="col-lg-6 p-0" id="testimonials">
                    <div class="review-item">
                        <div class="section-title">
                            <h2>What People Say About Us</h2>
                            <p>Our products have been serving to our customers since recent years so you can view
                                peoples review regarding
                                to the experience that our customers got from our products.</p>
                        </div>

                        <div class="slider-nav">
                            @foreach ($testimonials as $testimonial)
                            <div class="item">
                                <img alt="image" draggable="false"
                                    src="{{ $testimonial->getFirstOrDefaultMediaUrl('image', 'thumb') }}" />
                            </div>
                            @endforeach
                        </div>

                        <div class="slider-for">
                            @foreach ($testimonials as $testimonial)
                            <div class="item">
                                <h3>{{ $testimonial->title }} </h3>
                                <p>{!! $testimonial->description !!}</p>
                            </div>
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>


    <section class="blog-area ptb-100">
        <div class="container">
            <div class="section-title">
                <h2>Our Regular Blogs</h2>
                <p>You can visit to our blogs by clicking on blogs that have been posted regularly in our website for
                    getting
                    further information regarding bakery products.</p>
            </div>
            <div class="row">
                @foreach ($blogs as $blog)
                <div class="col-sm-6 col-lg-4">
                    <div class="blog-item">
                        <div class="blog-top">

                            <img alt="Collection" src="{{ $blog->getFirstOrDefaultMediaUrl('image', 'original') }}">


                            <span>{{ $blog->created_at->isoFormat('LL') }}</span>
                        </div>
                        <div class="blog-bottom">
                            <h3>
                                <a>{{ $blog->title }}</a>
                            </h3>
                            <p>{!! Str::limit($blog->description, '190', '...') !!}</p>
                            <div class="">

                                <a class="cmn-btn" href="{{ route('site.page.singleblog', $blog->slug) }}">Read More</a>
                            </div>


                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center">
                <a class="read-blog-btn" href="{{ route('site.page.blog') }}">Read More Blogs</a>
            </div>
        </div>
    </section>


    <x-advertisement :placement="'Above NewsLetter'" />
    <!--News Letter -->
    <section class="subscribe-area">
        <div class="subscribe-shape">

        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="subscribe-item">
                        <form id="news-form">
                            <input autocomplete="off" class="form-control subscribe-slider-search" name="email"
                                placeholder="Enter your email" id="email" type="text" required>
                            
                            <button id="news-btn" class="btn subscribe-slider-search-btn" type="submit">
                                Subscribe
                            </button>
                            <span class="text-warning error-text email_error ml-5"></span>
                        </form>


                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="subscribe-img">
                        <img alt="Shape" src="{{ asset('demo_images/newsletter-03.jpg') }}">
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!--End News Letters -->




    {{-- @if ($popups) --}}
    @if ($sliders->where('is_popup', true))
        @if (!session()->has('modal'))
    {{-- Popup Modal --}}
    <div class="modal fade" id="popupSlider" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="popupSliderLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="banner-slider owl-theme owl-carousel">
                            @foreach ($sliders->where('is_popup', true) as $popup)
                            <div class="slider-item">
                            @if (!is_null($popup->brand_id))
                            @php
                            $brand = \App\Models\Brand::where('id', $popup->brand_id)->first();
                            if ($brand) {
                            //$brand_url = route('site.brands.getProducts', $brand->slug);
                            $brand_url = '';
                            echo '<a href="' . $brand_url . '">';
                                } else {
                                echo '<a href="javascript:void(0)">';
                                    }
                                    @endphp
                                    @endif
                                    <div class="ps-banner" style="background:#103178;">
                                        <div class="container-no-round">
                                            <img alt="alt" class="ps-banner__image w-100"
                                                src="{{ $popup->getFirstOrDefaultMediaUrl('desktop', 'original') }}" />
                                        </div>
                                    </div>
                                </a>
                            </div>
                                @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $('.owl-carousel').owlCarousel({
                    loop: true,
                    margin: 10,
                    nav: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 3
                        },
                        1000: {
                            items: 5
                        }
                    }
                })
    </script>
    <script>
        $(document).ready(() => {
                    window.setTimeout(function() {
                        $('#popupSlider').modal('show');
                    }, 5000);
                });
    </script>

    {{ session()->put('modal', 'shown') }}
                @endpush
     @endif
    @endif

    @push('scripts')
    <!-- dropify: page js file -->
    <script>
        $('#avatar-img').dropify({
                    messages: {
                        'default': 'Drag and drop a file here or click',
                        'replace': 'Drag and drop or click to replace',
                        'remove': 'Remove',
                        'error': 'Ooops, something wrong happended.'

                    }
                });
                // url = "{{ route('site.page.autoSearch') }}";
                // $('input.typeahead').typeahead({
                //     source: function(terms, process) {
                //         return $.get(path, {
                //             terms: terms
                //         }, function(data) {
                //             return process($data)
                //         });
                //     }
                // });
                var myCarousel = document.querySelector('#myCarousel')
                var carousel = new bootstrap.Carousel(myCarousel, {
                    interval: 2000,
                    wrap: false
                })
    </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.79/jquery.form-validator.min.js" integrity="sha512-7+hQkXGIswtBWoGbyajZqqrC8sa3OYW+gJw5FzW/XzU/lq6kScphPSlj4AyJb91MjPkQc+mPQ3bZ90c/dcUO5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="{{ asset('site/js/custom-order-script.js') }}"></script>

    @endpush
</x-site-master-layout>
