<form action="{{ route('admin.users.shipping.address.update', $shipping_address->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input name="user_id" value="{{ $shipping_address->user_id }}" type="hidden">
    <div class="row">
        <div class="col-12 col-md-6">
            <label class="ps-checkout__label">Email address <span class="text-danger"><sub>*</sub></span></label>
            <input class="ps-input form-control" type="email" name="email" value="{{ old('email', $shipping_address->email) }}">
        </div>
        <div class="col-12 col-md-6">
            <label class="ps-checkout__label">Name <span class="text-danger"><sub>*</sub></span></label>
            <input class="ps-input form-control" type="text" name="name" value="{{ old('name', $shipping_address->name) }}">
        </div>
        <div class="col-12 col-md-6">
            <label class="ps-checkout__label">Phone Number <span class="text-danger"><sub>*</sub></span></label>
            <input class="ps-input form-control" type="text" name="phone_no" value="{{ old('phone_no', $shipping_address->phone_no) }}">
        </div>
        <div class="col-12 col-md-6">
            <label class="ps-checkout__label">City <span class="text-danger"><sub>*</sub></span></label>
            <select class="ps-input form-control" name="city_id" id="shipping_cost">
                <option value="">Select city</option>
                @foreach($shippings as $shipping)
                    <option @if(old('city_id', $shipping_address->city_id) == $shipping->id) selected @endif value="{{$shipping->id}}" data-charge="{{$shipping->delivery_charge}}" > {{$shipping->shipping_address}} </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-6">
            <label class="ps-checkout__label">Delivery Address <span class="text-danger"><sub>*</sub></span></label>
            <input class="ps-input form-control" type="text" name="delivery_address" value="{{ old('delivery_address', $shipping_address->delivery_address) }}">
        </div>
        <div class="col-12 col-md-6">
            <label class="ps-checkout__label">LandMark Address <span class="text-danger"><sub>*</sub></span></label>
            <input class="ps-input form-control" type="text" name="landmark" value="{{ old('landmark', $shipping_address->landmark) }}">
        </div>
    </div>

    <hr />
    <div class="float-right">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>

</form>
