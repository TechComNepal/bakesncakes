<x-cms-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="2" :method="'Edit'" />

    <x-error />

    <x-form-base :route="'admin.termsAndCondition.update'" :title="$pageTitle" :subTitle="$subTitle">

        
          <!-- selected image -->
          <x-file-browser-image :label="'Banner Image'" :name="'image'"
          :defaultFile="$termsAndCondition->getFirstOrDefaultMediaUrl('image', 'original')" />

        <!-- Name -->
        <x-input-field :label="'Name'" :name="'title'" :placeholder="'Please enter full title here.'" :required="true"
            :autofocus="true" :value="$termsAndCondition->title" />

        <!-- terms and conditions -->
        <x-text-area-field :label="'Description'" :name="'description'" :placeholder="'Short Description Here.'"
            :value="$termsAndCondition->description" />

        
          
        <x-button />

    </x-form-base>
    <x-file-manager />
</x-cms-master-layout>