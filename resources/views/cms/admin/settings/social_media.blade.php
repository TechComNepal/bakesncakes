<x-cms-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="2" :method="''" />

    <x-error />

    <x-form-base :route="'admin.setting.social.media.update'" :title="$pageTitle" :subTitle="$subTitle">

        <!-- Facebook Link -->
        <x-input-field :label="'Facebook Link'" :name="'facebook_link'" :placeholder="'Please enter facebook link here.'" :value="$socialmedia->facebook_link" />

        <!-- Twitter Link -->
        <x-input-field :label="'Twitter Link'" :name="'twitter_link'" :placeholder="'Please enter twitter link here.'" :value="$socialmedia->twitter_link" />

        <!-- Instagram Link -->
        <x-input-field :label="'Instagram Link'" :name="'instagram_link'" :placeholder="'Please enter instagram link here.'" :value="$socialmedia->instagram_link" />

        <!-- Youtube Link -->
        <x-input-field :label="'Youtube Link'" :name="'youtube_link'" :placeholder="'Please enter youtube link here.'" :value="$socialmedia->youtube_link" />

        <x-button/>

    </x-form-base>


    <x-file-manager />
    @push('scripts')

    @endpush

</x-cms-master-layout>

