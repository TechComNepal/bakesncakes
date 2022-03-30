<x-cms-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="3" :method="'Create'" />

    <x-error />

    <x-form-base :route="'admin.promocodes.store'" :title="$pageTitle" :subTitle="$subTitle">

        <!-- Discount on Fields -->
        <x-select-field-name :label="'Discount On'" :name="'discount_on'" :placeholder="'Select Discount On.'">
            <option value="product" selected>Product</option>
            <option value="category">Category</option>
        </x-select-field-name>

        <div id="products_item">
            <!-- Products -->
            <x-select-field-name :label="'Select Products'" :name="'product_id'" :placeholder="'Select Products.'"
                :values="$products" />
        </div>

        <div class="d-none" id="category_item">
            <!-- Category -->
            <x-select-field-name :label="'Select Category'" :name="'category_id'" :placeholder="'Select Category.'"
                :values="$categories" />
        </div>

        <!-- Coupon Code -->
        <x-input-field :label="'Coupon Code'" :name="'coupon_code'" :placeholder="'Please enter a coupon code.'"
            :col="4" :required="TRUE" :autofocus="TRUE" />

        <!--Select Discount Type -->
        <x-select-field-name :label="'Select Discount Type'" :name="'type'" :placeholder="'Select Discount Type.'"
            :col="4">
            <option value="flat" selected>Flat</option>
            <option value="percent">Percent</option>
        </x-select-field-name>

        <!--Discount -->

        <x-input-field :type="'number'" :label="'Discount'" :name="'rate'" :placeholder="'Enter a discount rate '"
            :col="4" :min="0" :autofocus="TRUE" />

        <!--Start date -->
        <x-input-field :type="'date'" :label="'Start Date'" :name="'start_from'" :placeholder="'enter a start date'"
            :col="6" :required="TRUE" :autofocus="TRUE" />

        <!--End date -->
        <x-input-field :type="'date'" :label="'End Date'" :name="'expires_on'" :placeholder="'enter a end date'"
            :col="6" :required="TRUE" :autofocus="TRUE" />


        <div class="form-group">
            <x-button />
        </div>

    </x-form-base>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#discount_on').on('change', function() {
                    if (this.value == 'brand') {

                        $('#category_item').addClass('d-none');
                        $('#products_item').addClass('d-none');
                    } else if (this.value == 'category') {
                        $('#category_item').removeClass('d-none');
                        $('#products_item').addClass('d-none');
                    } else {
                        $('#category_item').addClass('d-none');
                        $('#products_item').removeClass('d-none');
                    }
                })
            });
        </script>
    @endpush


</x-cms-master-layout>
