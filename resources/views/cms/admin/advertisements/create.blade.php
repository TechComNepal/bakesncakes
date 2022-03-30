<x-cms-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="3" :method="'Create'" />

    <x-error />

    <x-form-base :route="'admin.advertisements.store'" :title="$pageTitle" :subTitle="$subTitle">

        <!-- Title -->
        <x-input-field :label="'Name'" :name="'name'" :placeholder="'Please enter name here.'" :col="6" :required="true"
            :autofocus="true" />

        <!-- Select Brand -->
        <x-select-field-name :label="'Select Brand'" :name="'brand_id'" :placeholder="'Select Brand.'" :col="6"
            :values="$brands" />

        <!-- Rank -->
        <x-input-field :type="'number'" :label="'Rank'" :name="'rank'" :placeholder="'Please enter rank here.'" :col="6"
            :required="TRUE" />

        <!-- Select Advertisement Placement -->
        <x-select-field-name :label="'Select Advertisement Placement'" :name="'advertisement_placement_id'"
            :placeholder="'Select Advertisement Placement.'" :col="6" :values="$advertisementPlacements"
            :required="TRUE" />

        <x-select-field-name :label="'Select Columns'" :name="'columns'" :placeholder="'Select Columns.'" :col="6"
            :required="TRUE">
            <option value="12" selected>1</option>
            <option value="6">2</option>
            <option value="4">3</option>
        </x-select-field-name>

        <!-- Status -->
        <x-switch :label="'Status'" :name="'status'" :checked="true" :col="4" />

        <!-- Image -->
        <span style="color:#b70a0a;"><small id="size">Image Size should be 1920x600</small></span>
        <x-file-browser-image :label="'Image size'" :name="'image_url'" :required="TRUE" />

        <!-- Link -->
        <x-input-field :label="'Link'" :name="'Links'" :placeholder="'Please enter site link here.'" :col="12" :required="true"
            :autofocus="true" />
        <x-button />

    </x-form-base>

    <x-file-manager />

    @push('scripts')
        <script>
            $(document).ready(() => {
                $('body').on('change', '#columns')
                $('#columns').on('change', function() {

                    if (this.value == '12') {
                        $('#size').html('Image Size should be 1920x600')
                    } else {
                        $('#size').html('Image Size should be 600x400')
                    }
                })
            })
        </script>
    @endpush


</x-cms-master-layout>
