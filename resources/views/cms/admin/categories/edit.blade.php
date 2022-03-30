<x-cms-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="3" :method="'Edit'" />

    <x-error />

    <x-form-base :route="'admin.categories.update'" :requiredParam="$category" :title="$pageTitle" :subTitle="$subTitle"
        :method="'PUT'">

        <!-- Name -->
        <x-input-field :label="'Name'" :name="'name'" :placeholder="'Please enter category name here.'" :col="12"
            :required="true" :autofocus="true" :value="$category->name" />

        <!-- Level -->
        <x-input-field :label="'Order Level'" :name="'order_level'" :placeholder="''" :col="6" :required="true"
            :value="$category->order_level" />

        <!-- Parent Category -->
        <x-select-field-name :label="'Parent Category'" :name="'parent_id'" :placeholder="'Select Parent Category.'"
            :col="6" :values="$categories" :selected="$category->parent_id" />


        <!-- Category Image -->
        <x-file-browser-image :label="'Category Image'" :name="'image'"
            :defaultFile="$category->getFirstOrDefaultMediaUrl('image', 'thumb')" />


        <x-button />

    </x-form-base>
    <x-file-manager />

</x-cms-master-layout>
