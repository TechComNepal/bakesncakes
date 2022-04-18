<main class="main">
    <div class="page-header mt-30 mb-50">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15 text-white">Snack</h1>
                        <div class="breadcrumb breadcrumb-new-header">
                            <a href="index.html" class="text-white" rel="nofollow"><i class="fi-rs-home mr-5 text-white"></i>Home</a>
                            <span class="text-white"></span> Shop <span class="text-white"></span> Snack
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
                        <p>We found <strong class="text-brand">{{ $products_count }}</strong> items for you!
                        </p>
                    </div>
                    <div class="sort-by-product-area">
                        <div class="sort-by-cover mr-10">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps"></i>Show:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> 10 <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li wire:click="setPaginationLimit(10)">10</li>
                                    <li wire:click="setPaginationLimit(15)">15</li>
                                    <li wire:click="setPaginationLimit(20)">20</li>
                                    <li wire:click="setPaginationLimit(25)">25</li>
                                    <li wire:click="setPaginationLimit(30)">30</li>
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
                                    <li><a wire:click="setFilter(1)">Default</a></li>
                                    <li><a wire:click="setFilter(2)">Featured</a></li>
                                    <li><a wire:click="setFilter(3)">Price: Low to High</a></li>
                                    <li><a wire:click="setFilter(4)">Price: High to Low</a></li>
                                    <li><a wire:click="setFilter(5)">Release Date</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-grid">
                    <div wire:loading>
                        <h1 class="text-center">Loading ...</h1>
                    </div>
                    <div>
                        @isset($products)
                            <div class="row">
                                @if ($products->count() > 0)
                                    @foreach ($products as $featured_product)
                                        <div class="col-lg-3">
                                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                                data-wow-delay=".1s">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a
                                                            href="{{ route('site.page.singleProductShow', $featured_product->id) }}">
                                                            <img class="default-img"
                                                                src="{{ $featured_product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}">
                                                            <img class="hover-img"
                                                                src="{{ $featured_product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}">
                                                        </a>
                                                    </div>
                                                    <div class="product-action-1">
                                                        <a aria-label="Add To Wishlist"
                                                            class="action-btn featured-products_a"
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
                                                        <a
                                                            href="javascript:void(0)">{{ $featured_product->category->name }}</a>
                                                    </div>
                                                    <h2><a
                                                            href="shop-product-right.html">{{ $featured_product->name }}</a>
                                                    </h2>
                                                    <div class="product-rate-cover">
                                                        <div class="rating">
                                                            @php
                                                                $num_rating = number_format($featured_product->averageRating);
                                                            @endphp
                                                            @for ($i = 0; $i < $num_rating; $i++)
                                                                <i class="fa fa-star checked">
                                                                </i>
                                                            @endfor
                                                            @for ($j = $num_rating; $j < 5; $j++)
                                                                <i class="fa fa-star"> </i>
                                                            @endfor
                                                            <span class="font-small ml-5 text-muted">
                                                                ({{ round($featured_product->averageRating, 1) }})
                                                            </span>

                                                        </div>
                                                    </div>
                                                    <div>
                                                        <span class="font-small text-muted">By <a
                                                               href="{{ route('site.page.vendorDetails', $featured_product->user->id) }}">{{ $featured_product->user->name }}</a></span>
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
                                                                        Rs.{{$featured_product->selling_price * (1 - $featured_product->discount / 100) }}</span>
                                                                    <span
                                                                        class="old-price">Rs.{{ $featured_product->selling_price }}</span>
                                                                </div>
                                                            @else
                                                                <div class="product-price">
                                                                    <span>
                                                                        Rs.
                                                                        {{$featured_product->selling_price - $featured_product->discount }}</span>
                                                                    <span class="old-price">
                                                                        Rs.{{ $featured_product->selling_price }}</span>
                                                                </div>
                                                            @endif
                                                        @endif
                                                        <div class="add-cart">
                                                            <a class="add" href="javascript:void(0)"
                                                                id="{{ $featured_product->id }}"
                                                                onclick="productview({{ $featured_product->id }})"><i
                                                                    class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endisset
                    </div>
                    <!--end product card-->


                </div>
                <!--product grid-->
                <div class="pagination-links">
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
                                                        href="vendor-details-1.html">{{ $trending_product->user->name  }}</a></span>
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
                                                                {{$trending_product->selling_price - $trending_product->discount }}</span>
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
            <div class="col-lg-1-5 primary-sidebar ">
                @isset($categories)
                    <div class="sidebar-widget widget-category-2 mb-30">
                        <h5 class="section-title style-1 mb-30">Category</h5>
                        <ul>
                            @foreach ($categories as $category)
                                <li wire:click="selectedCategory({{ $category->id }})">
                                    <img src="{{ $category->getFirstOrDefaultMediaUrl('image', 'thumb') }}"
                                        alt="{{ $category->name }}" width="60">
                                    {{ $category->name }}</a><span
                                        class="count">{{ $category->products->count() }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endisset
                <!-- Fillter By Price -->
                <div class="sidebar-widget price_range range mb-30">
                    <h5 class="section-title style-1 mb-30">Fill by price</h5>
                    <div class="price-filter">

                        <div id="price-slider" wire:ignore></div>
                        <div class="d-flex justify-content-between">
                            <div class="caption">From: <strong id="price-slider-min"
                                    class="text-brand">Rs{{ $min_price }}</strong>
                            </div>
                            <div class="caption">To: <strong id="price-slider-max"
                                    class="text-brand">Rs{{$max_price }}</strong>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
            <!-- Product sidebar Widget -->
            <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                <h5 class="section-title style-1 mb-30">New products</h5>
                @foreach ($new_products as $product)
                    <div class="single-post clearfix">
                        <div class="image">
                            <img src="{{ $product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}" alt="#">
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
                    window.livewire.emit('price_filter', values[0], values[1])
                });
            }
        })
    </script>
@endpush
