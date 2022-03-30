<x-site-master-layout :pageTitle="$pageTitle">
    <div class="mb-5">
        <div class="container">
            <div class="row">

                <!--left col-->
                @include('site._layouts._partials.sidebar')

                <!--/col-3-->
                <div class="col-12 col-md-9 mt-5">
                    <ul class="nav nav-pills mb-4" id="tabMenu" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link nav-profile-link @if (!$errors->has('current_password') && !$errors->has('password') && !$errors->has('confirm_password')) active @endif"
                                id="pills-profile-tab" data-bs-toggle="pill" href="#pills-profile" role="tab"
                                aria-controls="pills-profile" aria-selected="true">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-profile-link @if ($errors->has('current_password') || $errors->has('password') || $errors->has('confirm_password')) active @endif"
                                id="pills-security-tab" data-bs-toggle="pill" href="#pills-security" role="tab"
                                aria-controls="pills-security" aria-selected="false">Security</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-profile-link" id="pills-address-tab" data-bs-toggle="pill" href="#pills-address"
                                role="tab" aria-controls="pills-address" aria-selected="false">Address</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade  @if (!$errors->has('current_password') && !$errors->has('password') && !$errors->has('confirm_password')) show active @endif"
                            id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                            <div class="panel">
                                <div class="bio-graph-heading mb-2">
                                    Update Your Profile
                                    <hr>
                                </div>
                                <div class="panel-body bio-graph-info">
                                    <form action="{{ route('user.profiles.update', $user) }}" method="POST"
                                        enctype="multipart/form-data" class="needs-validation">
                                        @csrf   
                                        @method('PUT')

                                        <div class="row">
                                            <div class="bio-row col-12 col-md-6">
                                                <x-input-field :label="'Name'" :name="'name'"
                                                    :placeholder="'Please enter user name here.'" :required="true"
                                                    :autofocus="true" :value="$user->name" />
                                            </div>
                                            <div class="bio-row col-12 col-md-6">
                                                <x-input-field :label="'UserName'" :name="'username'"
                                                    :placeholder="'Please enter user username here.'" :required="true"
                                                    :autofocus="true" :value="$user->username" />
                                            </div>
                                            <div class="bio-row col-12 col-md-6">
                                                <x-input-field :label="'Email'" :name="'email'"
                                                    :placeholder="'Please enter email here.'" :required="true"
                                                    :autofocus="true" :value="$user->email" />
                                            </div>
                                            <div class="bio-row col-12 col-md-6">
                                                <x-input-field :label="'Phone'" :name="'phone'"
                                                    :placeholder="'Please enter phone no.'" :required="true"
                                                    :autofocus="true" :value="$user->phone" />
                                            </div>
                                            <div class="bio-row col-12 col-md-6">
                                                <x-input-field :label="'City'" :name="'city'"
                                                    :placeholder="'Please enter city here.'" :required="true"
                                                    :autofocus="true" :value="$user->city" />
                                            </div>
                                            <div class="bio-row col-12 col-md-6">
                                                <x-input-field :label="'Address'" :name="'address'"
                                                    :placeholder="'Please address here.'" :required="true"
                                                    :autofocus="true" :value="$user->address" />
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-2 offset-0">
                                                <button type="submit" class="ps-btn cmn-btn">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            <x-file-manager />

                        </div>
                        <!--/tab-pane-->
                        <div class="tab-pane fade @if ($errors->has('current_password') || $errors->has('password') || $errors->has('confirm_password')) show active @endif"
                            id="pills-security" role="tabpanel" aria-labelledby="pills-security-tab">


                            <div class="panel">
                                <div class="bio-graph-heading mb-2">
                                    Change Your Password
                                    <hr>
                                </div>
                                <div class="panel-body bio-graph-info">
                                    <form action="{{ route('user.profiles.change.password') }}" method="POST"
                                        enctype="multipart/form-data" class="needs-validation">
                                        @csrf

                                        <div class="row">
                                            <div class="bio-row">
                                                <x-input-field :label="'Old Password'" :type="'password'"
                                                    :name="'current_password'" :placeholder="'Enter Current Password'"
                                                    :autofocus="true" />
                                            </div>
                                            <div class="bio-row">
                                                <x-input-field :label="'New Password'" :type="'password'"
                                                    :name="'password'" :placeholder="'Enter New Password'"
                                                    :autofocus="true" />
                                            </div>
                                            <div class="bio-row">
                                                <x-input-field :label="'Confirm Password'" :type="'password'"
                                                    :name="'confirm_password'" :placeholder="'Enter Same Password'"
                                                    :autofocus="true" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2 offset-0">
                                                <button type="submit"
                                                    class="ps-btn cmn-btn">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                        <!--/tab-pane-->
                        <div class="tab-pane fade " id="pills-address" role="tabpanel"
                            aria-labelledby="pills-address-tab">
                            <div class="panel">
                                <div class="bio-graph-heading">
                                    Manage Address
                                </div>
                                <div class="panel-body bio-graph-info">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="ps-checkout__form">
                                                <hr />
                                                <div id="reset-address">
                                                    <div class="row">
                                                        @if (!is_null(Auth::user()->shipping_address))
                                                        @foreach (Auth::user()->shipping_address as $key => $address)
                                                        <div class="col-md-6 mb-3">
                                                            <div
                                                                class="border p-3 rounded mb-3 c-pointer bg-white h-100">
                                                                <label class="d-block bg-white mb-0">
                                                                    <input type="radio" name="address_id"
                                                                        value="{{ $address->id }}"
                                                                        data-charge="{{ $address->shipping->delivery_charge }}"
                                                                        @if ($address->set_default) checked @endif
                                                                    required>
                                                                    <span class="d-flex p-3">
                                                                        <span class="flex-shrink-0 mt-1"></span>
                                                                        <span class="flex-grow-1 pl-3 text-left">
                                                                            <div>
                                                                                <span style="opacity: 0.6">Delivery
                                                                                    Address:</span>
                                                                                <span class="ml-2"
                                                                                    style="font-weight: 600">{{
                                                                                    $address->delivery_address }}</span>
                                                                            </div>
                                                                            <div>
                                                                                <span style="opacity: 0.6">Landmark
                                                                                    Address:</span>
                                                                                <span class="ml-2"
                                                                                    style="font-weight: 600">{{
                                                                                    $address->landmark }}</span>
                                                                            </div>
                                                                            <div>
                                                                                <span style="opacity: 0.6">City:</span>
                                                                                <span class="ml-2"
                                                                                    style="font-weight: 600">{{
                                                                                    $address->shipping->shipping_address
                                                                                    }}</span>
                                                                            </div>
                                                                            <div>
                                                                                <span style="opacity: 0.6">Name:</span>
                                                                                <span class="ml-2"
                                                                                    style="font-weight: 600">{{
                                                                                    $address->name }}</span>
                                                                            </div>
                                                                            <div>
                                                                                <span style="opacity: 0.6">Phone:</span>
                                                                                <span class="ml-2"
                                                                                    style="font-weight: 600">{{
                                                                                    $address->phone_no }}</span>
                                                                            </div>
                                                                        </span>
                                                                    </span>
                                                                </label>
                                                                <a href="javascript:void(0)" type="button"
                                                                    data-bs-toggle="tooltip" title="Edit"
                                                                    onclick="edit_address('{{ $address->id }}')">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>

                                                                <a href="javascript:void(0)" id="delete-btn"
                                                                    data-id="{{ $address->id }}"
                                                                    data-bs-toggle="tooltip" title="Delete"
                                                                    data-bs-original-title="Delete"> <i
                                                                        class="fa fa-trash"></i></a>

                                                                @if (!$address->set_default)
                                                                <a href="{{ route('user.shipping.address.set_default', $address->id) }}"
                                                                    class="btn btn-sm btn-secondary">Make
                                                                    This Default</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                        <div class="col-md-6 mx-auto mb-3">
                                                            <div class="border p-3 rounded mb-3 c-pointer text-center bg-white h-100 d-flex flex-column justify-content-center"
                                                                onclick="add_new_address()">
                                                                <i class="fa fa-plus la-2x mb-3"></i>
                                                                <div class="alpha-7">Add New Address</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--/tab-pane-->

                    </div>
                    <!--/tab-content-->

                </div>
                <!--/col-9-->
            </div>
            <!--/row-->
        </div>
    </div>

    <div class="modal fade" id="new-address-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
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
                            <x-input-field :type="'email'" :label="'Email Address'" :name="'email'"
                                :id="'address_email'" :required="TRUE" :placeholder="'Email Address Here'" :col="'6'" />
                            <x-input-field :label="'Name'" :name="'name'" :id="'address_name'" :required="TRUE"
                                :placeholder="'Name Here'" :col="'6'" />
                            <x-input-field :label="'Phone Number'" :name="'phone_no'" :required="TRUE"
                                :placeholder="'Phone Number Here'" :col="'6'" />
                            <x-select-field :label="'Select City'" :name="'city_id'" :required="'TRUE'"
                                :placeholder="'Select City'" :col="'6'">
                                @foreach ($shippings as $shipping)
                                <option @if (old('shipping_id')==$shipping->id) selected @endif
                                    value="{{ $shipping->id }}"
                                    data-charge="{{ $shipping->delivery_charge }}">
                                    {{ $shipping->shipping_address }} </option>
                                @endforeach
                            </x-select-field>
                            <x-input-field :label="'Delivery Address'" :name="'delivery_address'" :required="TRUE"
                                :placeholder="'Delivery Address Here'" :col="'6'" />
                            <x-input-field :label="'LandMark Address'" :name="'landmark'" :required="TRUE"
                                :placeholder="'LandMark Address Here'" :col="'6'" />

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="cmn-btn" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="cmn-btn">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-address-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
    <script>
        function add_new_address() {
                $('#new-address-modal').modal('show');
            }

            function edit_address(address) {
                var url = '{{ route('user.shipping.address.edit', ':id') }}';
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