<x-site-master-layout>

    @push('stylesheet')
    <style>
        /* check side categories */
        .accordin {
            /* padding-top: 5rem;
        min-height: 50rem; */
            margin: 0 auto;
        }

        .accordin_item {
            margin-bottom: 1rem;
        }

        .accordin_title {
            position: relative;
            padding: 2rem 6rem 2rem 2.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            background: var(--secondary-bg-color);
            border-bottom: 2px solid #fff;
            color: white;
        }

        .accordin_title h5,
        i {
            color: #fff;
        }

        .accordin_title .arrow {
            position: absolute;
            right: 2rem;
            top: 25%;
            transition: all ease 0.6s 0.5s;
        }

        .accordin_title h5 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .accordin_title p {
            font-size: 1rem;
            line-height: 2.5rem;
            font-weight: 500;
            color: #696868;
            margin-bottom: 10px;
        }

        .accordin_desc {
            padding: 1.5rem;
            background-color: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            border-top: 3px solid rgba(0, 0, 0, 0.07);
            display: flex;
            flex-direction: column;
            line-height: 2;
            padding-left: 3em;
            list-style-type: none;

        }

        .accordin_desc li:hover {
            background-color: #aaa;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            border-top: 3px solid rgba(0, 0, 0, 0.07);
            display: flex;
            cursor: pointer;

            flex-direction: column;
            list-style-type: none;

        }

        .accordin_item.active {
            color: var(--secondary-bg-color-hover);
        }

        .accordin_item.active .arrow {
            transform: scale(-1) translateY(5px);
        }

        .sub-item:hover {
            color: var(--secondary-font-color);
        }

        .bxs-cart {
            color: var(--secondary-bg-color);
        }

        .blog-item {
            box-shadow: 0 0 20px 0 #333;
        }

        .blog-item .blog-top span {
            color: #333 !important;
        }
    </style>



    <style>
        #input-select,
        #input-number {
            padding: 7px;
            margin: 15px 5px 5px;
            width: 70px;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.1/nouislider.min.css"
        integrity="sha512-qveKnGrvOChbSzAdtSs8p69eoLegyh+1hwOMbmpCViIwj7rn4oJjdmMvWOuyQlTOZgTlZA0N2PXA7iA8/2TUYA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush

    <div class="loader" style="display: none;">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="spinner"></div>
            </div>
        </div>
    </div>

    <div class="mobile-nav">
        <a href="index.html" class="logo">
            <img src="assets/img/logo-two.png" alt="Logo">
        </a>
    </div>

    <div class=" ">
        <div class="container">
            <div class="page-title-item">
                <h2 class="text-dark">Categories</h2>
                <ul>
                    <li>
                        <a href="{{route('site.page')}}">Home</a>
                    </li>
                    <li>
                        <i class="bx bx-chevron-right"></i>
                    </li>
                    <li>Categories</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container pt-100">
        <div class="row" id="Container">

            <!-- Sidebar Area Start -->
            <div class="ec-shop-leftside col-lg-3 col-md-3 col-sm-3 col-xs-2 mb-2 order-lg-first col-md-3 order-md-last">
                <div id="shop_sidebar ">
                    <div class="ec-sidebar-heading">
                        <h1>Filter Products By</h1>
                    </div>
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Category Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Category</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <ul>
                                    @foreach ($categories->take(8) as $category )
                                        
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" checked=''> <a href="#">{{  $category->name  }}</a><span
                                                class="checked"></span>
                                        </div>
                                    </li>
                                    @endforeach
                                 
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox"> <a href="#">phone</a><span class="checked"></span>
                                        </div>
                                    </li>
                                    <li id="ec-more-toggle-content" style="padding: 0; display: none;">
                                        <ul>
                                            <li>
                                                <div class="ec-sidebar-block-item">
                                                    <input type="checkbox"> <a href="#">Watch</a><span
                                                        class="checked"></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ec-sidebar-block-item">
                                                    <input type="checkbox"> <a href="#">Cap</a><span
                                                        class="checked"></span>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item ec-more-toggle">
                                            <span class="checked"></span><span id="ec-more-toggle">More
                                                Categories</span>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <!-- Sidebar Size Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Size</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <ul>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" value="" checked=""><a href="#">S</a><span
                                                class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" value=""><a href="#">M</a><span
                                                class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" value=""> <a href="#">L</a><span
                                                class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" value=""><a href="#">XL</a><span
                                                class="checked"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item">
                                            <input type="checkbox" value=""><a href="#">XXL</a><span
                                                class="checked"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Sidebar Color item -->
                        <div class="ec-sidebar-block ec-sidebar-block-clr">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Color</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <ul>
                                    <li>
                                        <div class="ec-sidebar-block-item"><span
                                                style="background-color:#c4d6f9;"></span></div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item"><span
                                                style="background-color:#ff748b;"></span></div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item"><span
                                                style="background-color:#000000;"></span></div>
                                    </li>
                                    <li class="active">
                                        <div class="ec-sidebar-block-item"><span
                                                style="background-color:#2bff4a;"></span></div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item"><span
                                                style="background-color:#ff7c5e;"></span></div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item"><span
                                                style="background-color:#f155ff;"></span></div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item"><span
                                                style="background-color:#ffef00;"></span></div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item"><span
                                                style="background-color:#c89fff;"></span></div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item"><span
                                                style="background-color:#7bfffa;"></span></div>
                                    </li>
                                    <li>
                                        <div class="ec-sidebar-block-item"><span
                                                style="background-color:#56ffc1;"></span></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Sidebar Price Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Price</h3>
                            </div>
                            <div class="ec-sb-block-content es-price-slider">
                                <div class="ec-price-filter">
                                    <div id="ec-sliderPrice" class="filter__slider-price" data-min="0" data-max="250"
                                        data-step="10"></div>
                                    <div class="ec-price-input">
                                        <label class="filter__label"><input type="text" class="filter__input"></label>
                                        <span class="ec-price-divider"></span>
                                        <label class="filter__label"><input type="text" class="filter__input"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-lg-3 col-md-2">
                    <div class="accordin">
                        @foreach($categories as $category)
                        <div class="accorin_item">
                            <div class="accordin_title">
                                <h5><i class="fas fa-birthday-cake"></i> {{$category->name}}</h5>
                                <div class=""><i class="bi bi-caret-right arrow"></i></div>
                            </div>


                            <div class="accordin_desc">

                                @foreach($category->children as $subcategory)
                                <li class="filter active" data-filter=".{{$subcategory->slug}}">{{ $subcategory->name }}
                                </li>

                                @endforeach
                            </div>

                        </div>
                        @endforeach

                    </div>
                </div> --}}
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-17 mb-1">

                    @foreach($products as $product)

                    <div class="col-sm-4 col-lg-3 all mix {{$product->category->slug}}">

                        <div class="collection-item">
                            <div class="collection-top">
                                <a href="http://127.0.0.1:8000/product-details/60">
                                    <img alt="Collection"
                                        src="{{ $product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}">
                                </a>
                                <ul>
                                    <li>
                                        <i class="bx bxs-star checked"></i>
                                    </li>

                                    <li>
                                        <i class="bx bxs-star checked"></i>
                                    </li>

                                    <li>
                                        <i class="bx bxs-star checked"></i>
                                    </li>

                                    <li>
                                        <i class="bx bxs-star checked"></i>
                                    </li>

                                    <li>
                                        <i class="bx bxs-star unchecked"></i>
                                    </li>
                                </ul>

                                <div class="add-cart">
                                    <a href="javascript:void(0);" id="60" onclick="productview(60)">
                                        <i class="bx bxs-cart"></i>
                                        Add to Cart
                                    </a>
                                </div>
                                @php
                                $type = $product->discount_type === 'flat' ? 'Rs.' : '%';

                                @endphp
                                <span class="badge">{{ $product->discount }}
                                    {{ $type }}</span>

                            </div>

                            <div class="collection-bottom">
                                <h3>{{ $product->name }}</h3>
                                <ul>
                                    <li>
                                        @if ($product->discount === 0)
                                        <span class="bps-product__price">Rs.
                                            {{ $product->selling_price }}</span>
                                        @else
                                        @if ($product->discount_type === 'percent')
                                        <span class="bps-product__price">Rs.
                                            {{ $product->selling_price * (1 - $product->discount / 100)
                                            }}</span>
                                        @else
                                        <span class="bps-product__price">Rs.
                                            {{ $product->selling_price - $product->discount }}</span>

                                        @endif
                                        @endif
                                    </li>
                                    <li>

                                        <div class="add-cart-list">
                                            <a href="javascript:void(0);" id="60" onclick="productview(60)">
                                                <i class="bx bxs-cart add-cart-list"></i>
                                                Add to Cart
                                            </a>
                                        </div>
                                    </li>
                                </ul>

                            </div>

                        </div>
                    </div>
                    @endforeach



                
            </div>



            <div class="more-collection">
                <a href="food-collection.html">View More Colletction</a>
            </div>
        </div>
    </div>
    {{--
    </div> --}}
    <br>


    </div>





    @push('scripts')
    <script>
        var select = document.getElementById('input-select');

// Append the option elements
for (var i = -20; i <= 40; i++) {

    var option = document.createElement("option");
    option.text = i;
    option.value = i;

    select.appendChild(option);
}

var html5Slider = document.getElementById('html5');

noUiSlider.create(html5Slider, {
    start: [10, 30],
    connect: true,
    range: {
        'min': -20,
        'max': 40
    }
});

var inputNumber = document.getElementById('input-number');

html5Slider.noUiSlider.on('update', function (values, handle) {

    var value = values[handle];

    if (handle) {
        inputNumber.value = value;
    } else {
        select.value = Math.round(value);
    }
});

select.addEventListener('change', function () {
    html5Slider.noUiSlider.set([this.value, null]);
});

inputNumber.addEventListener('change', function () {
    html5Slider.noUiSlider.set([null, this.value]);
});
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.1/nouislider.min.js"
        integrity="sha512-T5Bneq9hePRO8JR0S/0lQ7gdW+ceLThvC80UjwkMRz+8q+4DARVZ4dqKoyENC7FcYresjfJ6ubaOgIE35irf4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @endpush
</x-site-master-layout>