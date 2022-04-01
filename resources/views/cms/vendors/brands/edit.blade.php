<x-vendor-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="3" :method="'Edit'" />

    <x-error />

    <x-form-base :route="'vendor.brands.update'" :requiredParam="$brand" :method="'PUT'" :title="$pageTitle"
        :subTitle="$subTitle">

        <!-- Name -->
        <x-input-field :label="'Name'" :name="'name'" :placeholder="'Please enter full name here.'" :col="6"
            :required="true" :autofocus="true" :value="$brand->name" />


        <!-- Category -->
        <div class="col-lg-6">
            <div class="mb-3 @error('category_id') is-invalid @enderror">
                <label for="categories" class="form-label font-size-13 text-muted">Select
                    Category</label>
                <select class="form-control js-choices" name="category_id[]" id="categories"
                    placeholder="Select Categories" multiple>
                    @foreach ($categories as $key => $category)
                        <option value="{{ $category->id }}" @if (in_array($category->id, old('category_id', $brand->categories->pluck('id')->toArray()), true)) selected @endif>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <!-- Short Description -->
        <x-text-area-field :label="'Short Description'" :name="'short_description'"
            :placeholder="'Short Description Here.'" :value="$brand->short_description" />

        <!-- Editor Image -->
        <x-file-browser-image :label="'Editor Avatar Image'" :name="'image'"
            :defaultFile="$brand->getFirstOrDefaultMediaUrl('brands', 'thumb')" />


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

</x-vendor-master-layout>
