<x-cms-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="2" :method="'Create'" />

    <x-error />

    <x-form-base :route="'admin.aboutUs.update'" :title="$pageTitle" id="update-btn" :subTitle="$subTitle">

        <!-- selected image -->
        <x-file-browser-image :label="'Banner Image'" :name="'image'"
            :defaultFile="$aboutUs->getFirstOrDefaultMediaUrl('image', 'original')" />

        <!-- terms and conditions -->
        <x-text-area-field :label="'Description'" :name="'description'" :placeholder="'Short Description Here.'"
            :value="$aboutUs->description" />



        <x-button />
    </x-form-base>
    <x-file-manager />

</x-cms-master-layout>