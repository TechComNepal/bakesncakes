<x-vendor-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="3" />


    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm order-2 order-sm-1">
                            <div class="d-flex align-items-start mt-3 mt-sm-0">
                                <div class="flex-shrink-0">
                                    <div class="avatar-xl me-3">
                                        <img src="{{ $user->getFirstOrDefaultMediaUrl('avatars', 'profile') }}"
                                            alt="No image uploaded" class="img-fluid rounded-circle d-block">
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-16 mb-1">{{ $user->name }}</h5>


                                        <div
                                            class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                            <div><i
                                                    class="mdi mdi-circle-medium me-1 text-success align-middle"></i>{{ $user->roles->pluck('name')->first() }}
                                            </div>
                                            <div><i
                                                    class="mdi mdi-circle-medium me-1 text-success align-middle"></i>{{ $user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link px-3 @if (!$errors->has('current_password') && !$errors->has('password') && !$errors->has('confirm_password'))active @endif" data-bs-toggle="tab" href="#overview"
                                role="tab">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 @if ($errors->has('current_password') || $errors->has('password') || $errors->has('confirm_password'))active @endif " data-bs-toggle="tab" href="#security"
                                role="tab">Security</a>
                        </li>

                    </ul>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="tab-content">
                <div class="tab-pane  @if (!$errors->has('current_password') && !$errors->has('password') && !$errors->has('confirm_password'))active @endif" id="overview" role="tabpanel">
                    <div class="card">

                        <div class="card-body">


                            <div>

                                <x-form-base :route="'vendor.profiles.update'" :requiredParam="$user" :title="$pageTitle"
                                    :subTitle="$subTitle" :method="'PUT'">

                                    <x-input-field :label="'Name'" :name="'name'"
                                        :placeholder="'Please enter user name here.'" :col="12" :required="true"
                                        :autofocus="true" :value="$user->name" />

                                    <x-input-field :label="'UserName'" :name="'username'"
                                        :placeholder="'Please enter username here.'" :col="12" :required="true"
                                        :autofocus="true" :value="$user->username" />

                                    <x-input-field :label="'Email'" :name="'email'"
                                        :placeholder="'Please enter email here.'" :col="12" :required="true"
                                        :autofocus="true" :value="$user->email" />

                                    <x-input-field :label="'Phone'" :name="'phone'"
                                        :placeholder="'Please enter phone no.'" :col="12" :required="true"
                                        :autofocus="true" :value="$user->phone" />

                                    <x-input-field :label="'City'" :name="'city'"
                                        :placeholder="'Please enter city here.'" :col="12" :required="true"
                                        :autofocus="true" :value="$user->city" />

                                    <x-input-field :label="'Address'" :name="'address'"
                                        :placeholder="'Please address here.'" :col="12" :required="true"
                                        :autofocus="true" :value="$user->address" />

                                    <x-file-browser-image :label="'Avatar'" :name="'avatar'"
                                        :defaultFile="$user->getFirstOrDefaultMediaUrl('avatars', 'profile')" />


                                    <x-button />

                                </x-form-base>
                                <x-file-manager />


                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->



                </div>
                <!-- end tab pane -->

                <div class="tab-pane @if ($errors->has('current_password') || $errors->has('password') || $errors->has('confirm_password'))active @endif" id="security" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Change Password</h5>
                        </div>

                        <div class="card-body">
                            <x-error />
                            <div>

                                <x-form-base :route="'vendor.profiles.change.password'" :id="'changePasswordAdminForm'"
                                    :title="$pageTitle" :subTitle="$subTitle">

                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>

                                    @enderror

                                    <x-input-field :label="'Old Password'" :type="'password'" :name="'current_password'"
                                        :placeholder="'Enter Current Password'" :col="12" :autofocus="true" />
                                    <span class="text-danger error-text current_password_error"></span>

                                    <x-input-field :label="'New Password'" :type="'password'" :name="'password'"
                                        :placeholder="'Enter New Password'" :col="12" :autofocus="true" />
                                    <span class="text-danger error-text password_error"></span>

                                    <x-input-field :label="'Confirm Password'" :type="'password'"
                                        :name="'confirm_password'" :placeholder="'Enter Same Password'" :col="12"
                                        :autofocus="true" />
                                    <span class="text-danger error-text confirm_password_error"></span>

                                    <x-button />

                                </x-form-base>



                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end tab pane -->



            </div>
            <!-- end col -->


        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

</x-vendor-master-layout>
