<x-vendor-master-layout :pageTitle="$pageTitle">
    @push('stylesheet')
        <style>
            .dt-buttons {
                display: none;
            }

            .pull-left ul {
                list-style: none;
                margin: 0;
                padding-left: 0;
            }

            .pull-left a {
                text-decoration: none;
                color: #ffffff;
            }

            .pull-left li {
                color: #ffffff;
                background-color: #2f2f2f;
                border-color: #2f2f2f;
                display: block;
                float: left;
                position: relative;
                text-decoration: none;
                transition-duration: 0.5s;
                padding: 12px 30px;
                font-size: .75rem;
                font-weight: 400;
                line-height: 1.428571;
            }

            .pull-left li:hover {
                cursor: pointer;
            }

            .pull-left ul li ul {
                visibility: hidden;
                opacity: 0;
                min-width: 9.2rem;
                position: absolute;
                transition: all 0.5s ease;
                margin-top: 8px;
                left: 0;
                display: none;
            }

            .pull-left ul li:hover>ul,
            .pull-left ul li ul:hover {
                visibility: visible;
                opacity: 1;
                display: block;
            }

            .pull-left ul li ul li {
                clear: both;
                width: 100%;
                color: #ffffff;
            }

            .ul-dropdown {
                margin: 0.3125rem 1px !important;
                outline: 0;
            }

            .firstli {
                border-radius: 0.2rem;
            }

            .firstli .material-icons {
                position: relative;
                display: inline-block;
                top: 0;
                margin-top: -1.1em;
                margin-bottom: -1em;
                font-size: 0.8rem;
                vertical-align: middle;
                margin-right: 5px;
            }

        </style>
    @endpush
    <x-breadcrumb :title="$pageTitle" :item="1" :method="'List Of'" />
    <x-error />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-wrap align-items-center">
                        <h4 class="card-title">List of {{ $pageTitle }}</h4>

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
                                            <label for="username" class="col-sm-4 col-form-label">SKU</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="sku" id="sku">
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
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Selling Price</th>
                                <th>Discount</th>
                                <th>In Stock</th>
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
            $("ul li ul li").click(function() {
                var i = $(this).index() + 1
                var table = $('#quiztable').DataTable();
                if (i == 1) {
                    table.button('.buttons-csv').trigger();
                } else if (i == 2) {
                    table.button('.buttons-excel').trigger();
                } else if (i == 3) {
                    table.button('.buttons-pdf').trigger();
                } else if (i == 4) {
                    table.button('.buttons-print').trigger();
                }
            });
        </script>
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

                    dom: 'Bfrtip',

                    buttons: [{
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-download "></i> Excel',
                            className: "btn btn-success btn-sm",
                            exportOptions: {
                                columns: [0, 2, 3, 4, 5],

                            },
                            action: newexportaction,


                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fa fa-download "></i> PDF',
                            className: "btn btn-danger btn-sm",
                            exportOptions: {
                                columns: [0, 2, 3, 4, 5],

                            },
                            action: newexportaction,
                        },

                        {
                            extend: 'print',
                            text: '<i class="fa fa-print "></i> Print',
                            className: "btn btn-default btn-sm",
                            exportOptions: {
                                columns: [0, 2, 3, 4, 5],

                            },
                            action: newexportaction,
                        }
                    ],

                    processing: true,
                    serverSide: true,

                    responsive: false,
                    ajax: {
                        url: "{!! route('vendor.productStock.view') !!}",
                        data: function(d) {
                            d.name = $('#name').val();
                            d.sku = $('#sku').val();
                        },
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
                            data: 'sku',
                            name: 'sku'
                        },
                        {
                            data: 'selling_price',
                            name: 'selling_price'
                        },
                        {
                            data: 'discount',
                            name: 'discount'
                        },
                        {
                            data: 'quantity',
                            name: 'quantity',
                            orderable: false
                        },
                    ],

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
