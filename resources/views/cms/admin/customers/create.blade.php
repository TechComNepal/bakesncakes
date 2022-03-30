<x-cms-master-layout>

    <x-breadcrumb :title="$pageTitle" :item="3" :method="'Create'" />

    <x-error />


    <x-form-base :route="'admin.users.store'" :title="$pageTitle" :subTitle="$subTitle">

        <!-- Full Name -->
        <x-input-field :label="'Name'" :name="'name'" :placeholder="'Please enter full name here.'" :col="6"
            :required="true" :autofocus="true" />

        <!-- User Name -->
        <x-input-field :label="'UserName'" :name="'username'" :placeholder="'Please enter username here.'" :col="6"
            :required="true" :autofocus="true" />

        <!-- Email Address -->
        <x-input-field :label="'Email Address'" :name="'email'" :placeholder="'Please enter email address here.'"
            :col="6" :required="true" />

        <!-- Password  -->
        <x-input-field :type="'password'" :label="'Password'" :name="'password'"
            :placeholder="'Please enter password here.'" :col="6" :required="true" />

        <!-- Confirm Password  -->
        <x-input-field :type="'password'" :label="'Confirm Password'" :name="'password_confirmation'"
            :placeholder="'Please enter password here.'" :col="6" :required="true" />

        <!-- Roles -->
        <x-select-field-name :label="'Roles'" :name="'role_id'" :placeholder="'Select a User Role'" :col="6"
            :values="$roles" :required="true" />

        <!-- Phone Number  -->
        <x-input-field :label="'Phone Number'" :name="'phone'" :placeholder="'Please enter phone number here.'" :col="6"
            :required="true" />

        <!-- City -->
        <x-input-field :label="'City'" :name="'city'" :placeholder="'Please enter city here.'" :col="6"
            :required="true" />

        <!-- Address -->
        <x-text-area-field :label="'Address'" :name="'address'" :placeholder="'User Address Here.'" />

        <!-- Editor Image -->
        <x-file-browser-image :label="'Editor Avatar Image'" :name="'image'" />

        <x-button />

    </x-form-base>

    <x-file-manager />


</x-cms-master-layout>
