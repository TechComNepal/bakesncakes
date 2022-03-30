<x-cms-employee-master-layout :pageTitle="$pageTitle">
    <x-breadcrumb :title="$pageTitle" :item="1" :method="'List Of'" />
    <x-error/>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-wrap align-items-center">
                        <h4 class="card-title">List of {{ $pageTitle }}</h4>
                        <div class="ms-auto">
                            <div>
                                @if(auth()->user()->can('add product'))
                                <a href="{{ route('employee.products.create') }}" type="button"
                                   class="btn btn-primary btn-md">
                                    <i class="bx bx-plus"></i> New {{ $pageTitle }}
                                </a>
                                @endif
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
                            <th>Info</th>
                            <th>SKU</th>
                            <th>Slug</th>
                            <th>Taxable</th>
                            <th>Featured</th>
                            <th>Refundable</th>
                            <th>Trending</th>
                            <th>Sellable</th>
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
                    url: "{{ route('employee.categories.toggle.status') }}",
                    data: {
                        'is_status': is_status,
                        'category_id': id,
                    },
                    success: function(data) {
                        (data.status === 'success') ?
                            alertify.success(data.message): alertify.error(data.message);
                    }
                });
            }

            function toggleIsFeatured(id) {
                let featuredEl = $('#is-featured-switch-' + id);
                let is_featured = featuredEl.prop('checked') === true ? 'on' : 'off';

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ route('employee.categories.toggle.featured') }}",
                    data: {
                        'is_featured': is_featured,
                        'category_id': id,
                    },
                    success: function(data) {
                        (data.status === 'success') ?
                            alertify.success(data.message): alertify.error(data.message);
                    }
                });
            }

            function toggleInMenu(id) {
                let menuEl = $('#in-menu-switch-' + id);
                let in_menu = menuEl.prop('checked') === true ? 'on' : 'off';

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ route('employee.categories.toggle.menu') }}",
                    data: {
                        'in_menu': in_menu,
                        'category_id': id,
                    },
                    success: function(data) {
                        (data.status === 'success') ?
                            alertify.success(data.message): alertify.error(data.message);
                    }
                });
            }

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
                        {data: 'name', name: 'name'},
                        {data: 'info', name: 'info'},
                        {data: 'sku', name: 'sku'},
                        {data: 'slug', name: 'slug', orderable: false},
                        {data: 'is_taxable', name: 'is_taxable'},
                        {data: 'is_featured', name: 'is_featured', orderable: false},
                        {data: 'is_refundable', name: 'is_refundable', orderable: false},
                        {data: 'is_trending', name: 'is_trending', orderable: false},
                        {data: 'is_sellable', name: 'is_sellable', orderable: false},
                        {data: 'actions', name: 'actions', orderable: false, searchable: false},
                    ],
                    "fnDrawCallback": function() {
                        initSwitchToggler();
                    }
                });


                $('#datatable').on('click', '#delete-btn', function(event) {
                    event.preventDefault();
                    event.stopPropagation();
                    var id = $(this).data('id');
                    var delete_url = "{{ route('employee.products.destroy', '') }}/" + id;

                    showConfirmationDialog(delete_url, DTable);
                });
            });
        </script>

    @endpush

</x-cms-employee-master-layout>
