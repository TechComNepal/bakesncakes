<x-cms-master-layout>
    @push('styles')

        <style>
            .mr-10{
                margin-right: 10px;
            }
        </style>
    <script src="{{ asset('cms/libs/js/bootstrap.min.js') }}"></script>

    @endpush

    <x-breadcrumb :title="$pageTitle" :item="3" :method="'Edit Details Of'" />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-wrap align-items-center">
                        <h4 class="card-title">{{ $user->name }} Details</h4>

                        <div class="ms-auto">
                            <div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <!-- Customer Info -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <i class='bx bx-info-circle fw-bold mr-10'></i> Customer Info
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                                 data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body text-muted">
                                    <x-form-base :route="'admin.users.update'" :requiredParam="$user" :title="$pageTitle" :subTitle="$subTitle"
                                                 :method="'PUT'">

                                        <!-- Full Name -->
                                        <x-input-field :label="'Name'" :name="'name'" :placeholder="'Please enter full name here.'" :col="6"
                                                       :required="true" :autofocus="true" :value="$user->name" />

                                        <!-- Email Address -->
                                        <x-input-field :label="'Email Address'" :name="'email'" :placeholder="'Please enter email address here.'"
                                                       :col="6" :required="true" :value="$user->email" />

                                        <!-- Roles -->
                                        <x-select-field-name :label="'Roles'" :name="'role_id'" :placeholder="'Select a User Role'" :col="6"
                                                             :values="$roles" :required="true" :selected="$user->roles->pluck('id')->first()" />

                                        <!-- Phone Number  -->
                                        <x-input-field :label="'Phone Number'" :name="'phone'" :placeholder="'Please enter phone number here.'" :col="6"
                                                       :required="true" :value="$user->phone" />

                                        <!-- City -->
                                        <x-input-field :label="'City'" :name="'city'" :placeholder="'Please enter city here.'" :col="6" :required="true"
                                                       :value="$user->city" />

                                        <!-- Address -->
                                        <x-text-area-field :label="'Address'" :name="'address'" :placeholder="'Vendor Address Here.'"
                                                           :value="$user->address" />

                                        <!-- Editor Image -->
                                        <x-file-browser-image :label="'Editor Avatar Image'" :name="'image'"
                                                              :defaultFile="$user->getFirstOrDefaultMediaUrl('image', 'thumb')" />

                                        <x-button />

                                    </x-form-base>
                                </div>
                            </div>
                        </div>
                        <!-- Order -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    <i class='bx bxs-cart-add fw-bold mr-10' ></i> Order
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                                 data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body text-muted">
                                    <table id="order-datatable" class="table table-bordered dt-responsive nowrap w-100" width="100%">
                                        <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Order Code</th>
                                            <th>Order Total</th>
                                            <th>Order Status</th>
                                            <th>Payment Method</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Address -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    <i class='bx bxs-contact fw-bold mr-10'></i> Address
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                                 data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body text-muted">
                                    <div id="reset-address">
                                        <div class="row">
                                            @if(!is_null($user->shipping_address))
                                                @foreach ($user->shipping_address as $key => $address)
                                                    <div class="col-md-6 mb-3">
                                                        <div class="border p-3 rounded mb-3 c-pointer bg-white h-100">
                                                            <label class="d-block bg-white mb-0">
                                                                <input type="radio" name="address_id" value="{{ $address->id }}" data-charge="{{$address->shipping->delivery_charge}}" @if ($address->set_default)checked @endif required>
                                                                <span class="d-flex p-3">
                                                <span class="flex-shrink-0 mt-1"></span>
                                                <span class="flex-grow-1 pl-3 text-left">
                                                    <div>
                                                        <span style="opacity: 0.6">Delivery Address:</span>
                                                        <span class="ml-2" style="font-weight: 600">{{ $address->delivery_address }}</span>
                                                    </div>
                                                    <div>
                                                        <span style="opacity: 0.6">Landmark Address:</span>
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

                                                                        <a class="dropdown-item" onclick="edit_address('{{$address->id}}')">
                                                                            Edit
                                                                        </a>
                                                                        @if (!$address->set_default)
                                                                            <a class="dropdown-item" href="{{ route('admin.user.shipping.address.set_default', $address->id) }}">Make This Default</a>
                                                                        @endif
                                                                        <a href="#" id="delete-btn" data-id="{{ $address->id }}" type="button" class="dropdown-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-bs-original-title="Delete">Delete</a>

                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <div class="col-md-6 mx-auto mb-3" >
                                                <div class="border p-3 rounded mb-3 c-pointer text-center bg-white h-100 d-flex flex-column justify-content-center" onclick="add_new_address()">
                                                    <i class="fa fa-plus la-2x mb-3"></i>
                                                    <div class="alpha-7">Add New Address</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Current Shopping Cart and Wishlist -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingFour">
                                <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                    <i class='bx bx-cart-alt fw-bold mr-10' ></i> Current Shopping Cart
                                </button>
                            </h2>
                            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
                                 data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body text-muted">

                                    <table id="cart-wishlist-datatable" class="table table-bordered dt-responsive nowrap w-100" width="100%">
                                        <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Total Price (Vat excl)</th>
                                            <th>Updated On</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Place Order (impersonate) -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingFive">
                                <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                    <i class='bx bx-basket fw-bold mr-10' ></i> Place Order (impersonate)
                                </button>
                            </h2>
                            <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive"
                                 data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body text-muted">
                                    During the order placement process, you will see almost exactly what the customer would see while browsing this site, with the exception of the header menu (you will see the following text 'Impersonated as customer@email.here - finish session'). Navigate to the products the customer wants and add them to the cart exactly as the customer would, then use the 'Checkout' button to proceed through the usual checkout process.
                                    Note: Click 'finish session' link in order to finish this session
                                    <br />
                                    <a href="{{ route('admin.users.impersonate', $user->id) }}" class="btn btn-info">Place Order</a>
                                </div>
                            </div>
                        </div>
                        <!-- Activity Log -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingSix">
                                <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                    <i class='bx bxs-book fw-bold mr-10'></i> Activity Log
                                </button>
                            </h2>
                            <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix"
                                 data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body text-muted">
                                    <table id="activity-datatable" class="table table-bordered dt-responsive nowrap w-100" width="100%">
                                        <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Activity Log Type</th>
                                            <th>Description</th>
                                            <th>Created On</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- end accordion -->

                </div>
            </div>
        </div>
    </div>



    {{--    Modals --}}
    <div class="modal fade bs-example-modal-center" id="new-address-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">New Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.customer.shipping.address') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <x-input-field :type="'email'" :label="'Email Address'" :name="'email'" :required="TRUE" :placeholder="'Email Address Here'" :col="'6'"/>
                            <x-input-field :label="'Name'" :name="'name'" :required="TRUE" :placeholder="'Name Here'" :col="'6'" />
                            <x-input-field :label="'Phone Number'" :name="'phone_no'" :required="TRUE" :placeholder="'Phone Number Here'" :col="'6'" />
                            <x-select-field :label="'Select City'" :name="'city_id'" :required="'TRUE'" :placeholder="'Select City'" :col="'6'">
                                @foreach($shippings as $shipping)
                                    <option @if(old('shipping_id') == $shipping->id) selected @endif value="{{$shipping->id}}" data-charge="{{$shipping->delivery_charge}}" > {{$shipping->shipping_address}} </option>
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

    <div class="modal fade bs-example-modal-center" id="edit-address-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
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

    <x-file-manager />

    @push('scripts')
        <script>
            function add_new_address(){
                $('#new-address-modal').modal('show');
            }

            function edit_address(address) {
                var url = '{{ route("admin.users.shipping.address.edit", ":id") }}';
                url = url.replace(':id', address);

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        $('#edit_modal_body').html(response.html);
                        $('#edit-address-modal').modal('show');
                    }
                })
            }

            $('#delete-btn').on('click', function(event) {
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
                    success: function (data) {
                        if(data.status == 'success') {
                            alertify.success(data.message)
                            location.reload();
                        }else {
                            alertify.error(data.message);
                        }
                    },
                    error: function (data) {
                        console.log(data);
                        console.log('Quick View Error');
                    }
                });
            });

            $('.accordion-item').on('show.bs.collapse', function(e){
                setTimeout(function () {
                    $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
                },5);

            });


            $(function () {

                $('#order-datatable').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "ordering": true,
                    "autoWidth": false,
                    "serverside" : true,
                    "processing" : true,
                    "scrollX" : true,
                    "scrollY" : false,
                    "ajax": "{!! route('admin.users.shipping.address.order.datatable', $user->id) !!}" ,
                    "columns": [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'order_code', name: 'order_code'},
                        {data: 'billing_total', name: 'billing_total'},
                        {data: 'status', name: 'status'},
                        {data: 'payment_method', name: 'payment_method'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action', orderable:false, searchable:false},
                    ]

                });

                $('#activity-datatable').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "ordering": true,
                    "autoWidth": false,
                    "serverside" : true,
                    "processing" : true,
                    "scrollX" : true,
                    "scrollY" : false,
                    "ajax": "{!! route('admin.users.activity.logs', $user->id) !!}" ,
                    "columns": [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'log_name', name: 'log_name'},
                        {data: 'description', name: 'description'},
                        {data: 'created_at', name: 'created_at'},
                    ]
                });
            });

            $('#cart-wishlist-datatable').DataTable({
                "paging": true,
                "lengthChange": false,
                "ordering": true,
                "autoWidth": false,
                "serverSide": true,
                "processing": true,
                "scrollX": true,
                "scrollY": false,
                "ajax": "{!! route('admin.users.cart.datatable', $user->id) !!}" ,
                "columns": [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'product_name', name: 'product_name'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'unit_price', name: 'unit_price'},
                    {data: 'total_price', name: 'total_price'},
                    {data: 'updated_at', name: 'updated_at'},
                ]
            });
        </script>
    @endpush

</x-cms-master-layout>
