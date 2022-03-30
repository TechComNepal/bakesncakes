<x-cms-employee-master-layout :pageTitle="'Dashboard'">
    <x-breadcrumb :title="$pageTitle" :method="''" />


    <div class="row">
        <div class="col-xl-4 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Brand</span>
                            <h4 class="mb-3">
                                <span class="counter-value"
                                    data-target="{{ $total_brand }}">{{ $total_brand }}</span>
                            </h4>
                        </div>
                    </div>
                    <div class="text-nowrap">
                        <span class="ms-1 text-muted font-size-13">Since last month</span>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-4 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Category</span>
                            <h4 class="mb-3">
                                <span class="counter-value"
                                    data-target="{{ $total_category }}">{{ $total_category }}</span>
                            </h4>
                        </div>
                    </div>
                    <div class="text-nowrap">
                        <span class="ms-1 text-muted font-size-13">Since last month</span>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col-->

        <div class="col-xl-4 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Product</span>
                            <h4 class="mb-3">
                                <span class="counter-value"
                                    data-target="{{ $total_product }}">{{ $total_product }}</span>
                            </h4>
                        </div>
                    </div>
                    <div class="text-nowrap">
                        <span class="ms-1 text-muted font-size-13">Since last month</span>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-4 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Products In Cart</span>
                            <h4 class="mb-3">
                                <span class="counter-value"
                                    data-target="{{ $total_cart }}">{{ $total_cart }}</span>
                            </h4>
                        </div>
                    </div>
                    <div class="text-nowrap">
                        <span class="ms-1 text-muted font-size-13">Since last month</span>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-4 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Order</span>
                            <h4 class="mb-3">
                                <span class="counter-value"
                                    data-target="{{ $total_order }}">{{ $total_order }}</span>
                            </h4>
                        </div>
                    </div>
                    <div class="text-nowrap">
                        <span class="ms-1 text-muted font-size-13">Since last month</span>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->


    </div><!-- end row-->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order table</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Order Code</th>
                                    <th>User Name</th>
                                    <th>Billing Email</th>
                                    <th>Delivery Charge</th>
                                    <th>Payment Method</th>
                                    <th> Status</th>
                                    <th>Billing Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td>{{ $order->order_code }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->billing_email }}</td>
                                        <td>{{ $order->delivery_charge }}</td>
                                        <td>{{ $order->payment_method }}</td>
                                        <td>{{ $order->status == 'cancel' ? 'Cancelled' : ucfirst($order->status) }}
                                        </td>
                                        <td>Rs. {{ $order->billing_total }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <p class="text-center">There are no orders</p>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div><!-- end row -->
</x-cms-employee-master-layout>
