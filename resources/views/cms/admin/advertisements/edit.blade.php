<x-cms-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="3" :method="'Edit'" />

    <x-error />

    <x-form-base :route="'admin.advertisements.update'" :requiredParam="$advertisement" :title="$pageTitle"
        :subTitle="$subTitle" :method="'PUT'">

        <!-- Title -->
        <x-input-field :label="'Name'" :name="'name'" :placeholder="'Please enter name here.'" :col="6" :required="true"
            :autofocus="true" :value="$advertisement->name" />

        <!-- Select Brand -->
        <x-select-field-name :label="'Select Brand'" :name="'brand_id'" :placeholder="'Select Brand.'" :col="6"
            :values="$brands" :selected="$advertisement->brand_id" />

        <!-- Rank -->
        <x-input-field :type="'number'" :label="'Rank'" :name="'rank'" :placeholder="'Please enter rank here.'" :col="6"
            :required="TRUE" :value="$advertisement->rank" />

        <!-- Select Advertisement Placement -->
        <x-select-field-name :label="'Select Advertisement Placement'" :name="'advertisement_placement_id'"
            :placeholder="'Select Advertisement Placement.'" :col="6" :values="$advertisementPlacements"
            :required="TRUE" :selected="$advertisement->advertisement_placement_id" />

        <x-select-field-name :label="'Select Columns'" :name="'columns'" :placeholder="'Select Columns.'" :col="6"
            :required="TRUE">
            <option value="12" @if ($advertisement->columns == '12') selected @endif>1</option>
            <option value="6" @if ($advertisement->columns == '6') selected @endif>2</option>
            <option value="4" @if ($advertisement->columns == '4') selected @endif>3</option>
        </x-select-field-name>

        <!-- Image -->
        <span style="color:#b70a0a;"><small id="size">Image Size should be 1920x600</small></span>
        <x-file-browser-image :label="'Image size'" :name="'image_url'" :required="TRUE"
            :defaultFile="$advertisement->getFirstMediaUrl('image')" />

        <!-- Link -->
        <x-input-field :label="'Link'" :name="'link'" :placeholder="'Please enter site link here.'" :col="12"
            :autofocus="true" :value="$advertisement->link" />

        <x-button />

    </x-form-base>

    <x-file-manager />

    @push('scripts')
    <script>
        $(document).ready(() => {
                $('#columns').on('change', function() {
                    if (this.value == '1') {
                        $('#size').html('Image Size should be 1920x600')
                    } else {
                        $('#size').html('Image Size should be 600x400')
                    }
                })
            })
    </script>
    @endpush


</x-cms-master-layout>