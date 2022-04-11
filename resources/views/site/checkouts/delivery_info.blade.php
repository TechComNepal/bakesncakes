<x-site-master-layout>
    <div class="row mt-5">
        <div class="ps-checkout">
            <div class="container">
                <ul class="ps-breadcrumb">
                    <li class="ps-breadcrumb__item"><a href="{{ route('site.page') }}">Home</a></li>
                    <li class="ps-breadcrumb__item active" aria-current="page"> Checkout</li>
                </ul>

                @php
                $total = 0;
                @endphp

                @if (!$carts->isEmpty())
                <form class="form-default" action="{{ route('user.store.delivery.info') }}" role="form" method="POST">
                    @csrf
                    @php
                    $seller_products = [];
                    $product_ids = [];

                    foreach ($carts as $key => $cartItem){
                    $product = \App\Models\Product::find($cartItem['product_id']);

                    $product_ids = array();
                    if(isset($seller_products[$product->user_id])){
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
                            <h5 class="fs-16 fw-600 mb-0">{{ \App\Models\User::where('id', $key)->first()->name }} Products</h5>
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
                                            <img src="{{ $product->getFirstOrDefaultMediaUrl('image', 'square-sm-thumb') }}" class="img-fit size-60px rounded" alt="{{  $product->name  }}">
                                        </span>
                                        <h3 class="fs-14 opacity-60">{{ $product->name }}</h3>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <div class="pt-4 d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn fw-600 btn-primary">Continue to Payment</button>
                    </div>


                </form>
                @else
                <div class="row">
                    <div class="col-12">
                        <div class="ps-checkout__form">
                            <h4 class="text-center">No product in your cart.</h4>
                            <h3 class="ps-checkout__heading text-center"><a class="btn btn-warning btn-lg" href="{{ route('site.page') }}">Continue Shopping</a></h3>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-site-master-layout>