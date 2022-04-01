<x-cms-employee-master-layout :pageTitle="$pageTitle">
    @push('styles')
        <style type="text/css">
            .bootstrap-tagsinput {
                width: 100%;
            }

        </style>
    @endpush
    <x-breadcrumb :title="$pageTitle" :item="3" :method="'Create'" />


    <ul class="nav nav-tabs-custom card-header-tabs border-top my-4" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link px-3 @if (!$errors->has('gallery_image_url')) active @endif" data-bs-toggle="tab" href="#details"
                role="tab">Product
                Details</a>
        </li>
        <li class="nav-item">
            <a class="nav-link px-3 @if ($errors->has('gallery_image_url')) active @endif " data-bs-toggle="tab"
                href="#gallery" role="tab">Add More
                Images</a>
        </li>

    </ul>


    <x-error />

    <div class="tab-content">
        <div class="tab-pane  @if (!$errors->has('gallery_image_url')) active @endif" id="details" role="tabpanel">
            <x-form-base :route="'employee.products.update'" :requiredParam="$product" :title="$pageTitle"
                :subTitle="$subTitle" class="bg-soft-light" :method="'PUT'">

                <!-- Product Info -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Product Information</h4>
                            </div>
                            <div class="card-body">

                                <!-- Name -->
                                <x-input-field :label="'Name'" :name="'name'"
                                    :placeholder="'Please enter product name here.'" :required="true" :autofocus="true"
                                    :value="$product->name" />

                                <!-- SKU -->
                                <x-input-field :label="'SKU'" :name="'sku'" :placeholder="'Please enter sku here.'"
                                    :required="true" :autofocus="true" :required="true" :autofocus="true"
                                    :value="$product->sku" />

                                <!-- Category -->
                                <x-select-field-name :label="'Categories'" :name="'category_id'"
                                    :placeholder="'Select Category.'">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($category->id == $product->category->id) selected @endif>{{ $category->name }}
                                        </option>
                                        @foreach ($category->children as $childCategory)
                                            @include(
                                                'cms.admin.categories.child_category',
                                                ['child_category' => $childCategory]
                                            )
                                        @endforeach
                                    @endforeach
                                </x-select-field-name>

                                <!-- Brands -->
                                <x-select-field-name :label="'Brands'" :name="'brand_id'" :placeholder="'Select Brand.'"
                                    :values="$brands" :selected="$product->brand_id" />

                                <!-- Unit -->
                                <x-input-field :label="'Unit'" :name="'units'" :placeholder="'Unit (e.g. KG, Pcs ets)'"
                                    :required="true" :autofocus="true" :step="1" :value="$product->units" />

                                <!-- Minimum Purchase Unit -->
                                <x-input-field :type="'number'" :label="'Minimum Purchase Unit'"
                                    :name="'min_purchase_unit'"
                                    :placeholder="'Please enter Minimum Purchase Unit here.'" :required="true"
                                    :autofocus="true" :step="1" :value="$product->min_purchase_unit" />

                                <!-- Tags -->
                                <x-input-field :label="'Tags'" :name="'tags'" :id="'tags'" :placeholder="'Tags'"
                                    :autofocus="TRUE" :dataRole="'tagsinput'" :value="$product->tags" />

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Product Status</h4>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Enabling Customer Message on Order</h4>
                                </div>
                                <div class="card-body">
                                    <!-- Enable Custom Message -->
                                    <x-switch :label="'Enable Custom Message'" :name="'order_custom_msg'"
                                        :id="'switch6'" :checked="true" />
                                </div>
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
                                <x-file-browser-image :label="'Product Main Image'" :name="'image'"
                                    :defaultFile="$product->getFirstOrDefaultMediaUrl('image')" />
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
                                <x-switch :label="'Is Taxable'" :name="'is_taxable'"
                                    :checked="$product->is_taxable ?? FALSE" />


                                <div id="tax-form"
                                    @if (old('is_taxable', $product->is_taxable) == true) style="display:block;" @else style="display:none;" @endif>
                                    <div class="row">
                                        <p>Tax</p>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label visually-hidden"
                                                    for="formrow-tax-input">Tax</label>
                                                <input type="number" class="form-control" id="formrow-tax-input"
                                                    name="tax_amount" step="0.01" min="0"
                                                    value="{{ $product->tax_amount ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label visually-hidden"
                                                    for="formrow-tax-type-input">Tax Type</label>
                                                <select
                                                    class="form-control js-choice @error('tax_type') is-invalid @enderror"
                                                    data-trigger name="tax_type" id="tax_type"
                                                    data-placeholder="Select Tax Type" required>
                                                    <option value="flat"
                                                        @if (old('tax_type') == 'flat') selected @endif>Flat</option>
                                                    <option value="percent"
                                                        @if (old('tax_type') == 'percent') selected @endif>Percent
                                                    </option>
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
                                    <x-input-field :type="'number'" :label="'Cost Price'" :name="'cost_price'"
                                        :placeholder="'Please enter Cost Price here.'" :required="true"
                                        :autofocus="true" :step="0.01" :col="'6'" :value="$product->cost_price" />

                                    <!-- Selling Price -->
                                    <x-input-field :type="'number'" :label="'Selling Price'" :name="'selling_price'"
                                        :placeholder="'Please enter Selling Price here.'" :required="true"
                                        :autofocus="true" :step="0.01" :col="'6'" :value="$product->selling_price" />

                                    <!-- Discount -->
                                    <x-input-field :type="'number'" :label="'Discount'" :name="'discount'"
                                        :placeholder="'Please enter Discount Amount here.'" :step="0.01" :col="'6'"
                                        :value="$product->discount" />

                                    <!-- Discount Type -->
                                    <x-select-field-name :label="'Discount Type'" :name="'discount_type'"
                                        :placeholder="'Select Discount Type.'" :col="'6'">
                                        <option @if (old('discount_type', $product->discount_type) == 'flat') selected @endif value="flat">Flat
                                        </option>
                                        <option @if (old('discount_type', $product->discount_type) == 'percent') selected @endif value="percent">
                                            Percent</option>
                                    </x-select-field-name>

                                    <!-- Quantity -->
                                    <x-input-field :type="'number'" :label="'Quantity'" :name="'quantity'"
                                        :placeholder="'Please enter Quantity here.'" :required="true" :autofocus="true"
                                        :step="1" :col="'6'" :value="$product->quantity" />
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
                                <x-text-area-field :label="'Description'" :name="'description'"
                                    :placeholder="'Please enter description here.'" :rows="4"
                                    :value="$product->description" />
                            </div>
                        </div>
                    </div>
                </div>

                <x-button />

            </x-form-base>

        </div>
        <!-- end tab pane -->

        <div class="tab-pane @if ($errors->has('gallery_image_url')) active @endif" id="gallery" role="tabpanel">

            <x-form-base :route="'employee.products.gallery.update'" :requiredParam="$product" :method="'PUT'"
                :title="$pageTitle" :subTitle="$subTitle">
                <!-- Gallery Image -->
                <x-file-gallery-image :label="'Gallery Image'" :name="'gallery_image_url'" :required="FALSE" />

                <div>
                    <button type="submit" class="btn btn-success">Add Images </button>
                </div>
            </x-form-base>
            <hr>
            <div id="image-gallery">
                <div class="row mb-2">
                    <div class="col-12">
                        <h4 class="text-center">Gallery Images </h4>

                    </div>

                </div>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($gallerys as $gallery)
                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ $gallery->getUrl('square-md-thumb') }}" class="card-img-top"
                                    alt="Gallery Image">

                                <div class="card-footer">
                                    <small class="text-muted">Last updated
                                        {{ $gallery->updated_at->diffForHumans() }}</small>

                                    <span class="d-flex justify-content-end">
                                        <a href="#" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;"
                                            id="deleteGallery" data-id="{{ $gallery->id }}">
                                            Delete </a>
                                    </span>


                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>



            </div>

        </div>
        <!-- end tab pane -->
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {

                //Toogling Tax Form
                const el = document.getElementById("switch3");
                el.addEventListener("click", toggleTaxForm, false);

                function toggleTaxForm() {
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


                //Delete specific gallery

                $("body").on("click", "#deleteGallery", function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var id = $(this).data("id");
                    var url = "{{ route('employee.products.gallery.destroy', '') }}/" + id;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3d4144',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                url: url,
                                type: 'delete',
                                data: {
                                    '_token': '{{ @csrf_token() }}'

                                },
                                success: function(result) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your record has been deleted.',
                                        'success'
                                    ).then(() => {
                                        $('#image-gallery').load(location.href + (
                                            ' #image-gallery'));
                                    })
                                },
                                error: function(result) {
                                    console.log(result.success)
                                    Swal.fire(
                                        'Error!',
                                        'Some Problem Occured. Please Try again later.',
                                        'error'
                                    ).then(() => {
                                        location.reload();
                                    })
                                }
                            })
                        } else {
                            Swal.fire("Cancelled", "Deletion Cancelled", "error");
                        }
                    })

                });


            });
        </script>
    @endpush

</x-cms-employee-master-layout>
