@push('scripts')

    <script>
        $(document).ready(function () {

            $.fn.filemanager = function (type, options) {
                type = type || 'file';

                this.on('click', function (e) {
                    let route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
                    let target_path = $('#' + $(this).data('path'));
                    let target_preview = $('#' + $(this).data('preview'));
                    let preview_wrapper = $('#' + $(this).data('preview-wrapper'));
                    window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
                    window.SetUrl = function (items) {
                        let file_path = items.map(function (item) {
                            return item.url;
                        }).join(',');

                        // set the value of the desired input to image url
                        target_path.text('').text(file_path);
                        $('#image_url').val(file_path);

                        // clear previous preview
                        target_preview.html('');

                        // Set Preview Classes to render Image
                        $('#lfm').addClass('has-preview');
                        preview_wrapper.addClass('d-block');

                        // set or change the preview image src
                        items.forEach(function (item) {
                            target_preview.append(
                                $('<img>').attr('src', item.url)
                            );
                        });

                        // trigger change event
                        target_preview.trigger('change');
                    };
                    return false;
                });
            }
            $('#lfm').filemanager('image');
        });
    </script>
@endpush
