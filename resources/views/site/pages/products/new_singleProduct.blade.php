<x-new-site-master-layout>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">

            </div>
        </div>
        <div class="container mb-30">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50 mt-30">
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                <div class="detail-gallery">
                                    <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                        <figure class="border-radius-10">
                                            <img src="{{ $singleProduct->getFirstOrDefaultMediaUrl('image', 'original') }}"
                                                alt="Gallery Image">
                                        </figure>
                                        @foreach ($gallerys as $key => $gallery)
                                            <figure class="border-radius-10">
                                                <img src="{{ $gallery->getUrl('original') }}" alt="Gallery Image">
                                            </figure>
                                        @endforeach

                                    </div>
                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails">
                                        <div> <img
                                                src="{{ $singleProduct->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}"
                                                alt="Gallery Image"></div>
                                        @foreach ($gallerys as $key => $gallery)
                                            <div><img src="{{ $gallery->getUrl('square-md-thumb') }}"
                                                    alt="Gallery Image">
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                                <!-- End Gallery -->
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info pr-30 pl-30">
                                    <span class="stock-status out-stock"> Sale Off </span>
                                    <h2 class="title-detail">{{ $singleProduct->name }}</h2>
                                    <div class="product-detail-rating">
                                        <div class="product-rate-cover text-end">
                                            <div class="rating">
                                                @php
                                                    $num_rating = number_format($singleProduct->averageRating);
                                                @endphp
                                                @for ($i = 0; $i < $num_rating; $i++)
                                                    <i class="fa fa-star checked"> </i>
                                                @endfor
                                                @for ($j = $num_rating; $j < 5; $j++)
                                                    <i class="fa fa-star"> </i>
                                                @endfor

                                                <span
                                                    class="font-small ml-5 text-muted">({{ round($singleProduct->averageRating, 1) }}
                                                    Reviews )</span>

                                                <br>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="clearfix product-price-cover">
                                        <div class="product-price primary-color float-left">
                                            @if ($singleProduct->discount === 0)
                                                <span class="current-price text-brand">Rs.
                                                    {{ $singleProduct->selling_price }}</span>
                                            @else
                                                @if ($singleProduct->discount_type === 'percent')
                                                    <span class="current-price text-brand">Rs.
                                                        {{ $singleProduct->selling_price * (1 - $singleProduct->discount / 100) }}</span>
                                                    <span>
                                                        <span
                                                            class="save-price font-md color3 ml-15">{{ $singleProduct->discount }}%
                                                            Off</span>
                                                        <span class="old-price font-md ml-15">Rs.
                                                            {{ $singleProduct->selling_price }}</span>
                                                    </span>
                                                @else
                                                    <span class="current-price text-brand">Rs.
                                                        {{ $singleProduct->selling_price - $singleProduct->discount }}</span>
                                                    <span>
                                                        @php
                                                            $discount_rate = ($singleProduct->discount / $singleProduct->selling_price) * 100;
                                                        @endphp
                                                        <span
                                                            class="save-price font-md color3 ml-15">{{ round($discount_rate, 2) }}%
                                                            Off</span>
                                                        <span
                                                            class="old-price font-md ml-15">Rs.{{ $singleProduct->selling_price }}</span>
                                                    </span>
                                                @endif
                                            @endif

                                        </div>
                                    </div>

                                    <div class="detail-extralink mb-50">
                                        @if ($singleProduct->is_sellable)
                                            <form id="add-to-cart-form">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $singleProduct->id }}">
                                                <x-input-field :type="'date'" :label="'Delivery Date'" :name="'delivery_date'"
                                                    :placeholder="'enter a delivery date'" :col="6" :required="true"
                                                    :autofocus="true" />
                                                <span id="add_delivery_date"> </span>
                                                <div class="ps-form--review">
                                                    <div class="ps-form__block">
                                                        <label class="ps-form__label">Leave Your Note Here<span
                                                                class="text-muted"> (Optional) </span> </label>
                                                        <textarea class="form-control ps-form__textarea" name="user_note"></textarea>
                                                    </div>

                                                </div>
                                                <ul class="btns_group ul_li">
                                                    <li>
                                                        <h4>Quantity:</h4>
                                                        <div class="def-number-input number-input safari_only me-3">
                                                            <button type="button btn-minus" class="minus ps-plus-minus"
                                                                onclick="this.querySelector('input[type=number]').stepDown()"><i
                                                                    class="fa fa-minus"></i></button>
                                                            <input class="quantity single-product-input" min="0"
                                                                name="quantity" value="1" type="number"
                                                                oninput="(this.value = Math.abs(this.value))">
                                                            <button type="button" class="plus ps-plus-minus"
                                                                onclick="this.querySelector('input[type=number]').stepUp()"><i
                                                                    class="fa fa-plus"></i></button>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="product-extra-link2">
                                                            <button class="button button-add-to-cart"
                                                                onclick="addToCart()"><i
                                                                    class="fi-rs-shopping-cart"></i>Add to cart</button>
                                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                                href="shop-wishlist.html"><i
                                                                    class="fi-rs-heart"></i></a>
                                                            <a aria-label="Compare" class="action-btn hover-up"
                                                                href="shop-compare.html"><i
                                                                    class="fi-rs-shuffle"></i></a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </form>
                                        @else
                                            <div class="bps-product__meta">
                                                <span class="bps-product__price">Sorry, This product is
                                                    unavailable at the moment!</span>

                                            </div>
                                        @endif
                                    </div>
                                    {{-- <div class="detail-extralink mb-50">
                                        <div class="detail-qty border radius">
                                            <a href="#" class="qty-down"><i
                                                    class="fi-rs-angle-small-down"></i></a>
                                            <span class="qty-val">1</span>
                                            <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                        <div class="product-extra-link2">
                                            <button type="submit" class="button button-add-to-cart"><i
                                                    class="fi-rs-shopping-cart"></i>Add to cart</button>
                                            <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn hover-up"
                                                href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                    </div> --}}

                                    <div class="font-xs">
                                        <ul class="mr-50 float-start">
                                            <li class="mb-5">Minimum Purchase Unit: <span
                                                    class="text-brand">{{ $singleProduct->min_purchase_unit }}</span>
                                            </li>
                                            <li class="mb-5">Refundable:<span class="text-brand">
                                                    {{ $singleProduct->is_refundable ? 'Yes' : 'No' }}</span></li>
                                        </ul>

                                        <ul class="float-start">
                                            <li class="mb-5">SKU: <a
                                                    href="javascript:void(0)">{{ $singleProduct->sku }}</a></li>
                                            <li class="mb-5">Tags: @if ($singleProduct->tags != '')
                                                    @foreach (explode(',', $singleProduct->tags) as $tag)
                                                        <a href="javascript:void(0)" rel="tag">{{ $tag }}</a>
                                                    @endforeach
                                                @endif
                                            </li>
                                            <li>Stock:<span
                                                    class="in-stock text-brand ml-5">{{ $singleProduct->quantity }}
                                                    Items In Stock</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Detail Info -->
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                            href="#Description">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab"
                                            href="#Additional-info">Additional info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab"
                                            href="#Vendor-info">Vendor</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab"
                                            href="#Reviews">Reviews(
                                            {{ $singleProduct->ratings->count() }} )</a>
                                    </li>
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content">
                                    <div class="tab-pane fade show active" id="Description">
                                        <div class="">
                                            <p>{!! $singleProduct->description !!}</p>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Additional-info">
                                        <table class="font-md">
                                            <tbody>
                                                <tr class="stand-up">
                                                    <th>Stand Up</th>
                                                    <td>
                                                        <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
                                                    </td>
                                                </tr>
                                                <tr class="folded-wo-wheels">
                                                    <th>Folded (w/o wheels)</th>
                                                    <td>
                                                        <p>32.5″L x 18.5″W x 16.5″H</p>
                                                    </td>
                                                </tr>
                                                <tr class="folded-w-wheels">
                                                    <th>Folded (w/ wheels)</th>
                                                    <td>
                                                        <p>32.5″L x 24″W x 18.5″H</p>
                                                    </td>
                                                </tr>
                                                <tr class="door-pass-through">
                                                    <th>Door Pass Through</th>
                                                    <td>
                                                        <p>24</p>
                                                    </td>
                                                </tr>
                                                <tr class="frame">
                                                    <th>Frame</th>
                                                    <td>
                                                        <p>Aluminum</p>
                                                    </td>
                                                </tr>
                                                <tr class="weight-wo-wheels">
                                                    <th>Weight (w/o wheels)</th>
                                                    <td>
                                                        <p>20 LBS</p>
                                                    </td>
                                                </tr>
                                                <tr class="weight-capacity">
                                                    <th>Weight Capacity</th>
                                                    <td>
                                                        <p>60 LBS</p>
                                                    </td>
                                                </tr>
                                                <tr class="width">
                                                    <th>Width</th>
                                                    <td>
                                                        <p>24″</p>
                                                    </td>
                                                </tr>
                                                <tr class="handle-height-ground-to-handle">
                                                    <th>Handle height (ground to handle)</th>
                                                    <td>
                                                        <p>37-45″</p>
                                                    </td>
                                                </tr>
                                                <tr class="wheels">
                                                    <th>Wheels</th>
                                                    <td>
                                                        <p>12″ air / wide track slick tread</p>
                                                    </td>
                                                </tr>
                                                <tr class="seat-back-height">
                                                    <th>Seat back height</th>
                                                    <td>
                                                        <p>21.5″</p>
                                                    </td>
                                                </tr>
                                                <tr class="head-room-inside-canopy">
                                                    <th>Head room (inside canopy)</th>
                                                    <td>
                                                        <p>25″</p>
                                                    </td>
                                                </tr>
                                                <tr class="pa_color">
                                                    <th>Color</th>
                                                    <td>
                                                        <p>Black, Blue, Red, White</p>
                                                    </td>
                                                </tr>
                                                <tr class="pa_size">
                                                    <th>Size</th>
                                                    <td>
                                                        <p>M, S</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="Vendor-info">
                                        <div class="vendor-logo d-flex mb-30">
                                            <img src="{{ $singleProduct->user->getFirstOrDefaultMediaUrl('avatars', 'avatar') }}"
                                                alt="Gallery Image">
                                            <div class="vendor-name ml-15">
                                                <h6>
                                                    <a href="javascript:void(0)">{{ $singleProduct->user->name }}</a>
                                                </h6>
                                                <div class="product-rate-cover text-end">
                                                    <div class="d-inline-block">
                                                        <div class="product-rating" style="width: 90%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="contact-infor mb-50">
                                            <li><img src="assets\imgs\theme\icons\icon-location.svg"
                                                    alt=""><strong>Address: </strong>
                                                <span>{{ $singleProduct->user->address }}</span>
                                            </li>
                                            <li><img src="assets\imgs\theme\icons\icon-contact.svg"
                                                    alt=""><strong>Contact
                                                    Seller:</strong><span>{{ $singleProduct->user->phone ?? '' }}</span>
                                            </li>
                                        </ul>
                                        <div class="d-flex mb-55">
                                            <div class="mr-30">
                                                <p class="text-brand font-xs">Rating</p>
                                                <h4 class="mb-0">92%</h4>
                                            </div>
                                            <div class="mr-30">
                                                <p class="text-brand font-xs">Ship on time</p>
                                                <h4 class="mb-0">100%</h4>
                                            </div>
                                            <div>
                                                <p class="text-brand font-xs">Chat response</p>
                                                <h4 class="mb-0">89%</h4>
                                            </div>
                                        </div>
                                        <p>Noodles & Company is an American fast-casual restaurant that offers
                                            international and American noodle dishes and pasta in addition to soups and
                                            salads. Noodles & Company was founded in 1995 by Aaron Kennedy and is
                                            headquartered in Broomfield, Colorado. The company went public in 2013 and
                                            recorded a $457 million revenue in 2017.In late 2018, there were 460 Noodles
                                            & Company locations across 29 states and Washington, D.C.</p>
                                    </div>
                                    <div class="tab-pane fade" id="Reviews">

                                        <!--comment form-->
                                        <div class="comment-form">
                                            @if ($user_rating)
                                                <h4 class="mb-15">Update your review</h4>
                                            @else
                                                <h4 class="mb-15">Add a review</h4>
                                            @endif

                                            <div class=" d-inline-block mb-30"></div>
                                            <div class="row">
                                                <div class="col-lg-8 col-md-12">
                                                    @auth
                                                        <form class="form-contact comment_form"
                                                            action="{{ route('review.store') }}" id="review-form"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="product_id" id="product_id"
                                                                value="{{ $singleProduct->id }}">

                                                            @if ($user_rating)
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="rating-css">
                                                                            <div class="star-icon">
                                                                                @for ($i = 1; $i <= $user_rating->rating; $i++)
                                                                                    <input type="radio"
                                                                                        value="{{ $i }}"
                                                                                        name="rating" checked
                                                                                        id="rating{{ $i }}">
                                                                                    <label for="rating{{ $i }}"
                                                                                        class="fa fa-star"></label>
                                                                                @endfor
                                                                                @for ($j = $user_rating->rating + 1; $j <= 5; $j++)
                                                                                    <input type="radio"
                                                                                        value="{{ $j }}"
                                                                                        name="rating"
                                                                                        id="rating{{ $j }}">
                                                                                    <label for="rating{{ $j }}"
                                                                                        class="fa fa-star"></label>
                                                                                @endfor

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <textarea class="form-control w-100" name="review" cols="30" rows="9">{!! $user_rating->review !!}</textarea>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit"
                                                                        class="button button-contactForm">Update
                                                                        Review</button>
                                                                </div>
                                                            @else
                                                                <div class="row">
                                                                    <div class="col-12">

                                                                        <div class="rating-css">
                                                                            <div class="star-icon">
                                                                                <input type="radio" value="1" name="rating"
                                                                                    checked id="rating1">
                                                                                <label for="rating1"
                                                                                    class="fa fa-star"></label>
                                                                                <input type="radio" value="2" name="rating"
                                                                                    id="rating2">
                                                                                <label for="rating2"
                                                                                    class="fa fa-star"></label>
                                                                                <input type="radio" value="3" name="rating"
                                                                                    id="rating3">
                                                                                <label for="rating3"
                                                                                    class="fa fa-star"></label>
                                                                                <input type="radio" value="4" name="rating"
                                                                                    id="rating4">
                                                                                <label for="rating4"
                                                                                    class="fa fa-star"></label>
                                                                                <input type="radio" value="5" name="rating"
                                                                                    id="rating5">
                                                                                <label for="rating5"
                                                                                    class="fa fa-star"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <textarea class="form-control w-100" name="review" id="comment" cols="30" rows="9"
                                                                                placeholder="Write Comment"></textarea>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <button type="submit"
                                                                        class="button button-contactForm">Submit
                                                                        Review</button>
                                                                </div>
                                                            @endif
                                                        </form>
                                                    @endauth
                                                    @guest
                                                        <div class="row">
                                                            <div class="col-12 col-lg-4">
                                                                <label class="ps-form__label">Login to provide
                                                                    review.</label>
                                                            </div>
                                                        </div>
                                                    @endguest
                                                </div>
                                            </div>
                                        </div>
                                        <!--Comments-->
                                        <div class="comments-area">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <h4 class="mb-30">Customer questions & answers</h4>
                                                    <div class="comment-list">
                                                        @forelse ($singleProduct->ratings->sortByDesc('created_at')->take(2) as $rating)
                                                            <div
                                                                class="single-comment justify-content-between d-flex mb-30">
                                                                <div class="user justify-content-between d-flex">
                                                                    <div class="thumb text-center">
                                                                        <img src="{{ $rating->user->getFirstOrDefaultMediaUrl('avatars', 'profile') }}"
                                                                            alt="alt" />
                                                                        <a href="#"
                                                                            class="font-heading text-brand">{{ $rating->user->name }}
                                                                        </a>
                                                                    </div>
                                                                    <div class="desc">
                                                                        <div
                                                                            class="d-flex justify-content-between mb-10">
                                                                            <div class="d-flex align-items-center">
                                                                                <span
                                                                                    class="font-xs text-muted">{{ $rating->created_at->isoFormat('MMM Do YYYY') }}
                                                                                </span>
                                                                            </div>
                                                                            <div class="d-inline-block">
                                                                                <div class="rating">
                                                                                    @for ($i = 0; $i < $rating->rating; $i++)
                                                                                        <i class="fa fa-star checked">
                                                                                        </i>
                                                                                    @endfor
                                                                                    @for ($j = $rating->rating; $j < 5; $j++)
                                                                                        <i class="fa fa-star"> </i>
                                                                                    @endfor
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <p class="mb-10">
                                                                            {!! $rating->review !!}</p>
                                                                        @auth
                                                                            @if (auth()->user()->id == $rating->user_id)
                                                                                <span>
                                                                                    <a href="javascript:void(0)"
                                                                                        id="delete-review"
                                                                                        data-id="{{ $rating->id }}"
                                                                                        class="btn btn-danger btn-xs"
                                                                                        data-bs-toggle="tooltip"
                                                                                        title="Delete Review">Delete
                                                                                    </a>
                                                                                </span>
                                                                            @endif
                                                                        @endauth
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @empty
                                                            <div class="ps-review--product">
                                                                <p>No Reviews Yet!!! </p>
                                                            </div>
                                                        @endforelse
                                                        <div class="row mt-2">
                                                            <div class="col-12 col-lg-4">
                                                            </div>
                                                            <div class="col-4 mt-4 text-center">
                                                                <button class="btn ps-btn ps-btn--warning"
                                                                    id="view-more">View
                                                                    More</button>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-60">
                            <div class="col-12">
                                <h2 class="section-title style-1 mb-30">Related products</h2>
                            </div>
                            <div class="col-12">
                                <div class="row related-products">
                                    @foreach ($products->take(4) as $product)
                                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                            <div class="product-cart-wrap hover-up">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="{{ route('site.page.singleProductShow', $product->id) }}"
                                                            tabindex="0">

                                                            <img class="default-img"
                                                                src="{{ $product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}"
                                                                alt="">
                                                            <img class="hover-img"
                                                                src="{{ $product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}"
                                                                alt="">
                                                        </a>
                                                    </div>
                                                    <div class="product-action-1">
                                                        <a aria-label="Quick view" class="action-btn small hover-up"
                                                            data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                                class="fi-rs-search"></i></a>
                                                        <a aria-label="Add To Wishlist"
                                                            class="action-btn small hover-up" href="shop-wishlist.html"
                                                            tabindex="0"><i class="fi-rs-heart"></i></a>
                                                        <a aria-label="Compare" class="action-btn small hover-up"
                                                            href="shop-compare.html" tabindex="0"><i
                                                                class="fi-rs-shuffle"></i></a>
                                                    </div>
                                                    <div
                                                        class="product-badges product-badges-position product-badges-mrg">
                                                        <span class="hot">Fresh</span>
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <h2><a href="{{ route('site.page.singleProductShow', $product->id) }}"
                                                            tabindex="0">{{ $product->name }}</a></h2>
                                                    <div class="rating">
                                                        @php
                                                            $num_rating = number_format($singleProduct->averageRating);
                                                        @endphp
                                                        @for ($i = 0; $i < $num_rating; $i++)
                                                            <i class="fa fa-star checked"> </i>
                                                        @endfor
                                                        @for ($j = $num_rating; $j < 5; $j++)
                                                            <i class="fa fa-star"> </i>
                                                        @endfor

                                                    </div>
                                                    <div class="product-price">
                                                        <span>Rs.{{ $product->selling_price }}</span>
                                                        <span
                                                            class="old-price">Rs.{{ $product->cost_price }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    @push('scripts')
        <script>
            $(document).ready(function() {

                flatpickr("#delivery_date", {
                    "enableTime": true,
                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var count = 2;
                $('body').on('click', '#view-more', function() {
                    count = count + 2;
                    var id = $('#product_id').val();
                    $('#view-more').html('<b>Loading...</b>');
                    $.ajax({
                        url: "{{ route('user.comments') }}",
                        method: "POST",
                        data: {
                            id: id,
                            count: count,
                        },
                        success: function(data) {
                            $('#view-more').remove();
                            $('#product-review').html(data);
                        }
                    });

                });

            });
        </script>
        <script>
            $('body').on('click', '#delete-review', function(event) {
                event.preventDefault();
                event.stopPropagation();
                var id = $(this).data('id');
                var delete_url = "{{ route('user.reviews.delete', '') }}/" + id;

                $.ajax({
                    type: "DELETE",
                    url: delete_url,
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            alertify.success(data.message)
                            window.location.reload();


                        } else {
                            alertify.error(data.message);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                        console.log('Quick View Error');
                    }
                });
            });
        </script>
    @endpush
</x-new-site-master-layout>
