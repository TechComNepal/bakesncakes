<x-new-site-master-layout>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('site.page') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Shop <span></span> Compare
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                @if (Session::has('compare'))
                    @if (count(Session::get('compare')) > 0)
                        <div class="col-xl-10 col-lg-12 m-auto">
                            <h1 class="heading-2 mb-10">Products Compare</h1>
                            <h6 class="text-body mb-40">There are <span
                                    class="text-brand">{{ count(\Illuminate\Support\Facades\Session::get('compare')) }}</span>
                                products to
                                compare</h6>
                            <div class="table-responsive">
                                <table class="table text-center table-compare">
                                    <tbody>
                                        <tr class="pr_image">
                                            <td class="text-muted font-sm fw-600 font-heading mw-200">Preview</td>
                                            @foreach (Session::get('compare') as $key => $item)
                                                <td class="row_img">
                                                    <img src="{{ \App\Models\Product::find($item)->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}"
                                                        alt="Product Image">
                                                </td>
                                            @endforeach

                                        </tr>
                                        <tr class="pr_title">
                                            <td class="text-muted font-sm fw-600 font-heading">Name</td>
                                            @foreach (Session::get('compare') as $key => $item)
                                                <td class="product_name">
                                                    <h6><a class="text-heading"
                                                            href="{{ route('site.page.singleProductShow', \App\Models\Product::find($item)->slug) }}">{{ \App\Models\Product::find($item)->name }}</a>
                                                    </h6>
                                                </td>
                                            @endforeach

                                        </tr>
                                        <tr class="pr_price">
                                            <td class="text-muted font-sm fw-600 font-heading">Price</td>
                                            @foreach (Session::get('compare') as $key => $item)
                                                @php
                                                    $product = \App\Models\Product::find($item);
                                                @endphp

                                                @if ($product->discount === 0)
                                                    <td class="product_price">
                                                        <h4 class="price text-brand">Rs. {{ $product->selling_price }}
                                                        </h4>
                                                    </td>
                                                @else
                                                    @if ($product->discount_type === 'percent')
                                                        <td class="product_price">
                                                            <h4 class="price text-brand">Rs.
                                                                {{ $product->selling_price * (1 - $product->discount / 100) }}
                                                            </h4>
                                                        </td>
                                                    @else
                                                        <td class="product_price">
                                                            <h4 class="price text-brand">Rs.
                                                                {{ $product->selling_price - $product->discount }}
                                                            </h4>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach


                                        </tr>
                                        <tr class="pr_rating">
                                            <td class="text-muted font-sm fw-600 font-heading">Rating</td>
                                            @foreach (Session::get('compare') as $key => $item)
                                                @php
                                                    $product = \App\Models\Product::find($item);
                                                @endphp
                                                <td>
                                                    <div class="rating_wrap">
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
                                                            <span class="font-small ml-5 text-muted">
                                                                ({{ round($product->averageRating, 1) }})
                                                            </span>

                                                            <br>
                                                        </div>

                                                    </div>
                                                </td>
                                            @endforeach


                                        </tr>
                                        <tr class="description">
                                            <td class="text-muted font-sm fw-600 font-heading">Description</td>
                                            @foreach (Session::get('compare') as $key => $item)
                                                @php
                                                    $product = \App\Models\Product::find($item);
                                                @endphp
                                                <td class="row_text font-xs">
                                                    <p class="font-sm text-muted">{{ $product->description }}</p>
                                                </td>
                                            @endforeach

                                        </tr>
                                        <tr class="pr_stock">
                                            <td class="text-muted font-sm fw-600 font-heading">Stock status</td>
                                            @foreach (Session::get('compare') as $key => $item)
                                                @php
                                                    $product = \App\Models\Product::find($item);
                                                @endphp
                                                @if ($product->quantity > 0)
                                                    <td class="row_stock"><span
                                                            class="stock-status in-stock mb-0">In
                                                            Stock</span>
                                                    </td>
                                                @endif
                                                @if ($product->quantity = 0 || !$product->is_sellable)
                                                    <td class="row_stock"><span
                                                            class="stock-status out-stock mb-0">Out of
                                                            stock</span>
                                                    </td>
                                                @endif
                                            @endforeach
                                        </tr>

                                        <tr class="pr_add_to_cart">
                                            <td class="text-muted font-sm fw-600 font-heading">Buy now</td>
                                            @foreach (Session::get('compare') as $key => $item)
                                                @php
                                                    $product = \App\Models\Product::find($item);
                                                @endphp
                                                @if ($product->quantity > 0 && $product->is_sellable)
                                                    <td class="row_btn">
                                                        <button class="btn btn-sm" id="{{ $product->id }}"
                                                            onclick="productview({{ $product->id }})"><i
                                                                class="fi-rs-shopping-bag mr-5"></i>Add to
                                                            cart</button>
                                                    </td>
                                                @endif
                                                @if ($product->quantity = 0 || !$product->is_sellable)
                                                    <td class="row_btn">
                                                        <a href="{{ route('site.page.contact') }}"
                                                            class="btn btn-sm btn-secondary"><i
                                                                class="fi-rs-headset mr-5"></i>Contact
                                                            Us</a>
                                                    </td>
                                                @endif
                                            @endforeach

                                        </tr>
                                        <tr class="pr_remove text-muted">
                                            <td class="text-muted font-md fw-600"></td>
                                            @foreach (Session::get('compare') as $key => $item)
                                                @php
                                                    $product = \App\Models\Product::find($item);
                                                @endphp
                                                <td class="row_remove">

                                                    <a href="{{ route('compare.reset', $product->id) }}"
                                                        class="text-muted"><i
                                                            class="fi-rs-trash mr-5"></i><span>Remove</span> </a>
                                                </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    @endif
                @else
                    <div class="text-center p-4">
                        <p class="fs-17">Your comparison list is empty</p>
                    </div>
                @endif
            </div>
        </div>
    </main>

</x-new-site-master-layout>
