<x-cms-employee-master-layout :pageTitle="$pageTitle">
    @push('styles')
        <style>
            div.is-invalid div.choices__inner {
                border-color: #fd625e;
                padding-right: calc(1.5em + 0.94rem);
                background-repeat: no-repeat;
                background-position: right calc(0.375em + 0.235rem) center;
                background-size: calc(0.75em + 0.47rem) calc(0.75em + 0.47rem);
            }

        </style>
    @endpush

    <x-breadcrumb :title="$pageTitle" :item="3" :method="'Create'" />

    <x-error />

    <x-form-base :route="'employee.brands.store'" :title="$pageTitle" :subTitle="$subTitle">

        <!-- Name -->
        <x-input-field :label="'Name'" :name="'name'" :placeholder="'Please enter full name here.'" :col="5"
            :required="true" :autofocus="true" />

        <!-- Category -->
        <div class="col-lg-6">
            <div class="mb-3 @error('category_id') is-invalid @enderror">
                <label for="categories" class="form-label font-size-13 text-muted">Select
                    Category</label>

                <select class="form-control  js-choices" name="category_id[]" id="categories"
                    placeholder="Select Categories" multiple>
                    @foreach ($categories as $key => $category)
                        <option @if (in_array($category->id, old('category_id') ?? [])) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <!-- Status -->
        <x-switch :label="'Status'" :name="'status'" :checked="true" :col="2" />

        <!-- Short Description -->
        <x-text-area-field :label="'Short Description'" :name="'short_description'"
            :placeholder="'Short Description Here.'" />

        <!-- Editor Image -->
        <x-file-browser-image :label="'Editor Avatar Image'" :name="'image'" />


        <x-button />

    </x-form-base>
    <x-file-manager />


    @push('scripts')
        <script>
            $(document).ready(function() {

                new Choices("#categories", {
                    removeItemButton: !0
                });
            });
        </script>

    @endpush


</x-cms-employee-master-layout>
