<x-site-master-layout>
    
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
        <div class="row">
                   
            <div class="col-lg-9 col-md-10 product-card">
                <div class="row fail" id="Container">

                    <div class="row" id="Container">

                        @foreach($category->products as $product)

                        <div class="col-sm-6 col-lg-3 all">

                            <div class="collection-item">
                                <div class="collection-top">
                                    <a href="{{ route('site.page.singleProductShow', $product->id) }}">
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
                    </div>



                    <div class="more-collection">
                        <a href="food-collection.html">View More Colletction</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-site-master-layout>