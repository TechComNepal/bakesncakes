<x-cms-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="3" :method="'Create'" />

    <x-error />

    <x-form-base :route="'admin.sliders.store'" :title="$pageTitle" :subTitle="$subTitle">

        <!-- Brands -->
        <x-select-field-name :label="'Brands'" :name="'brand_id'" :placeholder="'Select a Brand'" :col="12"
            :values="$brands" />
        <!-- Status -->
        <x-switch :label="'Status'" :name="'status'" :checked="true" :col="2" />

        <!-- Popups -->
        <x-switch :label="'Is Popup'" :name="'is_popup'" :checked="true" :col="2" />

        <!-- Slider Image -->
        <x-file-browser-image :label="'Slider Image'" :name="'image'" />


        <x-button />

    </x-form-base>

    <x-file-manager />

</x-cms-master-layout>
