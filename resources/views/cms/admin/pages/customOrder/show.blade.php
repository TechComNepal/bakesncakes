<x-cms-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="2" :method="'Show'" />

    <x-error />

    <x-form-base :route="'admin.orders.update'" :requiredParam="$customOrder" :title="$pageTitle" :subTitle="$subTitle"
                 :method="'PUT'">

        <!-- Custom Order Code -->
        <x-input-field :label="'Order Code'" :name="'order_code'" :col="6" :value="$customOrder->order_code"
                       :readonly="'readonly'" />

        <!-- Billing Email -->
        <x-input-field :label="'Billing Email'" :name="'billing_email'" :col="6" :value="$customOrder->billing_email"
                       :readonly="'readonly'" />

        <!-- Status-->
        {{-- <div class="form-group col-6 mb-3">
            <label for="status">Status <small><code>[Required] </code> </small></label>
            @if ($customOrder->status == 'cancel' || $customOrder->status == 'completed')
                <div class="text-danger mb-2">
                    This order has been {{ $customOrder->status }}
                </div>
            @endif

            @if ($customOrder->status != 'cancel' && $customOrder->status != 'completed')
                <select name="status" class="form-control js-choice @error('type') is-invalid @enderror">
                    <option value="">Select Status </option>

                    <option value="cancel" {{ $customOrder->status == 'cancel' ? 'selected' : '' }}>CANCEL </option>

                    <option value="pending" {{ $customOrder->status == 'pending' ? 'selected' : '' }}>PENDING </option>
                    <option value="inprocess" {{ $customOrder->status == 'inprocess' ? 'selected' : '' }}>INPROCESS
                    </option>
                    <option value="accepted" {{ $customOrder->status == 'accepted' ? 'selected' : '' }}>ACCEPTED </option>
                    <option value="completed" {{ $customOrder->status == 'completed' ? 'selected' : '' }}>COMPLETED
                    </option>
                </select>
                @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            @endif
        </div> --}}

        {{-- <div>
            <x-button />
        </div> --}}

    </x-form-base>

    <div class="invoice-title">
        <div class="d-flex align-items-start">
            <div class="flex-grow-1">
                <div class="mb-4">
                </div>
            </div>

            <div class="flex-shrink-0">
                <div class="mb-4">
                    <h4 class="float-end font-size-16">Order Code: {{ $customOrder->order_code }}</h4>
                </div>
            </div>
        </div>

    </div>

    <hr class="my-4">

    <div class="row">
        <div class="col-sm-6">
            <div>
                <h5 class="font-size-15 mb-3">Order From:</h5>
                <h5 class="font-size-14 mb-2">{{ $customOrder->user->name }}</h5>
                <p class="mb-1">{{ json_decode($customOrder->shipping_address, true)['delivery_address'] }}
                    ( <span class="text-muted">{{ json_decode($customOrder->shipping_address, true)['landmark'] }}
                    </span> )
                </p>
                <p class="mb-1">{{ $customOrder->billing_email }}</p>
                <p class="mb-1">{{ json_decode($customOrder->shipping_address, true)['phone_no'] }}
                </p>
            </div>
        </div>
        <div class="col-sm-6">
            <div>
                <div>
                    <h5 class="font-size-15">Order Date:</h5>
                    <p>{{ \Carbon\Carbon::parse($customOrder->created_at)->isoFormat('Do MMM, YYYY') }}
                    </p>

                    <h5 class="font-size-15">Payment Method:</h5>
                    <p>{{ $customOrder->payment_method }}
                    </p>
                </div>

            </div>
        </div>
    </div>
    <hr>
    <div class="py-2 mt-3">
        <h5 class="font-size-15">Product Details</h5>
    </div>

    <div class="p-4 border rounded">
        <div class="table-responsive">
            <table class="table table-nowrap align-middle mb-0">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th class="text-end" style="width: 120px;">Price</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $total_tax = 0;
                @endphp
                @forelse ($customOrder->products as $key => $product)
                    @php
                        $total_tax = $total_tax + $product->pivot->tax * $product->pivot->quantity;
                    @endphp

                    <tr>
                        <td>{{ $key + 1 }} </td>
                        <td>{{ $product->name }} </td>
                        <td>{{ $product->brand->name }} </td>
                        <td>{{ $product->pivot->price }} </td>
                        <td>{{ $product->pivot->quantity }} </td>
                        <td class="text-end">
                            {{ $product->pivot->total - $product->pivot->tax * $product->pivot->quantity }} </td>


                    </tr>
                @empty
                    <tr>
                        <td><span>No Order Found </span> </td>
                    </tr>

                @endforelse
                <tr>
                    <th scope="row" colspan="5" class="text-end">Sub Total</th>
                    <td class="text-end">Rs.
                        {{ $customOrder->billing_total - $customOrder->delivery_charge - $total_tax + $customOrder->coupon_discount }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" colspan="5" class="text-end">Discount Amount</th>
                    <td class="text-end">Rs.
                        {{ $customOrder->coupon_discount }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" colspan="5" class="text-end">Subtotal after discount</th>
                    <td class="text-end">Rs.
                        {{ $customOrder->billing_total - $customOrder->delivery_charge - $total_tax }}
                    </td>
                </tr>
                <tr>
                    <th scope="row" colspan="5" class="text-end"> Total Tax</th>
                    <td class="text-end">Rs {{ $total_tax }} </td>
                </tr>
                <tr>
                    <th scope="row" colspan="5" class="text-end">Shipping Charge</th>
                    <td class="text-end">Rs {{ $customOrder->delivery_charge }} </td>
                </tr>

                <tr>
                    <th scope="row" colspan="5" class="border-0 text-end">Total</th>
                    <td class="border-0 text-end">
                        <h4 class="m-0">Rs {{ $customOrder->billing_total }}</h4>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>





</x-cms-master-layout>
