<x-cms-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="2" :method="'List Of'" />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-wrap align-items-center">
                        <h4 class="card-title">List of {{ $pageTitle }}</h4>
                        <div class="ms-auto">
                            <div>
                                <a href="{{ route('admin.brands.create') }}" type="button"
                                    class="btn btn-primary btn-md">
                                    <i class="bx bx-plus"></i> New {{ $pageTitle }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>SN.</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Short Description</th>
                                <th>Status</th>
                                <th>Created By </th>
                                <th>Category </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')

        <script>
            function toggleIsStatus(id) {
                let statusEl = $('#is-status-switch-' + id);
                let is_status = statusEl.prop('checked') === true ? 'on' : 'off';

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ route('admin.brands.toggle.status') }}",
                    data: {
                        'is_status': is_status,
                        'brand_id': id,
                    },
                    success: function(data) {

                        (data.status === 'success') ?
                        alertify.success(data.message): alertify.error(data.message);
                    }
                });
            }

            // Datatable
            $(document).ready(() => {

                var DTable = $("#datatable").DataTable({
                    "language": {
                        "lengthMenu": "Show _MENU_",
                    },
                    "dom": "<'row'" +
                        "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                        "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                        ">" +

                        "<'table-responsive'tr>" +

                        "<'row'" +
                        "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                        "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                        ">",
                    processing: true,
                    serverSide: true,
                    responsive: false,
                    ajax: window.location.href,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'slug',
                            name: 'slug'
                        },
                        {
                            data: 'short_description',
                            name: 'short_description'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: false
                        },
                        {
                            data: 'user_id',
                            name: 'user_id',
                            orderable: false
                        },

                        {
                            data: 'category',
                            name: 'category',
                            orderable: false
                        },
                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    "fnDrawCallback": function() {
                        initSwitchToggler();
                    }
                });

                $('#datatable').on('click', '#delete-btn', function(event) {
                    event.preventDefault();
                    event.stopPropagation();
                    var id = $(this).data('id');
                    var delete_url = "{{ route('admin.brands.destroy', '') }}/" + id;

                    showConfirmationDialog(delete_url, DTable);
                });

            });
        </script>
    @endpush


</x-cms-master-layout>
