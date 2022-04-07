<x-site-master-layout>
    <div class="container">
        <ul class="ps-breadcrumb py-0 border-bottom">
            <li class="ps-breadcrumb__item">
                <a href="{{route('homepage')}}">Home</a>
            </li>
            <li class="ps-breadcrumb__item active" aria-current="page">Wishlist</li>
        </ul>
        <div class="ps-category__content">
            <div class="row row-reverse">
                <div class="col-12 col-md-9">
                    <div class="ps-category--grid">
                        <div class="row m-0">
                            @forelse ($wishlists as $key => $wishlist)
                                @if ($wishlist->product != null)
                                <div class="col-6 col-lg-4 col-xl-3 p-0" id="wishlist_{{ $wishlist->id }}">
                                    <div class="ps-product ps-product--standard">
                                        <div class="ps-product__thumbnail"><a class="ps-product__image" href="{{ route('site.product.show', $wishlist->product->slug) }}">
                                                <figure>
                                                    <img src="{{ $wishlist->product->getFirstOrDefaultMediaUrl('image','thumb') }}" alt="alt"/>
                                                    @if(!is_null($wishlist->product->hasStock))
                                                        @foreach($wishlist->product->hasStock as $stock)
                                                            @if($loop->first)
                                                                <img src="{{ $stock->getFirstMediaUrl('gallery_image','thumb') }}" alt="alt"/>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </figure>
                                            </a>
                                            <div class="ps-product__actions">
                                                @if($wishlist->product->is_sellable)
                                                <div class="ps-product__item" data-placement="left" data-toggle="tooltip" title="Add to cart">
                                                    <a href="javascript:void(0);" id="{{$wishlist->product->id}}" onclick="productview({{$wishlist->product->id}})"><i class="fa fa-shopping-basket"></i></a>
                                                </div>
                                                @endif
                                                <div class="ps-product__item" data-placement="left" data-toggle="tooltip" title="Add to compare">
                                                    <a href="javascript:void(0);" id="{{$wishlist->product->id}}" onclick="addToCompare({{$wishlist->product->id}})"><i class="icon-sync"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ps-product__content">
                                            <h5 class="ps-product__title"><a href="{{ route('site.product.show', $wishlist->product->slug) }}">{{$wishlist->product->name}}</a></h5>
                                            <div class="ps-product__meta">
                                                @if($wishlist->product->discount === 0)
                                                    <span class="ps-product__price sale">Rs. {{ $wishlist->product->price }}</span>
                                                @else
                                                    @if($wishlist->product->discount_type === 'percent')
                                                        <span class="ps-product__price sale">Rs. {{ $wishlist->product->price * ( 1- ($wishlist->product->discount/100)) }}</span>
                                                        <span class="ps-product__del">Rs. {{ $wishlist->product->price }}</span>
                                                    @else
                                                        <span class="ps-product__price sale">Rs. {{ $wishlist->product->price - $wishlist->product->discount }}</span>
                                                        <span class="ps-product__del">Rs. {{ $wishlist->product->price }}</span>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="ps-product__rating">
                                                <select class="ps-rating" data-read-only="true">
                                                    <option value="1" {{ round($wishlist->product->averageRating,1) == 1 ? 'selected="selected"' :'' }}>1</option>
                                                    <option value="2" {{ round($wishlist->product->averageRating,1) == 2 ? 'selected="selected"' :'' }}>2</option>
                                                    <option value="3" {{ round($wishlist->product->averageRating,1) == 3 ? 'selected="selected"' :'' }}>3</option>
                                                    <option value="4" {{ round($wishlist->product->averageRating,1) == 4 ? 'selected="selected"' :'' }}>4</option>
                                                    <option value="5" {{ round($wishlist->product->averageRating,1) == 5 ? 'selected="selected"' :'' }}>5</option>
                                                </select><span class="ps-product__review">({{ round($wishlist->product->averageRating,1) }} Reviews)</span>
                                            </div>
                                            <div class="ps-product__meta">
                                                <div class="ps-product__cart">
                                                    <a href="javascript:void(0);" class="ps-btn ps-btn--warning"  id="{{$wishlist->id}}" onclick="removeFromWishlist({{$wishlist->id}})">Delete Wishlist</a>
                                                </div>
                                            </div>
                                            <div class="ps-product__desc">
                                                <ul class="ps-product__list">
                                                    <li>{{($wishlist->product->is_refundable==1) ? 'Refundable' : 'Non-Refundable'}}</li>
                                                </ul>
                                            </div>
                                            <div class="ps-product__actions ps-product__group-mobile">
                                                <div class="ps-product__quantity">
                                                    <div class="def-number-input number-input safari_only">
                                                        <button class="minus" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i class="icon-minus"></i></button>
                                                        <input class="quantity" min="0" name="quantity" value="1" type="number"/>
                                                        <button class="plus" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i class="icon-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="ps-product__item" data-placement="left" data-toggle="tooltip" title="Remove from wishlist">
                                                    <a href="javascript:void(0);" id="{{$wishlist->id}}" onclick="removeFromWishlist({{$wishlist->id}})"><i class="fa fa-trash"></i></a>
                                                </div>
                                                @if($wishlist->product->is_sellable)
                                                <div class="ps-product__item cart" data-toggle="tooltip" data-placement="left" title="Add to cart">
                                                    <a href="javascript:void(0);" id="{{$wishlist->product->id}}" onclick="productview({{$wishlist->product->id}})"><i class="fa fa-shopping-basket"></i></a>
                                                </div>
                                                @endif
                                                <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare">
                                                    <a href="javascript:void(0);" id="{{$wishlist->product->id}}" onclick="addToCompare({{$wishlist->product->id}})"><i class="icon-sync"></i></a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @empty
                                <div class="col">
                                    <div class="text-center bg-white p-4 rounded shadow">
                                        <h5 class="mb-0 h5 mt-3">There isn't anything added yet</h5>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        {{ $wishlists->links('site._components.custom-pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            function removeFromWishlist(id){
                $.ajax({
                    type:"POST",
                    url: '{{ route('wishlist.remove') }}',
                    data:{
                        id : id
                    },
                    success: function(data){
                        $('#wishlist').html(data);
                        $('#wishlist_'+id).hide();
                        alertify.success('Item has been removed from wishlist.');
                    },
                    error:function(data){
                        console.log(data);
                        alertify.warning('Oops! Some problem occured. Please try again later.');
                    }
                });

            }
        </script>
    @endpush
</x-site-master-layout>
