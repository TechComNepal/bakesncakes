<x-cms-master-layout :pageTitle="$pageTitle">
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
                        <div class="ms-auto">
                            <div>
                                <a href="" type="button"
                                    class="btn btn-primary btn-md">
                                    <i class='bx bx-printer'></i> Print 
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

                        buttons: ['excel', 'pdf'],

                    processing: true,
                    serverSide: true,

                    responsive: false,
                    ajax: window.location.href,
                    
                    
                    columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex' 
                    },
                        {data: 'name', name: 'name'},
                        {data: 'sku', name: 'sku'},
                        {data: 'selling_price', name: 'selling_price'},
                        {data: 'discount', name: 'discount'},
                        {data: 'quantity', name: 'quantity', orderable: false},
                    ],
                  
                });


                $('#datatable').on('click', '#delete-btn', function(event) {
                    event.preventDefault();
                    event.stopPropagation();
                    var id = $(this).data('id');
                    var delete_url = "{{ route('admin.products.destroy', '') }}/" + id;

                    showConfirmationDialog(delete_url, DTable);
                });
            });
    </script>

    @endpush

</x-cms-master-layout>