<div id="#product-search">
    <div class="container w-75" style="position: absolute; z-index: 11; background: #fff;">
        <input class="input" type="text" wire:model="search" class="form-control" placeholder="Type to search... " />

        @foreach ($featured_products as $product)
        <div class="d-flex flex-row justify-content-start mb-3 ">
            <a class="d-flex flex-row" href="{{route('site.page.singleProductShow', $product->id)}}">
                <td><img src="{{$product->getFirstOrDefaultMediaUrl('image', 'thumb')}}" alt="" height="50px" width="50px"></td>
                <p class="ml-3 pl-3">Name: {{$product->name}}</p>
        </div>
        </a>
        @endforeach


    </div>
</div>
</div>