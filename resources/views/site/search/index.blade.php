<x-site-master-layout>
    <div class="container-fluid">
        <div class="page-title-area page-title-img-one" style="background-image: url('')">
            <div class="container">
                <div class="page-title-item col-lg-2">
                    <h2>Search</h2>
                    <ul>
                        <li>
                            <a href="{{ route('site.page') }}">Home</a>
                        </li>
                        <li>
                            <i class='bx bx-chevron-right'></i>
                        </li>
                        <li>Search</li>
                    </ul>
                </div>
            </div>
        </div>
    <div class="container">
        
                <div class="pt-50 pb-50">
                    <div class="row row-reverse">
                        <div class="col-12">
                            <div class="ps-category__wrapper">
        
                                <!-- Sort Section -->
                                <div class="ps-category__sort">
                                    <span>{{ $searchResults->count() . ' results found for ' . request('query') }}</span>
                                </div>
        
                            </div>
        
                            <div class="ps-category--grid">
                                <div class="row mb-4">
                                    @foreach($searchResults->groupByType() as $type => $modelSearchResults)
                                    @foreach($modelSearchResults as $searchResult)
                                    @if($type == 'products')
                                    <div class="col-6 col-lg-4 col-xl-3 p-3">
                                        <div class="ps-product ps-product--standard">
                                            <div class="ps-product__thumbnail"><a class="ps-product__image"
                                                href="{{ route('site.page.singleProductShow', $searchResult->searchable->id) }}">
                                                    <figure>
                                                        <img src="{{ $searchResult->searchable->getFirstOrDefaultMediaUrl('image','thumb') }}"
                                                            alt="alt" />
                                                    </figure>
                                                </a>
                                                <div class="ps-product__actions">
                                                    @if($searchResult->searchable->is_sellable)
                                                    <div class="ps-product__item" data-placement="left" data-toggle="tooltip"
                                                        title="Add to cart">
                                                        <a href="javascript:void(0);" id="{{$searchResult->searchable->id}}"
                                                            onclick="productview({{$searchResult->searchable->id}})"><i
                                                                class="fa fa-shopping-basket"></i></a>
                                                    </div>
                                                    @endif
                                                    <div class="ps-product__item" data-placement="left" data-toggle="tooltip"
                                                        title="Add to compare">
                                                        <a href="javascript:void(0);" id="{{$searchResult->searchable->id}}"
                                                            onclick="addToCompare({{$searchResult->searchable->id}})"><i
                                                                class="icon-sync"></i></a>
                                                    </div>
                                                </div>
        
                                            </div>
                                            <div class="ps-product__content ml-3">
                                                <span><small class="product-name">{{ ucfirst($type) }}</small></span><hr>
                                                <div class="d-flex flex-row">
                                                    <h5 class="ps-product__title mt-2"><a href="{{ $searchResult->url }}"> {{
                                                            $searchResult->searchable->name }} </a></h5>
                                                    <div class="add-cart-list add-search-cart btn btn-lg ">
                                                        <a href="javascript:void(0);" class="search-text" id="{{$searchResult->searchable->id}}"
                                                            onclick="productview({{$searchResult->searchable->id}})"> <i
                                                                class="bx bxs-cart add-cart-list"></i>
                                                            Add to Cart
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- <div class="ps-product__meta">
                                                    @if($searchResult->searchable->discount === 0)
                                                    <span class="ps-product__price sale">Rs. {{ $searchResult->searchable->price
                                                        }}</span>
                                                    @else
                                                    @if($searchResult->searchable->discount_type === 'percent')
                                                    <span class="ps-product__price sale">Rs. {{ $searchResult->searchable->price
                                                        * (
                                                        1- ($searchResult->searchable->discount/100)) }}</span>
                                                    <span class="ps-product__del">Rs. {{ $searchResult->searchable->price
                                                        }}</span>
                                                    @else
                                                    <span class="ps-product__price sale">Rs. {{ $searchResult->searchable->price
                                                        -
                                                        $searchResult->searchable->discount }}</span>
                                                    <span class="ps-product__del">Rs. {{ $searchResult->searchable->price
                                                        }}</span>
                                                    @endif
                                                    @endif
        
        
        
                                                </div> -->
                                                <!-- <div class="ps-product__rating">
                                                    <select class="ps-rating" data-read-only="true">
                                                        <option value="1" {{ round($searchResult->searchable->averageRating,1)
                                                            == 1
                                                            ? 'selected="selected"' :'' }}>1</option>
                                                        <option value="2" {{ round($searchResult->searchable->averageRating,1)
                                                            == 2
                                                            ? 'selected="selected"' :'' }}>2</option>
                                                        <option value="3" {{ round($searchResult->searchable->averageRating,1)
                                                            == 3
                                                            ? 'selected="selected"' :'' }}>3</option>
                                                        <option value="4" {{ round($searchResult->searchable->averageRating,1)
                                                            == 4
                                                            ? 'selected="selected"' :'' }}>4</option>
                                                        <option value="5" {{ round($searchResult->searchable->averageRating,1)
                                                            == 5
                                                            ? 'selected="selected"' :'' }}>5</option>
                                                    </select><span class="ps-product__review">({{
                                                        round($searchResult->searchable->averageRating,1) }} Reviews)</span>
                                                </div>
                                                <div class="ps-product__desc">
                                                    <ul class="ps-product__list">
                                                        <li>{{($searchResult->searchable->is_refundable==1) ? 'Refundable' :
                                                            'Non-Refundable'}}</li>
                                                    </ul>
                                                </div> -->
                                                <div class="ps-product__actions ps-product__group-mobile">
                                                    <div class="ps-product__quantity">
                                                        <div class="def-number-input number-input safari_only">
                                                            <button class="minus"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                                                    class="icon-minus"></i></button>
                                                            <input class="quantity" min="0" name="quantity" value="1"
                                                                type="number" />
                                                            <button class="plus"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                                    class="icon-plus"></i></button>
                                                        </div>
                                                    </div>
                                                    @if($searchResult->searchable->is_sellable)
                                                    <div class="ps-product__item cart" data-toggle="tooltip"
                                                        data-placement="left" title="Add to cart">
                                                        <a href="javascript:void(0);" id="{{$searchResult->searchable->id}}"
                                                            onclick="productview({{$searchResult->searchable->id}})"><i
                                                                class="fa fa-shopping-basket"></i></a>
                                                    </div>
                                                    @endif
                                                    <div class="ps-product__item rotate" data-toggle="tooltip"
                                                        data-placement="left" title="Add to compare">
                                                        <a href="javascript:void(0);" id="{{$searchResult->searchable->id}}"
                                                            onclick="addToCompare({{$searchResult->searchable->id}})"><i
                                                                class="icon-sync"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-6 col-lg-4 col-xl-3 p-0 ml-5">
                                        <div class="ps-product ps-product--standard">
                                            <div class="ps-product__thumbnail">
                                                <a class="ps-product__image" href="{{ route('site.category') }}">
                                                    <figure class="pt-3">
                                                        <img src="{{ $searchResult->searchable->getFirstOrDefaultMediaUrl('image','thumb') }}"
                                                            alt="alt" />
                                                    </figure>
                                                </a>
                                                <br>
                                                <span>
                                                    <h5>{{ ucfirst($type) }}</h5>
                                                </span>
                                                <h4 class="ps-product__title"><a href="{{ $searchResult->url }}"> {{
                                                        $searchResult->searchable->name }} </a></h5>
        
                                            </div>
        
                                        </div>
                                    </div>
                                    @endif
        
                                    @endforeach
                                    @endforeach
                                </div>
                            </div>
        
                        </div>
        
                    </div>
                </div>
    </div>
    </div>


</x-site-master-layout>