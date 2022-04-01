<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>


    <table id="customers">
        <tr>
            <td>
                <h2>
                    <?php $image_path = '/common/default-image/defaultCategoryImage.jpg'; ?>
                    <img src="{{ public_path() . $image_path }}" width="200" height="100">

                </h2>
            </td>
            <td>
                <h2>Bakes N Cakes</h2>
                <p>Address</p>
                <p>Phone : 9288282882</p>
                <p>Email : admin@admin.com</p>
                <p> <b>Product Stock Report </b> </p>

            </td>
        </tr>


    </table>
    <hr>
    
    <div class="card-body">

        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
            <thead>
                <tr>
                    <th>SN.</th>
                    <th>Name</th>
                    <th>Info</th>
                    <th>SKU</th>
                    <th>Quantity</th>
                </tr>
            </thead>


            <tbody>


            </tbody>
        </table>

    </div>


     @push('scripts')
    <script>
        function toggleIsStatus(id) {
                let statusEl = $('#is-status-switch-' + id);
                let is_status = statusEl.prop('checked') === true ? 'on' : 'off';

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ route('admin.categories.toggle.status') }}",
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
                    url: "{{ route('admin.categories.toggle.featured') }}",
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
                    url: "{{ route('admin.categories.toggle.menu') }}",
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
                        {data: 'quantity', name: 'quantity', orderable: false},
                      
                    ],
                    "fnDrawCallback": function() {
                        initSwitchToggler();
                    }
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
    
    <br> <br>
    <i style="font-size: 10px; float: right;">Print Data : {{ date("d M Y") }}</i>

    <hr style="border: dashed 2px; width: 95%; color: #000000; margin-bottom: 50px">




</body>

</html>