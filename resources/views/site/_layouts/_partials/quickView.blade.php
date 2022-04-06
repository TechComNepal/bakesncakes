<div class="modal-body">

    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    <div class="ps-product--detail">
        <div class="row">

            <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                <div class="detail-gallery">
                    <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                    <!-- MAIN SLIDES -->
                    <div class="product-image-slider">
                        <figure class="border-radius-10">
                            <img src="{{ $product->getFirstOrDefaultMediaUrl('image', 'original') }}"
                                alt="Gallery Image">
                        </figure>
                    </div>

                </div>
                <!-- End Gallery -->
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="detail-info pr-30 pl-30">
                    <span class="stock-status out-stock product-title"> Sale Off </span>
                    <h2 class="title-detail ">{{ $product->name }}</h2>
                    <div class="product-detail-rating">
                        <div class="product-rate-cover text-end">
                            <div class="rating">
                                @php
                                    $num_rating = number_format($product->averageRating);
                                @endphp
                                @for ($i = 0; $i < $num_rating; $i++)
                                    <i class="fa fa-star checked"> </i>
                                @endfor
                                @for ($j = $num_rating; $j < 5; $j++)
                                    <i class="fa fa-star"> </i>
                                @endfor

                                <span class="font-small ml-5 text-muted">({{ round($product->averageRating, 1) }}
                                    )</span>

                                <br>
                            </div>


                        </div>
                    </div>

                    <div class="clearfix product-price-cover">
                        <div class="product-price primary-color float-left">
                            @if ($product->discount === 0)
                                <span class="current-price text-brand">Rs.
                                    {{ $product->selling_price }}</span>
                            @else
                                @if ($product->discount_type === 'percent')
                                    <span class="current-price text-brand">Rs.
                                        {{ $product->selling_price * (1 - $product->discount / 100) }}</span>
                                    <span>
                                        <span class="save-price font-md color3 ml-15">{{ $product->discount }}%
                                            Off</span>
                                        <span class="old-price font-md ml-15">Rs.
                                            {{ $product->selling_price }}</span>
                                    </span>
                                @else
                                    <span class="current-price text-brand">Rs.
                                        {{ $product->selling_price - $product->discount }}</span>
                                    <span>
                                        @php
                                            $discount_rate = ($product->discount / $product->selling_price) * 100;
                                        @endphp
                                        <span class="save-price font-md color3 ml-15">{{ round($discount_rate, 2) }}%
                                            Off</span>
                                        <span class="old-price font-md ml-15">Rs.{{ $product->selling_price }}</span>
                                    </span>
                                @endif
                            @endif

                        </div>
                    </div>

                    <div class="ps-product__type">
                        <ul class="ps-product__list">
                            @if ($product->tags)
                                <li>
                                    <span class="ps-list__title">Minimun Purchase Unit: </span>
                                    <a class="ps-list__text"
                                        href="javascript:void(0)">{{ $product->min_purchase_unit }}</a>

                                </li>
                            @endif

                        </ul>
                    </div>


                    <form id="add-to-cart-form">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <hr />
                        <div class="ps-product__meta">
                            <span class="ps-product__price" id="chosen_price"></span>
                        </div>
                        <x-input-field :type="'date'" :label="'Delivery Date'" :name="'delivery_date'" :placeholder="'enter a delivery date'"
                            :col="6" :required="true" />
                        <span id="add_delivery_date"> </span>
                        <div class="ps-form--review">

                            <div class="ps-form__block">
                                <label class="ps-form__label">Leave Your Note Here<span class="text-muted">
                                        (Optional) </span> </label>
                                <textarea class="form-control ps-form__textarea" name="user_note"></textarea>
                            </div>

                        </div>
                        <div class="ps-product__quantity">
                            @if ($product->is_sellable)
                                <h6>Quantity</h6>
                            @endif

                            <div class="d-md-flex align-items-center">
                                @if ($product->is_sellable)
                                    <div class="def-number-input number-input safari_only me-3">
                                        <button type="button" class="minus"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                                class="fa fa-minus"></i></button>
                                        <input class="quantity" min="0" name="quantity" value="1" type="number"
                                            oninput="(this.value = Math.abs(this.value))" />
                                        <button type="button" class="plus"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                class="fa fa-plus"></i></button>
                                    </div>

                                    <button type="button" class="btn btn-cart" onclick="addToCart()">
                                        <i class='bx bxs-cart'></i>
                                        <span class="d-md-inline-block"> Add to cart </span>
                                    </button>
                                @else
                                    <section class="mt-5 ps-section--featured">
                                        <h4 class="ps-section__title">Sorry, This product is
                                            unavailable at the moment!</h4>
                                    </section>
                                @endif
                            </div>
                        </div>
                    </form>
                    <div class="ps-product__type">
                        <ul class="ps-product__list">
                            @if ($product->tags)
                                <li>
                                    <span class="ps-list__title">Tags: </span>
                                    <a class="ps-list__text" href="#">{{ $product->tags }}</a>

                                </li>
                            @endif

                            <li> <span class="ps-list__title">SKU: </span><a class="ps-list__text"
                                    href="#">{{ $product->sku }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {

        flatpickr("#delivery_date", {
            "enableTime": true,
        });
    });
</script>
