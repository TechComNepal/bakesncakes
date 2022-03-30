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

    <x-form-base :route="'admin.services.update'" :requiredParam="$service->slug" :title="$pageTitle" :subTitle="$subTitle"
        :method="'PUT'">

        <!-- Service title -->
        <x-input-field :label="'Service Title'" :name="'title'" :placeholder="'Service Title Here...'" :required="true"
            :autofocus="true" :value="$service->title"  />

        
        <!-- Description -->
        <x-text-area-field :label="'Description'" :name="'description'" :required="true" :value="$service->description" />

        <!-- selected image -->
        <x-file-browser-image :label="'Service Image'" :name="'image'"
            :defaultFile="$service->getFirstOrDefaultMediaUrl('image', 'thumb')" />

        <x-button />

    </x-form-base>


    @push('scripts')
    <!-- bootstrap tags input-->
    <script src="{{ asset('cms/assets/js/bootstrap-tagsinput-1.min.js') }}"> </script>
    @endpush
    <x-file-manager />


</x-cms-master-layout>