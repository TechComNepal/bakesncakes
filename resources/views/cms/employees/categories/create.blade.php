<x-cms-employee-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="3" :method="'Create'" />

    <x-error />

    <x-form-base :route="'employee.categories.store'" :title="$pageTitle" :subTitle="$subTitle">

        <!-- Name -->
        <x-input-field :label="'Name'" :name="'name'" :placeholder="'Please enter category name here.'" :col="12"
            :required="true" :autofocus="true" />

        <!-- Level -->
        <x-input-field :label="'Order Level'" :name="'order_level'" :placeholder="''" :col="6" />

        <!-- Parent Category -->
        <x-select-field-name :label="'Parent Category'" :name="'parent_id'" :placeholder="'Select Parent Category.'"
            :col="6" :values="$categories" />
        <!-- Category Image -->
        <x-file-browser-image :label="'Category Image'" :name="'image'" />

        <!-- Status -->
        <x-switch :label="'Status'" :name="'status'" :checked="true" :col="4" />

        <!-- Featured -->
        <x-switch :label="'Featured'" :name="'featured'" :id="'switch2'" :checked="false" :col="4" />

        <!-- In Menu -->
        <x-switch :label="'In Menu'" :name="'in_menu'" :id="'switch1'" :checked="false" :col="4" />

        <x-button />

    </x-form-base>

    <x-file-manager />

</x-cms-employee-master-layout>
