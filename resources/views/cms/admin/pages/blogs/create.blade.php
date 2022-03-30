<x-cms-master-layout :pageTitle="$pageTitle">
    @push('styles')
    <style>
        .bootstrap-tagsinput {
            width: 100%;
        }
    </style>

    @endpush

    <x-breadcrumb :title="$pageTitle" :item="2" :method="'Create'" />
    <x-error />
    <x-form-base :route="'admin.blogs.store'" :title="$pageTitle" :subTitle="$subTitle">

        <!-- Banner image -->
        <x-file-browser-image :label="'Banner Image'" :name="'image'" />
        
        <hr>
        <hr>
        <!-- blog title -->
        <x-input-field :label="'Blog Title'" :name="'title'" :placeholder="'Blog Title Here...'" :required="true"
            :col="'6'" :autofocus="true" />

        <!-- Tags -->
        <x-input-field :label="'Tags'" :name="'tags'" :id="'tags'" :placeholder="'Tags'" :autofocus="TRUE"
            :dataRole="'tagsinput'" :col="'6'" />

        <!-- Description -->
        <x-text-area-field :label="'Blog Description'" :name="'description'" :required="true" />


        <x-button />

    </x-form-base>
    <x-file-manager />

</x-cms-master-layout>