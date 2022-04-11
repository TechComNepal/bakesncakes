 <main class="main">
     <div class="page-header breadcrumb-wrap">
         <div class="container">
             <div class="breadcrumb">
                 <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                 <span></span> Store <span></span> {{ $vendor->name }}
             </div>
         </div>
     </div>
     <div class="container mb-30">
         <div class="archive-header-2 text-center pt-80 pb-50">
             <h1 class="display-2 mb-50">{{ $vendor->name }} Store</h1>
             <div class="row">
                 <div class="col-lg-5 mx-auto">
                     <div class="sidebar-widget-2 widget_search mb-50">
                         <div class="search-form">
                             <form action="#">
                                 <input type="text" placeholder="Search in this store...">
                                 <button type="submit"><i class="fi-rs-search"></i></button>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="row flex-row-reverse">
             <div class="col-lg-4-5">
                 <div class="shop-product-fillter">
                     <div class="totall-product">
                         <p>We found <strong class="text-brand">{{ $vendor->products->count() }}</strong> items
                             for you!</p>
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
                 @isset($products)
                     <div class="row product-grid">
                         @if ($products->count() > 0)
                             @foreach ($products as $product)
                                 <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                     <div class="product-cart-wrap mb-30">
                                         <div class="product-img-action-wrap">
                                             <div class="product-img product-img-zoom">
                                                 <a href="{{ route('site.page.singleProductShow', $product->id) }}">
                                                     <img class="default-img"
                                                         src="{{ $product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}"
                                                         alt="">
                                                     <img class="hover-img"
                                                         src="{{ $product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}"
                                                         alt="">
                                                 </a>
                                             </div>
                                             <div class="product-action-1">
                                                 <a aria-label="Add To Wishlist" class="action-btn featured-products_a"
                                                     href="javascript:void(0);" id="{{ $product->id }}"
                                                     onclick="addToWishList({{ $product->id }})"><i
                                                         class="fi-rs-heart"></i></a>
                                                 <a aria-label="Compare" class="action-btn featured-products_a"
                                                     href="javascript:void(0);" id="{{ $product->id }}"
                                                     onclick="addToCompare({{ $product->id }})"><i
                                                         class="fi-rs-shuffle"></i></a>
                                                 <a aria-label="Quick view" class="action-btn featured-products_a"
                                                     id="{{ $product->id }}"
                                                     onclick="productview({{ $product->id }})"><i
                                                         class="fi-rs-eye"></i></a>

                                             </div>
                                             <div class="product-badges product-badges-position product-badges-mrg">
                                                 <span class="hot">Hot</span>
                                             </div>
                                         </div>
                                         <div class="product-content-wrap">
                                             <div class="product-category">
                                                 <a href="javascript:void(0)">{{ $product->category->name }}</a>
                                             </div>
                                             <h2><a
                                                     href="{{ route('site.page.singleProductShow', $product->id) }}">{{ $product->name }}</a>
                                             </h2>
                                             <div class="product-rate-cover">
                                                 <div class="rating">
                                                     @php
                                                         $num_rating = number_format($product->averageRating);
                                                     @endphp
                                                     @for ($i = 0; $i < $num_rating; $i++)
                                                         <i class="fa fa-star checked">
                                                         </i>
                                                     @endfor
                                                     @for ($j = $num_rating; $j < 5; $j++)
                                                         <i class="fa fa-star"> </i>
                                                     @endfor
                                                     <span class="font-small ml-5 text-muted">
                                                         ({{ round($product->averageRating, 1) }})
                                                     </span>

                                                 </div>
                                             </div>
                                             <div>
                                                 <span class="font-small text-muted">By <a
                                                         href="vendor-details-1.html">{{ $vendor->name }}</a></span>
                                             </div>
                                             <div class="product-card-bottom">
                                                 @if ($product->discount === 0)
                                                     <div class="product-price">
                                                         <span> Rs.{{ $product->selling_price }}</span>
                                                     </div>
                                                 @else
                                                     @if ($product->discount_type === 'percent')
                                                         <div class="product-price">
                                                             <span>
                                                                 Rs.{{ $product->selling_price * (1 - $product->discount / 100) }}</span>
                                                             <span
                                                                 class="old-price">Rs.{{ $product->selling_price }}</span>
                                                         </div>
                                                     @else
                                                         <div class="product-price">
                                                             <span>
                                                                 Rs.
                                                                 {{ $product->selling_price - $product->discount }}</span>
                                                             <span class="old-price">
                                                                 Rs.{{ $product->selling_price }}</span>
                                                         </div>
                                                     @endif
                                                 @endif
                                                 <div class="add-cart">
                                                     <a class="add" href="javascript:void(0)"
                                                         id="{{ $product->id }}"
                                                         onclick="productview({{ $product->id }})"><i
                                                             class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             @endforeach
                         @endif
                         <!--end product card-->

                     </div>
                 @endisset
                 <!--product grid-->
                 <div class="pagination-area mt-20 mb-20">
                     <nav aria-label="Page navigation example">
                         <div class="">
                             {{ $products->links() }}
                         </div>
                         <!-- end pagination -->
                     </nav>
                 </div>
                 <!--End Best Sales-->
                 <section class="section-padding pb-5">
                     <div class="container">
                         <div class="section-title wow animate__animated animate__fadeIn" data-wow-delay="0">
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
                                                 <div class="deals-countdown" data-countdown="2025/03/25 00:00:00">
                                                 </div>
                                             </div>
                                             <div class="deals-content">
                                                 <h2><a
                                                         href="shop-product-right.html">{{ $trending_product->name }}</a>
                                                 </h2>
                                                 <div class="product-rate-cover">
                                                     <div class="rating">
                                                         @php
                                                             $num_rating = number_format($trending_product->averageRating);
                                                         @endphp
                                                         @for ($i = 0; $i < $num_rating; $i++)
                                                             <i class="fa fa-star checked"> </i>
                                                         @endfor
                                                         @for ($j = $num_rating; $j < 5; $j++)
                                                             <i class="fa fa-star"> </i>
                                                         @endfor
                                                         <span class="font-small ml-5 text-muted">
                                                             ({{ round($trending_product->averageRating, 1) }})</span>
                                                     </div>

                                                 </div>
                                                 <div>
                                                     <span class="font-small text-muted">By <a
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
                     </div>
                 </section>
                 <!--End Deals-->

             </div>
             <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                 <div class="sidebar-widget widget-store-info mb-30 bg-3 border-0">
                     <div class="vendor-logo mb-30">
                         <img class="default-img"
                             src="{{ $vendor->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}" alt="">
                     </div>
                     <div class="vendor-info">

                         <h4 class="mb-5"><a
                                 href="{{ route('site.page.vendorDetails', $vendor->id) }}">{{ $vendor->name }}</a>
                         </h4>

                         <div class="product-rate-cover mb-15">
                             <div class="product-rate d-inline-block">
                                 <div class="product-rating" style="width: 90%"></div>
                             </div>
                             <span class="font-small ml-5 text-muted"> (4.0)</span>
                         </div>

                         <div class="vendor-info">
                             <ul class="font-sm mb-20">
                                 <li><img class="mr-5" src="assets\imgs\theme\icons\icon-location.svg"
                                         alt=""><strong>Address: </strong> <span>{!! $vendor->address !!}</span></li>
                                 <li><img class="mr-5" src="assets\imgs\theme\icons\icon-contact.svg"
                                         alt=""><strong>Call Us:</strong><span>{{ $vendor->phone }}</span></li>
                             </ul>
                             <a href="{{ route('site.page.vendorDetails', $vendor->id) }}"
                                 class="btn btn-xs">Contact Seller <i class="fi-rs-arrow-small-right"></i></a>
                         </div>
                     </div>
                 </div>

                 <!-- Fillter By Price -->
                 <div class="sidebar-widget price_range range mb-30">
                     <h5 class="section-title style-1 mb-30">Fill by price</h5>
                     <div class="price-filter">
                         <div class="price-filter-inner">
                             <div id="slider-range" class="mb-20"></div>
                             <div class="d-flex justify-content-between">
                                 <div class="caption">From: <strong id="slider-range-value1"
                                         class="text-brand"></strong></div>
                                 <div class="caption">To: <strong id="slider-range-value2"
                                         class="text-brand"></strong></div>
                             </div>
                         </div>
                     </div>


                 </div>


             </div>
         </div>
     </div>
 </main>
