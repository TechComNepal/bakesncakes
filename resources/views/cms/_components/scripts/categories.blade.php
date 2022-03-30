@push('scripts')
    <script>
        function toggleInMenu(id) {
            let menu_el = $('#in-menu-switch-' + id);
            let in_menu = menu_el.prop('checked') === true ? 1 : 0;

            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{route('cms.categories.toggle.menu')}}",
                data: {
                    'in_menu': in_menu,
                    'category_id': id,
                },
                success: function (data) {
                    (data.status === 'success')
                        ? alertify.success(data.message)
                        : alertify.error(data.message);
                }
            });
        }

        $('#datatable').on('click', '#delete-btn', function (event) {
            event.preventDefault();
            event.stopPropagation();
            let slug = $(this).data('slug');
            let delete_url = "{{ route('cms.categories.destroy', '') }}/" + slug;

            showConfirmationDialog(delete_url);
        });
    </script>
@endpush
