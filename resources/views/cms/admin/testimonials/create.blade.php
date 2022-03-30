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
    <x-form-base :route="'admin.testimonials.store'" :title="$pageTitle" :subTitle="$subTitle">

        <!-- Testimonials title -->
        <x-input-field :label="'Testimoni Title'" :name="'title'" :placeholder="'Testimonial Title Here...'" :required="true"
             :autofocus="true" />

            <!-- Description -->
        <x-text-area-field :label="'Testimonial Description'" :name="'description'" :required="true" />

        <!-- Testimonials image -->
        <x-file-browser-image :label="'Client Image'" :name="'image'"  />

        <x-button />

    </x-form-base>
    <x-file-manager />
    
</x-cms-master-layout>