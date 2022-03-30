<x-cms-employee-master-layout :pageTitle="$pageTitle">
    @push('styles')
    <style>
        .bootstrap-tagsinput {
            width: 100%;
        }
    </style>

    @endpush

    <x-breadcrumb :title="$pageTitle" :item="2" :method="'Create'" />
    <x-error />
    <x-form-base :route="'employee.blogs.store'" :title="$pageTitle" :subTitle="$subTitle">

         <!-- Banner image -->
         <x-file-browser-image :label="'Banner Image'" :name="'image'"  />
         <br>

        <!-- blog title -->
        <x-input-field :label="'Blog Title'" :name="'title'" :placeholder="'Blog Title Here...'" :required="true"
            :col="'6'" :autofocus="true" />

        <!-- Tags -->
        <x-input-field :label="'Tags'" :name="'tags'" :id="'tags'" :placeholder="'Tags'" :autofocus="TRUE"
            :dataRole="'tagsinput'" :col="'6'" />

        <!-- Description -->
        <x-text-area-field :label="'Blog Description'" :name="'description'" :required="true" />

       

        <!-- user ID -->
        {{-- <x-input-field :label="'user ID'" :name="'user_id'" :placeholder="'Please enter full name here.'" :required="true" :autofocus="true" /> --}}
        <x-button />

    </x-form-base>
    <x-file-manager />

</x-cms-employee-master-layout>
