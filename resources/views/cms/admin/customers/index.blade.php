<x-cms-master-layout>

    <x-breadcrumb :title="$pageTitle" :item="2" :method="'List Of'" />
    <x-error />
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-wrap align-items-center">
                        <h4 class="card-title">{{ $subTitle }}</h4>

                        <div class="ms-auto">
                            <div>
                                <a href="{{ route('admin.' . Str::plural(Str::lower($pageTitle)) . '.create') }}"
                                   type="button" class="btn btn-primary btn-md">
                                    <i class="bx bx-plus"></i> New {{ $pageTitle }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mb-2">
            <!-- Import -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <i class='bx bxs-file-import fw-bold mr-10 bx-sm'></i> Import
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                     data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body text-muted">
                        <p class="text-sm"><b>Note:</b> While importing the excel file, Please do not change any of the heading. <b>role</b> column on excel file should be only the <b>vendor or user</b> as per their role. <b>Password</b> by default of the uploaded users will be <b>password</b>.</p>
                        <form action="#" method="post" enctype="multipart/form-data">
                            @csrf
                            <x-input-field :type="'file'" :label="'Choose excel file'" :name="'import_file'" :placeholder="'Please Select Excel File.'"
                                           :required="true" :autofocus="true" />

                            <x-button :title="'Import File'"/>

                            <a class="btn btn-success" href="{{ asset('import_template/User_Import.xlsx') }}">Download Template</a>
                        </form>

                    </div>
                </div>
            </div>
            <!-- Search -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        <i class='bx bx-search-alt fw-bold mr-10 bx-sm'></i> Advanced Search
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                     data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body text-muted">
                        <form class="form-horizontal" method="GET" role="form" autocomplete="off" id="search-form">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="email" class="col-sm-4 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" name="email" id="email">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="name" class="col-sm-4 col-form-label">Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="name" id="name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="username" class="col-sm-4 col-form-label">Username</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="username" id="username">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="phone" class="col-sm-4 col-form-label">Phone</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="phone" id="phone">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-search fa-lg"></i>search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>

        <div class="col-12">
            <div class="card">

                <div class="card-body">

                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>SN.</th>
                                <th>Name</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Phone</th>
                                <th>City</th>
                                <th>Address</th>
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
                    ajax: {
                        url : "{!! route('admin.users.index') !!}",
                        data: function(d) {
                            d.email = $('#email').val();
                            d.name = $('#name').val();
                            d.username = $('#username').val();
                            d.phone = $('#phone').val();
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'username',
                            name: 'username'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'role_id',
                            name: 'role_id'
                        },
                        {
                            data: 'phone',
                            name: 'phone',
                            orderable: false
                        },
                        {
                            data: 'city',
                            name: 'city',
                            orderable: false
                        },
                        {
                            data: 'address',
                            name: 'address',
                            orderable: false
                        },
                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });


                $('#datatable').on('click', '#delete-btn', function(event) {
                    event.preventDefault();
                    event.stopPropagation();
                    var id = $(this).data('id');
                    var delete_url = "{{ route('admin.users.destroy', '') }}/" + id;

                    showConfirmationDialog(delete_url, DTable);
                });

            });
        </script>
    @endpush

</x-cms-master-layout>
