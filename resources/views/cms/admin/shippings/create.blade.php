<x-cms-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="3" :method="'Create'" />

    <x-error />

    <x-form-base :route="'admin.shippings.store'" :title="$pageTitle" :subTitle="$subTitle">

        <!-- Name -->
        <x-input-field :label="'Shipping Address'" :name="'shipping_address'"
            :placeholder="'Please enter shipping address here.'" :col="6" :required="true" :autofocus="true" />

        <!-- Delivery Charge -->

        <x-input-field :type="'number'" :label="'Delivery Charge'" :name="'delivery_charge'" :placeholder="''" :col="6"
            :min="0" :value="0" />


        <div>
            <x-button />
        </div>

    </x-form-base>

</x-cms-master-layout>
