<x-cms-master-layout :pageTitle="$pageTitle">
    @push('styles')
    <style>
        .bootstrap-tagsinput {
            width: 100%;
        }
    </style>
    @endpush

    <x-breadcrumb :title="$pageTitle" :item="2" />
    <x-error />

    <x-form-base :route="'admin.blogs.update'" :requiredParam="$blog->slug" :title="$pageTitle" :subTitle="$subTitle"
        :method="'PUT'">

         <!-- selected image -->
         <x-file-browser-image :label="'Banner Image'" :name="'image'"
         :defaultFile="$blog->getFirstOrDefaultMediaUrl('image', 'thumb')" />
         <hr><br><br>
         

        <!-- blog title -->
        <x-input-field :label="'Blog Title'" :name="'title'" :placeholder="'Blog Title Here...'" :required="true"
            :autofocus="true" :value="$blog->title" :col="'6'" />

        <!-- Tags -->
        <x-input-field :label="'Tags'" :name="'tags'" :id="'tags'" :placeholder="'Tags'" :autofocus="TRUE"
            :dataRole="'tagsinput'" :col="'6'" :value="$blog->tags" />

        <!-- Description -->
        <x-text-area-field :label="'Description'" :name="'description'" :required="true" :value="$blog->description" />

        

        <x-button />

    </x-form-base>


    @push('scripts')
    <!-- bootstrap tags input-->
    <script src="{{ asset('cms/assets/js/bootstrap-tagsinput-1.min.js') }}"> </script>
    @endpush
    <x-file-manager />


</x-cms-master-layout>