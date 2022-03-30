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

        /* .collection-bottom span {
            font-size: 16px !important;
        }

        .add-cart-list a {
            margin-left: 222px !important;
            padding: 5px;
            font-size: 15px !important;
        } */
    </style>
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

    <div class="">
        <br>
        <div class="container">
            <div class="page-title-item">
                <h2 class="text-dark">Shop</h2>
                <ul>
                    <li>
                        <a style="color:#333" href="{{route('site.page')}}">Home</a>
                    </li>
                    <li>
                        <i style="color:#333" class="bx bx-chevron-right"></i>
                    </li>
                    <li>Shop</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container pt-100">
        <div class="row">
            <div class="col-lg-3 col-md-2">
                <div class="accordin">
                    @foreach($categories as $category)
                    <div class="accorin_item">
                        <div class="accordin_title">
                            <h5><i class="fas fa-birthday-cake"></i> {{$category->name}}</h5>
                            <div class=""><i class="bi bi-caret-right arrow"></i></div>
                            <box-icon name='chevron-down'></box-icon>ssjkskj
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
            </div>
            <div class="col-lg-9 col-md-10 ">
                <div class="row fail" id="Container">

                    <div class="row" id="Container">
                        @foreach($products as $product)

                        <div class="col-sm-6 col-lg-3 all mix {{$product->category->slug}}">

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

                                    @php
                                    $type = $product->discount_type === 'flat' ? 'Rs.' : '%';

                                    @endphp
                                    <div class="thumb">

                                        <span class="badge" style="background-color:#af3039; text-align:right;">{{
                                            $product->discount }}
                                            {{ $type }} OFF</span>

                                        <div class="add-cart">
                                            <a href="javascript:void(0);" id="{{ $product->id }}"
                                                onclick="productview({{ $product->id }})">
                                                <i class="bx bxs-cart"></i>
                                                Add to Cart
                                            </a>

                                        </div>
                                    </div>
                                </div>

                                <div class="collection-bottom">
                                    <h5>{{ $product->name }}</h5>
                                    <ul>
                                        <li>
                                            @if ($product->discount === 0)
                                            <span class="bps-product__price">Rs.
                                                {{ $product->selling_price }}</span>
                                            @else
                                            @if ($product->discount_type === 'percent')
                                            <span class="bps-product__price">Rs.
                                                {{ $product->selling_price * (1 - $product->discount / 100) }}</span>
                                            @else
                                            <span class="bps-product__price">Rs.
                                                {{ $product->selling_price - $product->discount }}</span>

                                            @endif
                                            @endif
                                        </li>
                                        <li>

                                            <div class="add-cart-list">
                                                <a href="javascript:void(0);" id="{{ $product->id }}"
                                                    onclick="productview({{ $product->id }})">
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
        </div>

    </div>
    {{-- <div class="d-flex justify-content-center">
        {!! $products->links() !!}
    </div> --}}
    <br>





</x-site-master-layout>