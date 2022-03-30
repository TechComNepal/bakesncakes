<x-cms-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="3" :method="'Edit'" />

    <x-error />

    <x-form-base :route="'admin.sliders.update'" :requiredParam="$slider" :title="$pageTitle" :subTitle="$subTitle"
        :method="'PUT'">

        <!-- Brands -->
        <x-select-field-name :label="'Brands'" :name="'brand_id'" :placeholder="'Select a Brand'" :col="12"
            :values="$brands" :selected="$slider->brand_id" />

        <!-- Category Image -->
        <x-file-browser-image :label="'Slider Image'" :name="'image'"
            :defaultFile="$slider->getFirstOrDefaultMediaUrl('desktop', 'thumb')" />

        <x-button />

    </x-form-base>

    <x-file-manager />

</x-cms-master-layout>
