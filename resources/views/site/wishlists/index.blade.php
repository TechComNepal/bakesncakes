 <x-new-site-master-layout>
     <main class="main">
         <div class="page-header breadcrumb-wrap">
             <div class="container">
                 <div class="breadcrumb">
                     <a href="{{ route('site.page') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                     <span></span> Wishlist
                 </div>
             </div>
         </div>
         <div class="container mb-30 mt-50">
             <div class="row">
                 <div class="col-xl-10 col-lg-12 m-auto">
                     <div class="mb-50">
                         <h1 class="heading-2 mb-10">Your Wishlist</h1>
                         <h6 class="text-body">There are <span
                                 class="text-brand">{{ auth()->user()->wishlists->count() }}</span> products in
                             this
                             list</h6>
                     </div>
                     <div class="table-responsive shopping-summery">
                         <table class="table table-wishlist">
                             <thead>
                                 <tr class="main-heading">

                                     <th scope="col" colspan="2">Product</th>
                                     <th scope="col">Price</th>
                                     <th scope="col">Stock Status</th>
                                     <th scope="col">Action</th>
                                     <th scope="col" class="end">Remove</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @forelse ($wishlists as $key => $wishlist)
                                     @if ($wishlist->product != null)
                                         <tr class="pt-30" id="wishlist_{{ $wishlist->id }}">

                                             <td class="image product-thumbnail pt-40"> <img
                                                     src="{{ $wishlist->product->getFirstOrDefaultMediaUrl('image', 'thumb') }}"
                                                     alt="#" /></td>
                                             <td class="product-des product-name">
                                                 <h6><a class="product-name mb-10"
                                                         href="shop-product-right.html">{{ $wishlist->product->name }}
                                                     </a></h6>
                                                 <div class="product-rate-cover">
                                                     <div class="rating">
                                                         @php
                                                             $num_rating = number_format($wishlist->product->averageRating);
                                                         @endphp
                                                         @for ($i = 0; $i < $num_rating; $i++)
                                                             <i class="fa fa-star checked"> </i>
                                                         @endfor
                                                         @for ($j = $num_rating; $j < 5; $j++)
                                                             <i class="fa fa-star"> </i>
                                                         @endfor
                                                         <span class="font-small ml-5 text-muted">
                                                             ({{ round($wishlist->product->averageRating, 1) }}
                                                             )</span>

                                                         <br>
                                                     </div>

                                                 </div>
                                             </td>
                                             <td class="price" data-title="Price">
                                                 @if ($wishlist->product->discount === 0)
                                                     <h3 class="text-brand">Rs.
                                                         {{ $wishlist->product->selling_price }}
                                                     </h3>
                                                 @else
                                                     @if ($wishlist->product->discount_type === 'percent')
                                                         <h3 class="text-brand">Rs.
                                                             {{ $wishlist->product->selling_price * (1 - $wishlist->product->discount / 100) }}
                                                         </h3>
                                                     @else
                                                         <h3 class="text-brand">Rs.
                                                             {{ $wishlist->product->selling_price - $wishlist->product->discount }}
                                                         </h3>
                                                     @endif
                                                 @endif

                                             </td>
                                             <td class="text-center detail-info" data-title="Stock">
                                                 @if ($wishlist->product->quantity > 0)
                                                     <span class="stock-status in-stock mb-0"> In Stock </span>
                                                 @else
                                                     <span class="stock-status out-stock mb-0"> Out Stock </span>
                                                 @endif
                                             </td>
                                             <td class="text-right" data-title="Cart">
                                                 @if ($wishlist->product->quantity > 0)
                                                     <button class="btn btn-sm" id="{{ $wishlist->product->id }}"
                                                         onclick="productview({{ $wishlist->product->id }})">Add to
                                                         cart</button>
                                                 @else
                                                     <button class="btn btn-sm btn-secondary">Contact Us</button>
                                                 @endif
                                             </td>
                                             <td class="action text-center" data-title="Remove from wishlist">
                                                 <a href="javascript:void(0);" id="{{ $wishlist->id }}"
                                                     class="text-body"
                                                     onclick="removeFromWishlist({{ $wishlist->id }})"><i
                                                         class="fi-rs-trash"></i></a>
                                             </td>

                                         </tr>
                                     @endif
                                 @empty
                                     <div class="col">
                                         <div class="text-center bg-white p-4 rounded shadow">
                                             <h5 class="mb-0 h5 mt-3">There is no product in your wishlist</h5>
                                         </div>
                                     </div>
                                 @endforelse

                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </main>
     @push('scripts')
         <script type="text/javascript">
             function removeFromWishlist(id) {
                 $.ajax({
                     type: "POST",
                     url: '{{ route('wishlist.remove') }}',
                     data: {
                         id: id
                     },
                     success: function(data) {
                         $('.wishlist').html(data);
                         $('#wishlist_' + id).hide();
                         alertify.success('Item has been removed from wishlist.');
                     },
                     error: function(data) {
                         console.log(data);
                         alertify.warning('Oops! Some problem occured. Please try again later.');
                     }
                 });

             }
         </script>
     @endpush

 </x-new-site-master-layout>
