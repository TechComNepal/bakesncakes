<x-cms-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="2" />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-wrap align-items-center">
                        <h4 class="card-title">List of {{ $pageTitle }}</h4>
                    </div>
                    <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link px-3 active " data-bs-toggle="tab" href="#overview" role="tab">Custom
                                Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 " data-bs-toggle="tab" href="#security" role="tab">Orders</a>
                        </li>

                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="overview" role="tabpanel">
                        <div class="card-body">


                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>SN.</th>
                                        <th>Email</th>
                                        <th>City</th>
                                        <th>Delivery date</th>

                                        <th>Actions</th>
                                    </tr>
                                </thead>


                                <tbody>


                                </tbody>
                            </table>

                        </div>
                    </div>
                    <!--end tab pane -->

                    <div class="tab-pane " id="security" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">user Orders</h5>
                            </div>
                            <div class="card-body">


                                <table id="order-datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>SN.</th>
                                            <th>Order Code</th>
                                            <th>Billing Email</th>
                                            <th>Payment Method</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>


                                    <tbody>


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!--end tab pane-->

                </div>
                <!-- end col -->



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
                    responsive: false,
                    ajax: window.location.href,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'city',
                            name: 'city'
                        },
                        {
                            data: 'delivery_date',
                            name: 'delivery_date'
                        },

                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false
                        },
                    ],

                });

                var DTable = $("#order-datatable").DataTable({
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
                    ajax: "{{ route('admin.notifications.orders') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'order_code',
                            name: 'order_code'
                        },
                        {
                            data: 'billing_email',
                            name: 'billing_email'
                        },
                        {
                            data: 'payment_method',
                            name: 'payment_method'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },

                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false
                        },
                    ],

                });

                //
                $('#datatable').on('click', '#delete-btn', function(event) {
                    event.preventDefault();
                    event.stopPropagation();
                    var id = $(this).data('id');
                    var delete_url = "{{ route('admin.newsletters.destroy', '') }}/" + id;

                    showConfirmationDialog(delete_url, DTable);
                });
            });
        </script>
    @endpush


</x-cms-master-layout>
