<x-site-master-layout>

    <div class="container">
        <div class="product-title-item">

            <ul>
                <li>
                    <a style="color:#000;" href="{{ route('site.page') }}">Home</a>
                </li>
                <li>
                    <i class='bx bx-chevron-right' style="color:#000;"></i>
                </li>
                <li>
                    <a style="color:#000;" href="{{ route('site.page') }}">Products</a>
                </li>
                <li>
                    <i style="color:#000;" class='bx bx-chevron-right'></i>
                </li>
                <li>Product Details</li>
            </ul>
        </div>
    </div>  
    <section class="blog-area pt-50">
        <!-- shop details start -->
        <section class="shop_details pt-120 pb-90">
            <div class="container">
                <div class="product_top_wrap mb-60">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="product_wrap mb-30">
                                <div class="product_details_img ">
                                    <div class="tab-content" id="myTabContent">

                                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                                            aria-labelledby="home-tab">
                                            <div class="pl_thumb">
                                                <img src="{{ $singleProduct->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}"
                                                    class="card-img-top" alt="Gallery Image">
                                            </div>
                                        </div>

                                        @foreach ($gallerys as $key => $gallery)
                                            <div class="tab-pane fade" id="profile{{ $key }}" role="tabpanel"
                                                aria-labelledby="profile-tab">
                                                <div class="pl_thumb">
                                                    <img src="{{ $gallery->getUrl('square-md-thumb') }}"
                                                        class="card-img-top" alt="Gallery Image">
                                                </div>

                                            </div>
                                        @endforeach



                                    </div>
                                </div>


                                <div class="shop_thumb_tab">
                                    <ul class="nav" id="myTab2" role="tablist">
                                        <li class="nav-item">
                                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                                data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                                aria-selected="true">
                                                <img src="{{ $singleProduct->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}"
                                                    class="card-img-top" alt="Gallery Image"> </button>
                                        </li>

                                        @foreach ($gallerys as $key => $gallery)
                                            <li class="nav-item">
                                                <button class="nav-link active" id="profile{{ $key }}"
                                                    data-bs-target="#iprofile{{ $key }}" data-bs-target="#home"
                                                    type="button" role="tab" aria-controls="home" aria-selected="true">

                                                    <img src="{{ $gallery->getUrl('square-md-thumb') }}"
                                                        class="card-img-top" alt="Gallery Image">


                                                    <br>
                                                    <br>

                                                </button>
                                            </li>
                                        @endforeach

                                        <li class="nav-item">
                                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                                data-bs-target="#profile" type="button" role="tab"
                                                aria-controls="profile" aria-selected="false">
                                                {{-- <img src="{{ $gallery->getUrl('square-md-thumb') }}"
                                                    class="card-img-top" alt="Gallery Image"> --}}

                                                <img src="{{ $singleProduct->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}"
                                                    class="card-img-top" alt="Gallery Image">
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                                data-bs-target="#contact" type="button" role="tab"
                                                aria-controls="contact" aria-selected="false"><img
                                                    src="assets\img\shop\details\sm_03.jpg" alt=""></button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link" id="profile-tab3" data-bs-toggle="tab"
                                                data-bs-target="#profile2" type="button" role="tab"
                                                aria-controls="profile2" aria-selected="false"><img
                                                    src="assets\img\shop\details\sm_04.jpg" alt=""></button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link" id="profile-tab4" data-bs-toggle="tab"
                                                data-bs-target="#profile3" type="button" role="tab"
                                                aria-controls="profile3" aria-selected="false"><img
                                                    src="assets\img\shop\details\sm_05.jpg" alt=""></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">



                            <div class="details_content mt-10 mb-30">
                                <div class="product-bottom">
                                    <div class="bps-badge">
                                        <span class="bps-badge bps-badge--leftstock">
                                            @if ($singleProduct->quantity > 0)
                                                IN STOCK
                                            @else
                                                OUT OF STOCK
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="product-bottom mt-3">
                                    <div class="bps-product__branch"><a href="#">

                                            <h6> {{ $singleProduct->brand->name ?? '' }}</h6>
                                        </a>
                                    </div>
                                </div>

                            </div>

                            <div class="details_content mt-1 mb-20">
                                <h3 class="title">{{ $singleProduct->name }}</h3>
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
                                    <div class="text">
                                        <span>({{ round($singleProduct->averageRating, 1) }}
                                            Reviews )</span>
                                    </div>
                                    <br>
                                </div>

                                <div class="bps-product__desc">
                                    <ul class="bps-product__list">
                                        <li>
                                            @if ($singleProduct->is_refundable == 1)
                                                <i class='bx bx-check'>Refundable</i>
                                            @else
                                                <i class='bx bx-x'>Non-Refundable</i>
                                            @endif
                                            <br>

                                        </li>

                                        <li>
                                            <br>
                                            <i class='bx bx-check'>Minimum Purchase Unit is
                                                {{ $singleProduct->min_purchase_unit }}
                                            </i>
                                        </li>
                                    </ul>
                                </div>
                                <br>


                                <div class="bps-product__meta">

                                    @if ($singleProduct->discount === 0)
                                        <span class="bps-product__price">Rs.
                                            {{ $singleProduct->selling_price }}</span>
                                    @else
                                        @if ($singleProduct->discount_type === 'percent')
                                            <span class="bps-product__price">Rs.
                                                {{ $singleProduct->selling_price * (1 - $singleProduct->discount / 100) }}</span>
                                            <span class="bps-product__del">Rs.
                                                {{ $singleProduct->selling_price }}</span>
                                        @else
                                            <span class="bps-product__price">Rs.
                                                {{ $singleProduct->selling_price - $singleProduct->discount }}</span>
                                            <span class="bps-product__del">Rs.
                                                {{ $singleProduct->selling_price }}</span>
                                        @endif
                                    @endif
                                </div>
                                <hr>
                                <br>

                                @if ($singleProduct->is_sellable)
                                    <form id="add-to-cart-form">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $singleProduct->id }}">
                                        <x-input-field :type="'date'" :label="'Delivery Date'" :name="'delivery_date'"
                                            :placeholder="'enter a delivery date'" :col="6" :required="TRUE"
                                            :autofocus="TRUE" />
                                        <span id="add_delivery_date"> </span>
                                        <div class="ps-form--review">
                                            <div class="ps-form__block">
                                                <label class="ps-form__label">Leave Your Note Here<span
                                                        class="text-muted"> (Optional) </span> </label>
                                                <textarea class="form-control ps-form__textarea"
                                                    name="user_note"></textarea>
                                            </div>

                                        </div>
                                        <ul class="btns_group ul_li">
                                            <li>
                                                <h4>Quantity:</h4>
                                                <div class="def-number-input number-input safari_only me-3">
                                                    <button type="button btn-minus" class="minus ps-plus-minus"
                                                        onclick="this.querySelector('input[type=number]').stepDown()"><i
                                                            class="fa fa-minus"></i></button>
                                                    <input class="quantity single-product-input" min="0" name="quantity" value="1"
                                                        type="number" oninput="(this.value = Math.abs(this.value))">
                                                    <button type="button" class="plus ps-plus-minus"
                                                        onclick="this.querySelector('input[type=number]').stepUp()"><i
                                                            class="fa fa-plus"></i></button>
                                                </div>
                                            </li>

                                            <li><a class="ps-btn ps-btn--warning mt-5" href="javascript:void(0);"
                                                    id="add-to-cart-form" onclick="addToCart()">
                                                    Add To Cart</a></li>

                                            <li>

                                        </ul>
                                        <div class="details_content mb-30">

                                            <span>({{ $singleProduct->quantity }} ) available</span>
                                        </div>

                                    </form>
                                @else
                                    <div class="bps-product__meta">
                                        <span class="bps-product__price">Sorry, This product is
                                            unavailable at the moment!</span>

                                    </div>
                                @endif

                                <div class="blog-details-tags">
                                    <h4>Tags:</h4>
                                    <ul>
                                        @if ($singleProduct->tags != '')
                                            @foreach (explode(',', $singleProduct->tags) as $tag)
                                                <li>
                                                    <a href="#">{{ $tag }}</a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>

                                <div class="bps-product__type">
                                    <ul class="bps-product__list uul_li ">
                                        <li> <span class="bps-list__title"><b> SKU: </b></span><a class="ps-list__text"
                                                href="#">{{ $singleProduct->sku }}</a>
                                        </li>
                                    </ul>
                                </div>

                                <hr>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="product_info_wrap mb-50">
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-pills product_info" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="ps-btn ps-btn--warning nav-link nav-profile-link-active" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                        aria-selected="true">Product Details</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="ps-btn ps-btn--primary nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false"> Additionnal
                                        Information</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="ps-btn ps-btn--primary nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">Review (
                                        {{ $singleProduct->ratings->count() }} )</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <div class="info_wrap">
                                        <p>{!! $singleProduct->description !!}</p>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                    aria-labelledby="pills-profile-tab">
                                    <div class="info_wrap">
                                        <div class="table-responsive">
                                            <h3 class="title">Additional information</h3>
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th>Weight</th>
                                                        <td class="product_weight">{{ $singleProduct->weight }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Size</th>
                                                        <td class="product_dimensions">Small, Medium, Large</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                    aria-labelledby="pills-contact-tab">
                                    {{-- <div class="info_wrap">
                                        <p>Peoples review here ****</p>
                                    </div> --}}

                                    <div class="ps-form--review mb-3">
                                        @if ($user_rating)
                                            <div class="ps-form__title">Update your review</div>
                                        @else
                                            <div class="ps-form__title">Write a review</div>
                                        @endif
                                        <div class="ps-form__desc">
                                            Required fields are marked *</div>
                                        @auth
                                            <form method="POST" id="review-form" action="{{ route('review.store') }}">
                                                @csrf
                                                <input type="hidden" name="product_id" id="product_id"
                                                    value="{{ $singleProduct->id }}">

                                                @if ($user_rating)
                                                    <div class="row">
                                                        <div class="col-12 col-lg-4">
                                                            <label class="ps-form__label">Your rating *</label>
                                                            <div class="rating-css">
                                                                <div class="star-icon">
                                                                    @for ($i = 1; $i <= $user_rating->rating; $i++)
                                                                        <input type="radio" value="{{ $i }}"
                                                                            name="rating" checked
                                                                            id="rating{{ $i }}">
                                                                        <label for="rating{{ $i }}"
                                                                            class="fa fa-star"></label>
                                                                    @endfor
                                                                    @for ($j = $user_rating->rating + 1; $j <= 5; $j++)
                                                                        <input type="radio" value="{{ $j }}"
                                                                            name="rating" id="rating{{ $j }}">
                                                                        <label for="rating{{ $j }}"
                                                                            class="fa fa-star"></label>
                                                                    @endfor

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="ps-form__block">
                                                                <label class="ps-form__label">Your review *</label>
                                                                <textarea class="form-control ps-form__textarea"
                                                                    name="review">{!! $user_rating->review !!}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 text-center">
                                                            <button class="btn ps-btn ps-btn--warning mb-4">Update
                                                                Review</button>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="row">
                                                        <div class="col-12 col-lg-4">
                                                            <label class="ps-form__label">Your rating *</label>
                                                            <div class="rating-css">
                                                                <div class="star-icon">
                                                                    <input type="radio" value="1" name="rating" checked
                                                                        id="rating1">
                                                                    <label for="rating1" class="fa fa-star"></label>
                                                                    <input type="radio" value="2" name="rating"
                                                                        id="rating2">
                                                                    <label for="rating2" class="fa fa-star"></label>
                                                                    <input type="radio" value="3" name="rating"
                                                                        id="rating3">
                                                                    <label for="rating3" class="fa fa-star"></label>
                                                                    <input type="radio" value="4" name="rating"
                                                                        id="rating4">
                                                                    <label for="rating4" class="fa fa-star"></label>
                                                                    <input type="radio" value="5" name="rating"
                                                                        id="rating5">
                                                                    <label for="rating5" class="fa fa-star"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="ps-form__block">
                                                                <label class="ps-form__label">Your review *</label>
                                                                <textarea class="form-control ps-form__textarea"
                                                                    name="review"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 text-center">
                                                            <button class="btn ps-btn ps-btn--warning">Add
                                                                Review</button>
                                                        </div>
                                                    </div>
                                                @endif



                                            </form>
                                        @endauth
                                        @guest
                                            <div class="row">
                                                <div class="col-12 col-lg-4">
                                                    <label class="ps-form__label">Login to provide review.</label>
                                                </div>
                                            </div>
                                        @endguest

                                    </div>
                                    <div class="ps-product__tabreview" id="product-review">
                                        @forelse ($singleProduct->ratings->sortByDesc('created_at')->take(2) as $rating)
                                            <div class="ps-review--product">
                                                <div class="ps-review__row">
                                                    <div class="ps-review__avatar"><img
                                                            src="{{ $rating->user->getFirstOrDefaultMediaUrl('avatars', 'avatar') }}"
                                                            alt="alt" /></div>
                                                    <div class="ps-review__info">
                                                        <div class="ps-review__name">
                                                            {{ $rating->user->name }} </div>
                                                        <div class="ps-review__date">
                                                            {{ $rating->created_at->isoFormat('MMM Do YYYY') }}
                                                        </div>
                                                    </div>
                                                    <div class="rating">
                                                        @for ($i = 0; $i < $rating->rating; $i++)
                                                            <i class="fa fa-star checked"> </i>
                                                        @endfor
                                                        @for ($j = $rating->rating; $j < 5; $j++)
                                                            <i class="fa fa-star"> </i>
                                                        @endfor
                                                    </div>

                                                    <div class="ps-review__desc">
                                                        <p>{!! $rating->review !!}</p>
                                                    </div>
                                                    @auth
                                                        @if (auth()->user()->id == $rating->user_id)
                                                            <span>
                                                                <a href="javascript:void(0)" id="delete-review"
                                                                    data-id="{{ $rating->id }}"
                                                                    class="btn btn-danger btn-sm" data-bs-toggle="tooltip"
                                                                    title="Delete Review">Delete
                                                                </a>
                                                            </span>
                                                        @endif
                                                    @endauth
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
                                                <button class="btn ps-btn ps-btn--warning" id="view-more">View
                                                    More</button>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="releted_product">
                    <div class="sec_title sec_title-2">
                        <h2>Related products</h2>
                    </div>
                    <div class="row justify-content-center">
                        @foreach ($products->take(8) as $product)
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-30">
                                <div class="shop_single white_bg related-product"
                                    style="background-color: rgba(238, 226, 226, 0.571);">
                                    <div class="thumb text-center">
                                        <a class="image"
                                            href="{{ route('site.page.singleProductShow', $product->id) }}">
                                            <img alt="product"
                                                src="{{ $product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}" /></a>
                                        <div class="actions">
                                            <a href="javascript:void(0);" class="action"
                                                id="{{ $product->id }}" onclick="productview({{ $product->id }})">
                                                <i class='bx bx-basket'></i>
                                            </a>
                                            <a href="javascript:void(0);" class="action"
                                                id="{{ $product->id }}" onclick="productview({{ $product->id }})">
                                                <i class="bx bx-show-alt font-size-16 align-middle"></i></a>
                                        </div>
                                        @php
                                            $type = $product->discount_type === 'flat' ? 'Rs. ' : '% ';
                                            
                                        @endphp
                                        <span class="badge">{{ $product->discount }}
                                            {{ $type }} OFF</span>
                                    </div>
                                    <div class="content">
                                        <div class="s_top ul_li">
                                            <span class="cat">{{ $product->brand->name }}</span>
                                            <ul class="rating_star ul_li">
                                                <li><i class="bx bxs-star"></i></li>
                                                <li><i class="bx bxs-star"></i></li>
                                                <li><i class="bx bxs-star"></i></li>
                                                <li><i class="bx bx-star"></i></li>
                                                <li><i class="bx bx-star"></i></li>
                                            </ul>
                                        </div>
                                        <h3 class="title"><a
                                                href="shop-details.html">{{ $product->name }}</a></h3>
                                        <div class="single-product ul_li">
                                            <div class="s_bottom ul_li">
                                                <span class="text-dark">Price: &nbsp;</span>
                                                <span class="new">{{ $product->selling_price }}</span>
                                                <span class="old">{{ $product->cost_price }}</span>
                                            </div>
                                            <div class="related-product-add-cart-list  ul_li">
                                                <a href="javascript:void(0);" id="{{ $product->id }}"
                                                    onclick="productview({{ $product->id }})">
                                                    <i class='bx bxs-cart add-cart-list'></i>
                                                    Add to Cart
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </section>
        <!-- shop details end -->

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

</x-site-master-layout>
