<main class="main pages mb-80">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('site.page') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Vendors List
            </div>
        </div>
    </div>
    <div class="page-content pt-50">
        <div class="container">
            <div class="archive-header-2 text-center">
                <h1 class="display-2 mb-50">Vendors List</h1>
                <div class="row">
                    <div class="col-lg-5 mx-auto">
                        <div class="sidebar-widget-2 widget_search mb-50">
                            <div class="search-form">
                                <form action="#">
                                    <input type="text" placeholder="Search vendors (by name or ID)...">
                                    <button type="submit"><i class="fi-rs-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-50">
                <div class="col-12 col-lg-8 mx-auto">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p>We have <strong class="text-brand">{{ $vendors_count }}</strong> vendors now</p>
                        </div>
                        <div class="sort-by-product-area">
                            <div class="sort-by-cover mr-10">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps"></i>Show:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> 6 <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>

                                        <li><a href="javascript:void(0)" wire:click="setPaginationLimit(6)">6</a></li>
                                        <li><a href="javascript:void(0)" wire:click="setPaginationLimit(10)">10</a></li>
                                        <li><a href="javascript:void(0)" wire:click="setPaginationLimit(16)">16</a></li>
                                        <li><a href="javascript:void(0)" wire:click="setPaginationLimit(20)">20</a></li>
                                        <li><a href="javascript:void(0)" wire:click="setPaginationLimit(26)">26</a></li>
                                        <li><a href="javascript:void(0)" wire:click="setPaginationLimit(10)">10</a></li>

                                    </ul>
                                </div>
                            </div>
                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> Default <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a wire:click="setFilter(1)">Default</a></li>
                                        <li><a wire:click="setFilter(2)">Total items</a></li>
                                        <li><a wire:click="setFilter(3)">Avg. Rating</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row vendor-grid">
                @foreach ($vendors as $vendor)
                    <div class="col-lg-6 col-md-6 col-12 col-sm-6">
                        <div class="vendor-wrap style-2 mb-40">
                            <!--  <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="hot">Mall</span>
                                </div> -->
                            <div class="vendor-img-action-wrap">
                                <div class="vendor-img">
                                    <a href="{{ route('site.page.vendorDetails', $vendor->id) }}">
                                        <img class="default-img"
                                            src="{{ $vendor->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}"
                                            alt="">
                                    </a>
                                </div>
                                <div class="mt-10">
                                    <span class="font-small total-product">{{ $vendor->products->count() }}
                                        products</span>
                                </div>
                            </div>
                            <div class="vendor-content-wrap">
                                <div class="mb-30">


                                    <h4 class="mb-5"><a
                                            href="{{ route('site.page.vendorDetails', $vendor->id) }}">{{ $vendor->name }}</a>
                                    </h4>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    <div class="vendor-info d-flex justify-content-between align-items-end mt-30">
                                        <ul class="contact-infor text-muted">
                                            <li><img src="assets\imgs\theme\icons\icon-location.svg"
                                                    alt=""><strong>Address: </strong>
                                                <span>{!! $vendor->address !!}</span>
                                            </li>
                                            <li><img src="assets\imgs\theme\icons\icon-contact.svg" alt=""><strong>Call
                                                    Us:</strong><span> {{ $vendor->phone }}</span></li>
                                        </ul>
                                        <a href="{{ route('site.page.vendorDetails', $vendor->id) }}"
                                            class="btn btn-xs">Visit Store <i
                                                class="fi-rs-arrow-small-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!--end vendor card-->
                <!--end vendor card-->
            </div>

            <div class="pagination-area mb-20">
                <nav aria-label="Page navigation example">
                    <div class="">
                        {{ $vendors->links() }}
                    </div>
                </nav>
            </div>

            <div class="d-flex justify-content-center">

                <a href=""></a>

            </div>
        </div>
    </div>
</main>
