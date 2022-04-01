<div class="modal-body">
    <div class="wrap-modal-slider container-fluid ps-quickview__body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="ps-product--detail">
            <div class="row">
                <div class="col-12 col-xl-6">
                    <div class="ps-product--sidebar">
                        <div class="ps-gallery--image" style="display: block;">
                            <div class="slide">
                                <div class="ps-gallery__item"><img
                                        src="{{ $product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}"
                                        alt="alt" /></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="ps-product__info">
                        <div class="ps-product__badge">
                            <span class="ps-badge ps-badge--instock">
                                @if ($product->quantity > 0)
                                    IN STOCK
                                @else
                                    OUT OF STOCK
                                @endif
                            </span>
                        </div>
                        <div class="ps-product__branch">
                            <a href="javascript:void(0)">

                                {{ $product->brand->name ?? '' }}
                            </a>
                        </div>

                        <div class="ps-product__title">
                            <a href="#" id="p_name">{{ $product->name }}</a>
                        </div>

                        <div class="ps-product__desc">
                            <ul class="ps-product__list">
                                <li>{{ $product->is_refundable == 1 ? 'Refundable' : 'Non-Refundable' }}</li>
                                <li>Minimum Purchase Unit is {{ $product->min_purchase_unit }} </li>

                            </ul>
                        </div>


                        <div class="ps-product__meta">
                            @if ($product->discount === 0)
                                <span class="ps-product__price product__price">Rs.
                                    {{ $product->selling_price }}</span>
                            @else
                                @if ($product->discount_type === 'percent')
                                    <span class="ps-product__price product__price">Rs.
                                        {{ $product->selling_price * (1 - $product->discount / 100) }}</span>
                                    <span class="ps-product__del">Rs. {{ $product->selling_price }}</span>
                                @else
                                    <span class="ps-product__price product__price">Rs.
                                        {{ $product->selling_price - $product->discount }}</span>
                                    <span class="ps-product__del">Rs. {{ $product->selling_price }}</span>
                                @endif
                            @endif
                        </div>
                        <form id="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <hr />
                            <div class="ps-product__meta">
                                <span class="ps-product__price" id="chosen_price"></span>
                            </div>
                            <x-input-field :type="'date'" :label="'Delivery Date'" :name="'delivery_date'"
                                :placeholder="'enter a delivery date'" :col="6" :required="TRUE" />
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
                                            <input class="quantity" min="0" name="quantity" value="1"
                                                type="number" oninput="(this.value = Math.abs(this.value))" />
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

                                <li> <span class="ps-list__title">SKU: </span><a class="ps-list__text" href="#">{{ $product->sku }}</a></li>
                            </ul>
                        </div>
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
