<div class="modal-body p-4 added-to-cart">
    <div class="text-center text-success mb-4">
        <i class="fa fa-check-circle-o" aria-hidden="true"></i>
        <h3>Item added to your cart!</h3>
    </div>
    <div class="media mb-4">
        <img src="{{ $product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}"
            data-src="{{ $product->getFirstOrDefaultMediaUrl('image', 'square-md-thumb') }}" height="200" width="200"
            class="mr-3" alt="Product Image">
        <div class="media-body pt-3 text-left">
            <h4>
                {{ $product->name }}
            </h4>
            <div class="row mt-3">
                <div class="col-sm-2">
                    <div>Price:</div>
                </div>
                <div class="col-sm-10">
                    <div class="text-danger">
                        <strong>
                            Rs. {{ ($data['price'] + $data['tax']) * $data['quantity'] }}
                        </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button class="btn ps-btn--address" data-bs-dismiss="modal">Back to shopping</button>
        <a href="{{ route('checkout') }}" class="btn ps-btn--address pt-3">Proceed to Checkout</a>
    </div>
</div>
