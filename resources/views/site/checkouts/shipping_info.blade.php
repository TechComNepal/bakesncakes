<x-site-master-layout>
    <div class="row mt-5">
        <div class="ps-checkout">
            <div class="container">
                <ul class="ps-breadcrumb">
                    <li class="ps-breadcrumb__item"><a href="{{ route('site.page') }}">Home</a></li>
                    <li class="ps-breadcrumb__item active" aria-current="page"> Shipping Info</li>
                </ul>

                @php
                $total = 0;
                @endphp

                @if (!$carts->isEmpty())
                <form method="post" id="checkout-form" action="{{ route('user.shipping.info.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="ps-checkout__form">
                                <h3 class="ps-checkout__heading">Shipping Info</h3>
                                <hr />
                                <div id="reset-address">
                                    <div class="row">
                                        @if (!is_null(Auth::user()->shipping_address))
                                        @foreach (Auth::user()->shipping_address as $key => $address)
                                        <div class="col-md-6 mb-3">
                                            <div class="border p-3 rounded mb-3 c-pointer bg-white h-100">
                                                <label class="d-block bg-white mb-0">
                                                    <input type="radio" name="address_id" value="{{ $address->id }}" data-charge="{{ $address->shipping->delivery_charge }}" @if ($address->set_default) checked @endif
                                                    required>
                                                    <span class="d-flex p-3">
                                                        <span class="flex-shrink-0 mt-1"></span>
                                                        <span class="flex-grow-1 pl-3 text-left">
                                                            <div>
                                                                <span style="opacity: 0.6">Delivery
                                                                    Address:</span>
                                                                <span class="ml-2" style="font-weight: 600">{{ $address->delivery_address }}</span>
                                                            </div>
                                                            <div>
                                                                <span style="opacity: 0.6">Landmark
                                                                    Address:</span>
                                                                <span class="ml-2" style="font-weight: 600">{{ $address->landmark }}</span>
                                                            </div>
                                                            <div>
                                                                <span style="opacity: 0.6">City:</span>
                                                                <span class="ml-2" style="font-weight: 600">{{ $address->shipping->shipping_address }}</span>
                                                            </div>
                                                            <div>
                                                                <span style="opacity: 0.6">Name:</span>
                                                                <span class="ml-2" style="font-weight: 600">{{ $address->name }}</span>
                                                            </div>
                                                            <div>
                                                                <span style="opacity: 0.6">Phone:</span>
                                                                <span class="ml-2" style="font-weight: 600">{{ $address->phone_no }}</span>
                                                            </div>
                                                        </span>
                                                    </span>
                                                </label>

                                                <a href="javascript:void(0)" type="button" data-bs-toggle="tooltip" title="Edit" onclick="edit_address('{{ $address->id }}')">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="javascript:void(0)" id="delete-btn" data-id="{{ $address->id }}" data-bs-toggle="tooltip" title="Delete" data-bs-original-title="Delete"> <i class="fa fa-trash"></i></a>

                                            </div>
                                        </div>
                                        @endforeach
                                        @endif

                                        <div class="col-md-6 mx-auto mb-3">
                                            <div class="border p-3 rounded mb-3 c-pointer text-center bg-white h-100 d-flex flex-column justify-content-center" onclick="add_new_address()">
                                                <i class="fa fa-plus la-2x mb-3"></i>
                                                <div class="alpha-7">Add New Address</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ps-shopping__checkout">
                                        <button class="ps-btn ps-btn--address">Continue to Delivery</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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


    <div class="modal fade" id="new-address-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">New Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.shipping.address') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <x-input-field :type="'email'" :label="'Email Address'" :name="'email'" :required="TRUE" :placeholder="'Email Address Here'" :col="'6'" />
                            <x-input-field :label="'Name'" :name="'name'" :required="TRUE" :placeholder="'Name Here'" :col="'6'" />
                            <x-input-field :label="'Phone Number'" :name="'phone_no'" :required="TRUE" :placeholder="'Phone Number Here'" :col="'6'" />
                            <x-select-field :label="'Select City'" :name="'city_id'" :required="'TRUE'" :placeholder="'Select City'" :col="'6'">
                                @foreach ($shippings as $shipping)
                                <option @if (old('shipping_id')==$shipping->id) selected @endif
                                    value="{{ $shipping->id }}"
                                    data-charge="{{ $shipping->delivery_charge }}">
                                    {{ $shipping->shipping_address }}
                                </option>
                                @endforeach
                            </x-select-field>
                            <x-input-field :label="'Delivery Address'" :name="'delivery_address'" :required="TRUE" :placeholder="'Delivery Address Here'" :col="'6'" />
                            <x-input-field :label="'LandMark Address'" :name="'landmark'" :required="TRUE" :placeholder="'LandMark Address Here'" :col="'6'" />

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-address-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <div class="modal-body" id="edit_modal_body">
                    ...
                </div>

            </div>
        </div>
    </div>



    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
    <script>
        function add_new_address() {
            $('#new-address-modal').modal('show');
        }

        function edit_address(address) {
            var url = '{{ route('
            user.shipping.address.edit ',': id ')}}';
            url = url.replace(':id', address);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#edit_modal_body').html(response.html);
                    $('#edit-address-modal').modal('show');
                }
            })
        }

        $('input:radio[name="address_id"]').on('change', function() {
            if ($(this).is(':checked')) {
                let charge = $(this).data('charge') ? $(this).data('charge') : 0;
                let total = {
                    {
                        $total
                    }
                };
                let totalAfterCharge = parseFloat(charge) + parseFloat(total);



                $('#shipping_charge').html(charge);
                $('#total').html(totalAfterCharge);
                $('#total_price').val(totalAfterCharge);
                $('#coupon').val(null);
                $('#coupon_charge').html('- ' + 0);
                $('#coupon-message').removeClass('text-success').html(null);
            }

        });


        $('body').on('click', '#delete-btn', function(event) {
            event.preventDefault();
            event.stopPropagation();
            var id = $(this).data('id');
            var delete_url = "{{ route('user.shipping.address.delete', '') }}/" + id;

            $.ajax({
                type: "DELETE",
                url: delete_url,
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    if (data.status == 'success') {
                        alertify.success(data.message)
                        $('#reset-address').load(location.href + " #reset-address");

                    } else {
                        alertify.error(data.message);
                    }
                },
                error: function(data) {
                    console.log(data);
                    console.log('Quick View Error');
                }
            });
        });
    </script>
    @endpush

</x-site-master-layout>