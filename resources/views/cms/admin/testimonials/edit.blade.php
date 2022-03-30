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

<x-form-base :route="'admin.testimonials.update'" :requiredParam="$testimonial->slug" :title="$pageTitle" :subTitle="$subTitle"
        :method="'PUT'">

        <!-- Testimonial title -->
        <x-input-field :label="'Testimonial Title'" :name="'title'" :placeholder="'Testimonial Title Here...'" :required="true"
            :autofocus="true" :value="$testimonial->title"  />

        
        <!-- Description -->
        <x-text-area-field :label="'Description'" :name="'description'" :required="true" :value="$testimonial->description" />

        <!-- selected image -->
        <x-file-browser-image :label="'Client Image'" :name="'image'"
            :defaultFile="$testimonial->getFirstOrDefaultMediaUrl('image', 'thumb')" />

        <x-button />

    </x-form-base>


    @push('scripts')
    <!-- bootstrap tags input-->
    <script src="{{ asset('cms/assets/js/bootstrap-tagsinput-1.min.js') }}"> </script>
    @endpush
    <x-file-manager />


</x-cms-master-layout>