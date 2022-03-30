<x-cms-master-layout :pageTitle="$pageTitle">

  <x-breadcrumb :title="$pageTitle" :item="2" :method="'Edit'" />

  <x-error />

  <x-form-base :route="'admin.privacyAndPolicy.update'" :title="$pageTitle" :subTitle="$subTitle">

    <!-- selected image -->
    <x-file-browser-image :label="'Banner Image'" :name="'image'"
      :defaultFile="$privacyAndPolicy->getFirstOrDefaultMediaUrl('image', 'original')" />
    <!-- terms and conditions -->
    <x-text-area-field :label="'Description'" :name="'description'" :placeholder="'Short Description Here.'"
      :value="$privacyAndPolicy->description" />



    <x-button />

  </x-form-base>
  <x-file-manager />

</x-cms-master-layout>