<x-cms-master-layout>

    <x-breadcrumb :title="$pageTitle" :item="3" :method="'Edit'" />

    <x-form-base :route="'admin.users.update'" :requiredParam="$user" :title="$pageTitle" :subTitle="$subTitle"
        :method="'PUT'">

        <!-- Full Name -->
        <x-input-field :label="'Name'" :name="'name'" :placeholder="'Please enter full name here.'" :col="6"
            :required="true" :autofocus="true" :value="$user->name" />
        <!-- User Name -->
        <x-input-field :label="'UserName'" :name="'username'" :placeholder="'Please enter username here.'" :col="6"
            :required="true" :autofocus="true" :value="$user->username" />

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
        <x-text-area-field :label="'Address'" :name="'address'" :placeholder="'User Address Here.'"
            :value="$user->address" />

        <!-- Editor Image -->
        <x-file-browser-image :label="'Editor Avatar Image'" :name="'image'"
            :defaultFile="$user->getFirstOrDefaultMediaUrl('image', 'thumb')" />

        <x-button />

    </x-form-base>

    <x-file-manager />

</x-cms-master-layout>
