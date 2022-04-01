<x-cms-employee-master-layout>

    <x-breadcrumb :title="$pageTitle" :item="2" :method="''" />
    <x-error />
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-wrap align-items-center">
                        <h4 class="card-title">List of {{ $pageTitle }}</h4>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mb-2">
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
                                    <label for="order_code" class="col-sm-4 col-form-label">Order Code</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="order_code" id="order_code">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="username" class="col-sm-4 col-form-label">Username</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="username" id="username">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="order_status" class="col-sm-4 col-form-label">Order Status</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="order_status" id="order_status">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="billing_email" class="col-sm-4 col-form-label">Billing Email</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="billing_email"
                                            id="billing_email">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="categories" class="col-sm-4 col-form-label">From Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control datepicker-basic" name="from_date"
                                            id="from_date">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="vendor" class="col-sm-4 col-form-label">To Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control datepicker-basic" name="to_date"
                                            id="to_date">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-success"><i
                                                class="fa fa-search fa-lg"></i>search</button>
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
                                <th>Order Code</th>
                                <th>User Name</th>
                                <th>Billing Email</th>
                                <th>Delivery Charge</th>
                                <th>Payment Method</th>
                                <th> Status</th>
                                <th>Billing Total</th>
                                <th>Action</th>
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
                        url: "{!! route('employee.orders.index') !!}",
                        data: function(d) {
                            d.order_code = $('#order_code').val();
                            d.username = $('#username').val();
                            d.order_status = $('#order_status').val();
                            d.billing_email = $('#billing_email').val();
                            d.from_date = $('#from_date').val();
                            d.to_date = $('#to_date').val();
                        },
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'order_code',
                            name: 'order_code'
                        },
                        {
                            data: 'user_id',
                            name: 'user_id'
                        },
                        {
                            data: 'billing_email',
                            name: 'billing_email'
                        },

                        {
                            data: 'delivery_charge',
                            name: 'delivery_charge',

                        },
                        {
                            data: 'payment_method',
                            name: 'payment_method',

                        },

                        {
                            data: 'status',
                            name: 'status',

                        },
                        {
                            data: 'billing_total',
                            name: 'billing_total',

                        },
                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });


                $('#search-form').on('submit', function(e) {
                    DTable.draw();
                    e.preventDefault();
                });

            });
        </script>
    @endpush

</x-cms-employee-master-layout>
