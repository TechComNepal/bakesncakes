<main class="main">
    <div class="page-header mt-30 mb-50">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15">Snack</h1>
                        <div class="breadcrumb">
                            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span></span> Shop <span></span> Snack
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row flex-row-reverse">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">29</strong> items for you!</p>
                    </div>
                    <div class="sort-by-product-area">
                        <div class="sort-by-cover mr-10">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps"></i>Show:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">50</a></li>
                                    <li><a href="#">100</a></li>
                                    <li><a href="#">150</a></li>
                                    <li><a href="#">200</a></li>
                                    <li><a href="#">All</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sort-by-cover">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">Featured</a></li>
                                    <li><a href="#">Price: Low to High</a></li>
                                    <li><a href="#">Price: High to Low</a></li>
                                    <li><a href="#">Release Date</a></li>
                                    <li><a href="#">Avg. Rating</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row product-grid">
                    @foreach ($products as $featured_product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-7">
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
                                            href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn featured-products_a"
                                            href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        <a aria-label="Quick view" class="action-btn featured-products_a"
                                            data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                class="fi-rs-eye"></i></a>
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
                                            <a class="add" href="shop-cart.html"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Add
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <!--product grid-->
                <div class="">
                    {{ $products->links() }}
                </div>
                <!-- end pagination -->
                <section class="section-padding pb-5">
                    <div class="section-title  wow animate__animated animate__fadeIn" data-wow-delay="0">
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
                                            <h2><a href="shop-product-right.html">{{ $trending_product->name }}</a>
                                            </h2>
                                            <div class="product-rate-cover">
                                                <div class="rating">
                                                    @php
                                                        $num_rating = number_format($trending_product->averageRating);
                                                    @endphp
                                                    @for ($i = 0; $i < $num_rating; $i++)
                                                        <i class="fa fa-star checked">
                                                        </i>
                                                    @endfor
                                                    @for ($j = $num_rating; $j < 5; $j++)
                                                        <i class="fa fa-star">
                                                        </i>
                                                    @endfor
                                                    <span class="font-small ml-5 text-muted">
                                                        ({{ round($trending_product->averageRating, 1) }})</span>
                                                </div>

                                            </div>
                                            <div>
                                                <span class="font-small text-muted">By: <a
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


                    </div>
                </section>
                <!--End Deals-->
            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <div class="sidebar-widget widget-category-2 mb-30">
                    <h5 class="section-title style-1 mb-30">Category</h5>
                    <ul>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assets\imgs\theme\icons\category-1.svg"
                                    alt="">Milks & Dairies</a><span class="count">30</span>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assets\imgs\theme\icons\category-2.svg"
                                    alt="">Clothing</a><span class="count">35</span>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assets\imgs\theme\icons\category-3.svg" alt="">Pet
                                Foods </a><span class="count">42</span>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assets\imgs\theme\icons\category-4.svg"
                                    alt="">Baking material</a><span class="count">68</span>
                        </li>
                        <li>
                            <a href="shop-grid-right.html"> <img src="assets\imgs\theme\icons\category-5.svg"
                                    alt="">Fresh Fruit</a><span class="count">87</span>
                        </li>
                    </ul>
                </div>
                <!-- Fillter By Price -->
                <div class="sidebar-widget price_range range mb-30">
                    <h5 class="section-title style-1 mb-30">Fill by price</h5>
                    <div class="price-filter">
                        <div class="price-filter-inner">
                            <div id="price-slider" wire:ignore></div>
                            <div class="d-flex justify-content-between">
                                <div class="caption">From: <strong id="price-slider-min"
                                        class="text-brand">Rs{{ $min_price }}</strong></div>
                                <div class="caption">To: <strong id="price-slider-max"
                                        class="text-brand">Rs{{ $max_price }}</strong></div>
                            </div>


                        </div>
                    </div>
                    <a href="shop-grid-right.html" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i>
                        Fillter</a>
                </div>
                <!-- Product sidebar Widget -->
                <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                    <h5 class="section-title style-1 mb-30">New products</h5>
                    @foreach ($new_products as $product)
                        <div class="single-post clearfix">
                            <div class="image">
                                <img src="{{ $product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}"
                                    alt="#">
                            </div>
                            <div class="content">
                                <h5><a href="shop-product-detail.html">{{ $product->name }}</a></h5>
                                <p class="price mb-0 mt-5">{{ $product->price }}</p>
                                <div class="product-rate">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</main>

@push('scripts')
    <script>
        $(document).ready(function() {
            var rangeSlider = document.getElementById('price-slider');
            if (rangeSlider) {
                var input0 = document.getElementById('price-slider-min');
                var input1 = document.getElementById('price-slider-max');
                var inputs = [input0, input1];
                noUiSlider.create(rangeSlider, {
                    start: [1, {{ $max_price }}],
                    connect: true,
                    step: 1,
                    range: {
                        min: [1],
                        max: [{{ $max_price }}]
                    }
                });

                rangeSlider.noUiSlider.on("update", function(values, handle) {
                    input0.innerText = values[0]
                    input1.innerText = values[1]

                    @this.min_price = values[0]

                    @this.max_price = values[1]

                    console.log(@this.max_price, @this.min_price)
                });
            }
        })
    </script>
@endpush
