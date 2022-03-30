<x-cms-employee-master-layout :pageTitle="$pageTitle">
    <x-breadcrumb :title="$pageTitle" :item="2" />


    <div class="row">
        <div class="col-12">
            <div class="card-body">
                <div class="card-header">
                    <div class="d-flex flex-wrap align-items-center">
                        <h4 class="card-title">List of all {{\Illuminate\Support\Str::plural($pageTitle)}}</h4>
                        <div class="ms-auto">
                            <div>
                                @if(auth()->user()->can('add blog'))
                                <a href="{{route('employee.blogs.create')}}" type="button" class="btn btn-primary btn-md">
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
                            <th>SN</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Publidhed At</th>
                            <th>Views</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        @push('scripts')
        <script>
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
                        data: 'title',
                        name: 'title'
                    },

                    {
                        data: 'slug',
                        name: 'slug'
                    },

                    {
                        data: 'image',
                        name: 'image',
                        orderable: false
                    },

                  {
                        data: 'description',
                        name: 'description',
                        orderable: false
                    },

                    {
                        data: 'created_at',
                        name: 'created_at',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'views',
                        name: 'views',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },


                ],

            });

            $('#datatable').on('click', '#delete-btn', function(event) {
                event.preventDefault();
                event.stopPropagation();
                var id = $(this).data('id');
                var delete_url = "{{ route('employee.blogs.delete', '') }}/" +id;

                showConfirmationDialog(delete_url, DTable);
            });
        });
        </script>
        @endpush

</x-cms-employee-master-layout>
