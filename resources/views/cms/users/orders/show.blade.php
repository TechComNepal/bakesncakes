<x-site-master-layout :pageTitle="$pageTitle">
    <div class="mb-5">
        <div class="container">

            <div class="row">
                <!--left col-->
                @include('site._layouts._partials.sidebar')

                <div class="col-12 col-md-9 mt-4 ">
                    <div class="panel">
                        <div class="bio-graph-heading">
                            List of {{ $pageTitle }}
                        </div>
                        <div class="panel-body bio-graph-info">
                            <div class="table-responsive" style="border: 1px solid #fbc02d;padding: 15px;">
                                <table id="datatable" class="table table-bordered table-striped nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>SN.</th>
                                            <th>Order Code</th>
                                            <th>Billing Email</th>
                                            <th>Delivery Charge</th>
                                            <th>Biiling Total</th>
                                            <th>Status</th>
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
                    "scrollX": true,

                    responsive: false,
                    ajax: window.location.href,
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
                            data: 'delivery_charge',
                            name: 'delivery_charge'
                        },
                        {
                            data: 'billing_total',
                            name: 'billing_total',
                        },
                        {
                            data: 'status',
                            name: 'status',
                        },
                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false
                        },
                    ],

                });

                $('#datatable').on('click', '#cancel-btn', function(event) {
                    event.preventDefault();
                    event.stopPropagation();
                    var id = $(this).data('id');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3d4144',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, cancel order!',
                        cancelButtonText: 'No',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "GET",
                                dataType: "json",
                                url: "{{ route('user.orders.status.change') }}",
                                data: {
                                    'order_id': id,
                                    'status': 'cancel',
                                },
                                success: function(data) {
                                    Swal.fire(
                                        'Canceled!',
                                        'Your record has been canceled.',
                                        'success'
                                    ).then(() => {
                                        $('#datatable').DataTable().ajax.reload();
                                    })
                                },
                                error: function(result) {
                                    console.log(result.success)
                                    Swal.fire(
                                        'Error!',
                                        'Some Problem Occured. Please Try again later.',
                                        'error'
                                    ).then(() => {
                                        location.reload();
                                    })
                                }
                            })
                        } else {
                            Swal.fire("Cancelled", "Cancellation Denied", "error");
                        }
                    })
                });

            });
        </script>
    @endpush

</x-site-master-layout>
