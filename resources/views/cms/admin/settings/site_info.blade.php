<x-cms-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="2" :method="''" />

    <x-error />

    <x-form-base :route="'admin.setting.store'" :title="$pageTitle" :subTitle="$subTitle">

        <!-- Company Name -->
        <x-input-field :label="'Company Name'" :name="'company_name'" :placeholder="'Please enter company name here.'"
            :value="$setting->company_name" :required="true" :autofocus="true" />

        <!-- Company Email -->
        <x-input-field :label="'Company Email'" :name="'company_email'"
            :placeholder="'Please enter company email here.'" :value="$setting->company_email" :required="true"
            :autofocus="true" />

        <!-- Company Phone -->
        <x-input-field :label="'Company Phone'" :name="'company_phone'"
            :placeholder="'Please enter company phone here.'" :value="$setting->company_phone" :required="true"
            :autofocus="true" />

        <!-- Company website -->
        <x-input-field :label="'Company Website'" :name="'website'" :placeholder="'Please enter company website here.'"
            :value="$setting->website" :required="true" :autofocus="true" />

        <!-- Company Logo -->
        <x-file-browser-image :label="'Logo Image'" :name="'logo'"
            :defaultFile="$setting->getFirstOrDefaultMediaUrl('logo')" />

        <!-- Company favicon -->
        <div class="col-lg-12 mb-3">
            <label for="favicon" class="form-label">Favicon Image </label>
            <div class="dropify-wrapper" id="lfm2" data-path="path" data-preview-wrapper-favicon="preview-favicon"
                data-preview-favicon="holder2" style="@error('image_url') border: 2px solid #febfbe @enderror">
                <div class="dropify-message has-preview">
                    <span class="file-icon">
                        <p>Click to open Image Browser</p>
                    </span>
                    <p class="dropify-error">Ooops, something wrong happended.</p>
                </div>
                <div class="dropify-preview d-block" id="preview-favicon">
                    <span class="dropify-render" id="holder2">
                        <img src="{{ $setting->getFirstOrDefaultMediaUrl('favicon') }}" alt="">
                    </span>
                    <div class="dropify-infos">
                        <div class="dropify-infos-inner">
                            <p class="dropify-filename"><span class="file-icon"></span> <span
                                    class="dropify-filename-inner" id="path">{{ $defaultFile ?? '' }}</span></p>
                            <p class="dropify-infos-message">Click and Open Image Browser to replace</p>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="" id="image_url_favicon" name="favicon" required>
            </div>
            @error('image_url')
                <p style="color: #fd625e; font-size: 80%; margin-top: 4px">Image Field is required</p>
            @enderror
        </div>

        <!-- Company Address -->
        <x-text-area-field :label="'Company Address'" :name="'address'" :value="$setting->address"
            :placeholder="'Company Address Here.'" />

        <x-button />

    </x-form-base>


    <x-file-manager />
    @push('scripts')
        <script>
            $(document).ready(function() {

                $.fn.filemanager = function(type, options) {
                    type = type || 'file';

                    this.on('click', function(e) {
                        let route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
                        let target_path = $('#' + $(this).data('path'));
                        // let target_preview = $('#' + $(this).data('preview'));
                        let target_preview_favicon = $('#' + $(this).data('preview-favicon'));
                        // let preview_wrapper = $('#' + $(this).data('preview-wrapper'));
                        let preview_wrapper_favicon = $('#' + $(this).data('preview-wrapper-favicon'));

                        window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
                        window.SetUrl = function(items) {
                            let file_path = items.map(function(item) {
                                return item.url;
                            }).join(',');

                            // set the value of the desired input to image url
                            target_path.text('').text(file_path);
                            $('#image_url_favicon').val(file_path);

                            // clear previous preview
                            target_preview_favicon.html('');

                            // Set Preview Classes to render Image
                            $('#lfm2').addClass('has-preview');
                            preview_wrapper_favicon.addClass('d-block');

                            // set or change the preview image src
                            items.forEach(function(item) {
                                target_preview_favicon.append(
                                    $('<img>').attr('src', item.url)
                                );
                            });

                            // trigger change event
                            target_preview_favicon.trigger('change');
                        };
                        return false;
                    });
                }
                $('#lfm2').filemanager('image');
            });
        </script>
    @endpush

</x-cms-master-layout>
