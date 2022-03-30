<x-cms-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="3" :method="'Edit'" />

    <x-error />

    <x-form-base :route="'admin.shippings.update'" :requiredParam="$shipping" :title="$pageTitle" :subTitle="$subTitle"
        :method="'PUT'">

        <!-- Name -->
        <x-input-field :label="'Shipping Address'" :name="'shipping_address'"
            :placeholder="'Please enter shipping address here.'" :col="6" :required="true" :autofocus="true"
            :value="$shipping->shipping_address" />

        <!-- Delivery Charge -->

        <x-input-field :type="'number'" :label="'Delivery Charge'" :name="'delivery_charge'" :col="6" :required="true"
            :min="0" :value="$shipping->delivery_charge" />

        <div class="form-group">
            <x-button />
        </div>

    </x-form-base>
</x-cms-master-layout>
