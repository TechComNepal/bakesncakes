<x-cms-employee-master-layout :pageTitle="$pageTitle">
@push('styles')
        <style type="text/css">
            .bootstrap-tagsinput {
                width: 100%;
            }
        </style>
@endpush
    <x-breadcrumb :title="$pageTitle" :item="3" :method="'Create'" />

    <x-error />

    <x-form-base :route="'employee.products.store'" :title="$pageTitle" :subTitle="$subTitle" class="bg-soft-light">

        <!-- Product Info -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Product Information</h4>
                    </div>
                    <div class="card-body">

                        <!-- Name -->
                        <x-input-field :label="'Name'" :name="'name'" :placeholder="'Please enter product name here.'" :required="true" :autofocus="true" />

                        <!-- SKU -->
                        <x-input-field :label="'SKU'" :name="'sku'" :placeholder="'Please enter sku here.'" :required="true" :autofocus="true" :required="true" :autofocus="true"/>

                        <!-- Category -->
                        <x-select-field-name :label="'Categories'" :name="'category_id'" :placeholder="'Select Category.'">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @foreach ($category->children as $childCategory)
                                    @include('cms.admin.categories.child_category', ['child_category' => $childCategory])
                                @endforeach
                            @endforeach
                        </x-select-field-name>

                        <!-- Brands -->
                        <x-select-field-name :label="'Brands'" :name="'brand_id'" :placeholder="'Select Brand.'" :values="$brands" />

                        <!-- Unit -->
                        <x-input-field :label="'Unit'" :name="'units'" :placeholder="'Unit (e.g. KG, Pcs ets)'" :required="true" :autofocus="true" :step="1"/>

                        <!-- Minimum Purchase Unit -->
                        <x-input-field :type="'number'" :label="'Minimum Purchase Unit'" :name="'min_purchase_unit'" :placeholder="'Please enter Minimum Purchase Unit here.'" :required="true" :autofocus="true" :step="1"/>

                        <!-- Tags -->
                        <x-input-field :label="'Tags'" :name="'tags'" :id="'tags'" :placeholder="'Tags'" :autofocus="TRUE" :dataRole="'tagsinput'" />

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Product Status</h4>
                    </div>
                    <div class="card-body">
                        <!-- Is Refundable -->
                        <x-switch :label="'Is Refundable'" :name="'is_refundable'" :id="'switch2'" :checked="false" />

                        <!-- In Featured -->
                        <x-switch :label="'Is Featured'" :name="'is_featured'" :id="'switch1'" :checked="true" />

                        <!-- Is Trending -->
                        <x-switch :label="'Is Trending'" :name="'is_trending'" :id="'switch5'" :checked="true" />

                        <!-- In Sellable -->
                        <x-switch :label="'Is Sellable'" :name="'is_sellable'" :id="'switch4'" :checked="true"  />

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Enabling Customer Message on Order</h4>
                    </div>
                    <div class="card-body">
                        <!-- Enable Custom Message -->
                        <x-switch :label="'Enable Custom Message'" :name="'order_custom_msg'" :id="'switch6'" :checked="true" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Images -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Product Images</h4>
                    </div>
                    <div class="card-body">
                        <!-- Product Main Image -->
                        <x-file-browser-image :label="'Product Main Image'" :name="'image'" />

                        <!-- Gallery Image -->
                        <x-file-gallery-image :label="'Gallery Image'" :name="'gallery_image_url'" :required="FALSE" />
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Tax &#38; Vat</h4>
                    </div>
                    <div class="card-body">
                        <!-- Is Taxable -->
                        <x-switch :label="'Is Taxable'" :name="'is_taxable'" :checked="true" :col="4"/>


                        <div id="tax-form" style="display:block;">
                        <div class="row">
                            <p>Tax</p>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label visually-hidden" for="formrow-tax-input">Tax</label>
                                    <input type="number" class="form-control" id="formrow-tax-input" name="tax_amount" step="0.01" min="0" value="{{ old('tax_amount') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label visually-hidden" for="formrow-tax-type-input">Tax Type</label>
                                    <select
                                        class="form-control js-choice @error('tax_type') is-invalid @enderror"
                                        data-trigger
                                        name="tax_type"
                                        id="tax_type"
                                        data-placeholder="Select Tax Type"
                                        required
                                    >
                                        <option value="flat" @if(old('tax_type') == 'flat') selected @endif>Flat</option>
                                        <option value="percent" @if(old('tax_type') == 'percent') selected @endif>Percent</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Product Price Stock -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Product Price &#43; Stock</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        <!-- Cost Price -->
                        <x-input-field :type="'number'" :label="'Cost Price'" :name="'cost_price'" :placeholder="'Please enter Cost Price here.'" :required="true" :autofocus="true" :step="0.01" :col="'6'"/>

                        <!-- Selling Price -->
                        <x-input-field :type="'number'" :label="'Selling Price'" :name="'selling_price'" :placeholder="'Please enter Selling Price here.'" :required="true" :autofocus="true" :step="0.01" :col="'6'"/>

                        <!-- Discount -->
                        <x-input-field :type="'number'" :label="'Discount'" :name="'discount'" :placeholder="'Please enter Discount Amount here.'" :step="0.01" :col="'6'"/>

                        <!-- Discount Type -->
                        <x-select-field-name :label="'Discount Type'" :name="'discount_type'" :placeholder="'Select Discount Type.'" :col="'6'">
                            <option value="flat">Flat</option>
                            <option value="percent">Percent</option>
                        </x-select-field-name>

                        <!-- Quantity -->
                        <x-input-field :type="'number'" :label="'Quantity'" :name="'quantity'" :placeholder="'Please enter Quantity here.'" :required="true" :autofocus="true" :step="1" :col="'6'"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Description -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Product Description</h4>
                    </div>
                    <div class="card-body">
                        <!-- Description -->
                        <x-text-area-field :label="'Description'" :name="'description'" :placeholder="'Please enter description here.'" :rows="4" />
                    </div>
                </div>
            </div>
        </div>

        <x-button />

    </x-form-base>

    @push('scripts')

        <script>
            $(document).ready(function () {

                //Toogling Tax Form
                const el = document.getElementById("switch3");
                el.addEventListener("click", toggleTaxForm, false);

                function toggleTaxForm(){
                    var x = document.getElementById("tax-form");
                    if (x.style.display === "none") {
                        x.style.display = "block";
                    } else {
                        x.style.display = "none";
                    }
                }
                //FIle Manager
                $.fn.filemanager = function(type, options) {
                    type = type || 'file';

                    this.on('click', function(e) {
                        let route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
                        let target_path = $('#' + $(this).data('path'));
                        let target_preview = $('#' + $(this).data('preview'));
                        let target_preview_multiple = $('#' + $(this).data('preview-multiple'));
                        let preview_wrapper = $('#' + $(this).data('preview-wrapper'));
                        let preview_wrapper_multiple = $('#' + $(this).data('preview-wrapper-multiple'));
                        // console.log($(this).data('path'));
                        window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');

                        let multipleLfm = this.id === "lfm2";

                        window.SetUrl = function(items) {
                            let file_path = items.map(function(item) {
                                return item.url;
                            }).join(',');

                            let multiplePaths = items.map(item => item.url);


                            if (multipleLfm) {
                                $('#gallery_image_url').val(multiplePaths);
                            } else {
                                // set the value of the desired input to image url
                                target_path.text('').text(file_path);
                                $('#image_url').val(file_path)
                            }


                            // clear previous preview
                            target_preview.html('');
                            target_preview_multiple.html('');

                            // Set Preview Classes to render Image
                            $('#lfm').addClass('has-preview');
                            $('#lfm2').addClass('has-preview');
                            preview_wrapper.addClass('d-block');
                            preview_wrapper_multiple.addClass('d-block');

                            // set or change the preview image src
                            items.forEach(function(item) {
                                target_preview.append(
                                    $('<img>').attr('src', item.url)
                                );
                                target_preview_multiple.append(
                                    $('<img>').attr('src', item.url)
                                );
                            });

                            // trigger change event
                            target_preview.trigger('change');
                            target_preview_multiple.trigger('change');
                        };
                        return false;
                    });
                }
                $('#lfm').filemanager('image');
                $('#lfm2').filemanager('image');
            });
        </script>
    @endpush

</x-cms-employee-master-layout>
