<x-cms-master-layout :pageTitle="$pageTitle">
    @push('styles')
    <style>
        .bootstrap-tagsinput {
            width: 100%;
        }
    </style>

    @endpush

    <x-breadcrumb :title="$pageTitle" :item="2" :method="'Create'"  />
    <x-error />
    <x-form-base :route="'admin.customOrder.store'" :title="$pageTitle" :subTitle="$subTitle" class="bg-soft-light">

        <!-- Customer Name -->
        <x-input-field :label="'Customer Name'" :name="'name'" :placeholder="'Customer Name...'" :required="true"
            :col="'6'" :autofocus="true" />

        <!-- Email Address  -->
        <x-input-field :type="'email'" :label="'Email Address'" :name="'email'"
            :placeholder="'enter email address here..'" :autofocus="TRUE" :col="'6'" />

        <!-- Customer City Address -->
        <x-input-field :label="'City'" :name="'city'" :placeholder="'Add City...'" :required="true" :col="'6'"
            :autofocus="true" />

        <!-- Customer Address -->
        <x-input-field :label="'Address'" :name="'address'" :placeholder="'Enter address...'" :required="true"
            :col="'6'" :autofocus="true" />


        <!-- Primary  number  -->
        <x-input-field :label="'Mobile number'" :name="'primary_number'" :id="'primary_number'"
            :placeholder="'Mobile Number'" :autofocus="TRUE" :col="'6'" />

        <!-- Secondar number  -->
        <x-input-field :label="'Alternative Number'" :name="'secondary_number'" :id="'secondary_number'"
            :placeholder="'Alternative Number'" :autofocus="TRUE" :col="'6'" />
        
            <!-- Email Address  -->
        <x-input-field  :label="'Number Of Quantity'" :name="'quantity'" :placeholder="'Add Quantity.'"
            :autofocus="TRUE" :col="'6'" />

        <!-- Email Address  -->
        <x-input-field :type="'datetime-local'" :label="'Delivery Date'" :name="'date'" :placeholder="'enter fate here address here..'"
            :autofocus="TRUE" :col="'6'" />

        <!-- Custom image -->
        
        <!-- add only gallery image not [] add this one-->
        <x-file-gallery-image :label="'Gallery Image'" :name="'gallery_image'" :required="FALSE" />

        <!-- Description -->
        <x-text-area-field :label="'Blog Description'" :name="'description'" :required="true" />




        <x-button />

    </x-form-base>
    @push('scripts')

    <script>
        $(document).ready(function () {

       
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

</x-cms-master-layout>