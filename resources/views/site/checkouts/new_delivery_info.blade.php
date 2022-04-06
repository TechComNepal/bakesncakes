<x-new-site-master-layout>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('site.page') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Shop
                    <span></span> Shipping Info
                    <span> </span>Checkout
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row mt-5">

                @php
                    $total = 0;
                @endphp

                @if (!$carts->isEmpty())
                    {{-- **************************************************** --}}
                    <form class="form-default" action="{{ route('user.store.delivery.info') }}" role="form"
                        method="POST">
                        @csrf
                        @php
                            $seller_products = [];
                            $product_ids = [];
                            
                            foreach ($carts as $key => $cartItem) {
                                $product = \App\Models\Product::find($cartItem['product_id']);
                            
                                $product_ids = [];
                                if (isset($seller_products[$product->user_id])) {
                                    $product_ids = $seller_products[$product->user_id];
                                }
                                array_push($product_ids, $cartItem['product_id']);
                                $seller_products[$product->user_id] = $product_ids;
                            }
                        @endphp
                        @if (!empty($seller_products))
                            @foreach ($seller_products as $key => $seller_product)
                                <div class="card mb-3 shadow-sm border-0 rounded">
                                    <div class="card-header p-3">
                                        <h5 class="fs-16 fw-600 mb-0">
                                            {{ \App\Models\User::where('id', $key)->first()->name }} Products</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($seller_product as $cartItem)
                                                @php
                                                    $product = \App\Models\Product::find($cartItem);
                                                @endphp
                                                <li class="list-group-item">
                                                    <div class="d-flex">
                                                        <span class="mr-2">
                                                            <img src="{{ $product->getFirstOrDefaultMediaUrl('image', 'square-sm-thumb') }}"
                                                                class="img-fit size-60px rounded"
                                                                alt="{{ $product->name }}">
                                                        </span>

                                                        <h5 class="heading-2 mb-10">{{ $product->name }}</h5>

                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="pt-4 d-flex justify-content-between align-items-center">
                            <button class="btn btn-danger"><i class="fi-rs-arrow-right mr-10"></i>Continue to
                                Payment</button>

                        </div>


                    </form>
                @else
                    <div class="row">
                        <div class="col-12">
                            <div class="ps-checkout__form">
                                <h4 class="text-center">No product in your cart.</h4>
                                <a href="{{ route('site.page') }}" class="btn mb-20 w-100">Continue Shopping<i
                                        class="fi-rs-sign-out ml-15"></i></a>

                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </main>
</x-new-site-master-layout>
