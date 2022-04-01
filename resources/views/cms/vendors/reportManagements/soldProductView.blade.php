<x-vendor-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="2" />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-wrap align-items-center">
                        <h4 class="card-title">List of {{ $pageTitle }}</h4>
                        <div class="ms-auto">
                            <div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-2">
                    <!-- Search -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                aria-controls="flush-collapseTwo">
                                <i class='bx bx-search-alt fw-bold mr-10 bx-sm'></i> Advanced Search
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse"
                            aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body text-muted">
                                <form class="form-horizontal" method="GET" role="form" autocomplete="off"
                                    id="search-form">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="name" class="col-sm-4 col-form-label">Product Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="name" id="name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="username" class="col-sm-4 col-form-label">Order Code</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="order_code"
                                                    id="order_code">
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

                <div class="card-body">

                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>SN.</th>
                                <th>Order Code</th>
                                <th>Product Name</th>
                                <th>Order Quantity</th>

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
                    buttons: [{
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-download "></i> Excel',
                            className: "btn btn-success btn-sm",
                            exportOptions: {
                                columns: [0, 1, 2, 3],

                            },
                            action: newexportaction,


                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fa fa-download "></i> PDF',
                            className: "btn btn-danger btn-sm",
                            exportOptions: {
                                columns: [0, 1, 2, 3],

                            },
                            action: newexportaction,
                        },

                        {
                            extend: 'print',
                            text: '<i class="fa fa-print "></i> Print',
                            className: "btn btn-default btn-sm",
                            exportOptions: {
                                columns: [0, 1, 2, 3],

                            },
                            action: newexportaction,
                        }
                    ],
                    ajax: {
                        url: "{!! route('vendor.productSold.view') !!}",
                        data: function(d) {
                            d.name = $('#name').val();
                            d.order_code = $('#order_code').val();
                        },

                    },

                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'order_code',
                            name: 'order_code',
                        },
                        {
                            data: 'name',
                            name: 'name',
                        },
                        {
                            data: 'quantity',
                            name: 'quantity',
                        },

                    ],
                    dom: 'Bfrtip',

                });

                $('#search-form').on('submit', function(e) {
                    DTable.draw();
                    e.preventDefault();
                });


                /* For Export Buttons available inside jquery-datatable "server side processing" - Start */

                function newexportaction(e, dt, button, config) {
                    var self = this;
                    var oldStart = dt.settings()[0]._iDisplayStart;
                    dt.one('preXhr', function(e, s, data) {

                        data.start = 0;
                        data.length = 2147483647;
                        dt.one('preDraw', function(e, settings) {


                            if (button[0].className.indexOf('buttons-excel') >= 0) {
                                $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e,
                                        dt,
                                        button, config) :
                                    $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e,
                                        dt,
                                        button, config);
                            } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                                $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button,
                                        config) :
                                    $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button,
                                        config);
                            } else if (button[0].className.indexOf('buttons-print') >= 0) {
                                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                            }

                            dt.one('preXhr', function(e, s, data) {

                                settings._iDisplayStart = oldStart;
                                data.start = oldStart;
                            });

                            setTimeout(dt.ajax.reload, 0);

                            return false;
                        });
                    });

                    dt.ajax.reload();
                };
                //For Export Buttons available inside jquery-datatable "server side processing" - End

            });
        </script>
    @endpush


</x-vendor-master-layout>
