{{-- <x-cms-employee-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="2" />

    <div class="row">
        <div class="col-12">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center">
                    <h4 class="card-title">List of {{ $pageTitle }}</h4>
                    <div class="ms-auto">
                        <div>

                        </div>
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
                                    <label for="name" class="col-sm-4 col-form-label">Product Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="name" id="name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="brand" class="col-sm-4 col-form-label">Brand</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="brand" id="brand">
                                            <option value="">Select Brand</option>
                                            @foreach (\App\Models\Brand::pluck('name') as $brand)
                                                <option value="{{ $brand }}">{{ $brand }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-success"><i
                                                class="fa fa-search fa-lg"></i>
                                            search</button>
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

                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                        <tr>
                            <th>SN.</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Quantity</th>
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
                    scrollX: true,

                    responsive: false,
                    ajax: {
                        url: "{!! route('employee.report.product.stock') !!}",
                        data: function(d) {
                            d.name = $('#name').val();
                            d.brand = $('#brand').val();
                        }

                    },
                    columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                        {
                            data: 'image',
                            name: 'image',
                            searchable: false,
                            orderable: false
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'brand_id',
                            name: 'brand_id'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'quantity',
                            name: 'quantity'
                        },

                    ],
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-download "></i> Excel',
                        className: "btn btn-default btn-sm",
                        exportOptions: {
                            columns: [0, 2, 3, 4, 5],

                        },
                        action: newexportaction,

                    }],


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
                                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt,
                                        button, config) :
                                    $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt,
                                        button, config);
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


</x-cms-employee-master-layout> --}}
