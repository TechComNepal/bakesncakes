<x-cms-master-layout :pageTitle="$pageTitle">

    <x-breadcrumb :title="$pageTitle" :item="2" :method="''" />

    <x-error />

    <x-form-base :route="'admin.setting.qrcode.update'" :title="$pageTitle" :subTitle="$subTitle">

        <!-- Product Info -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>QR Code Information</h4>
                    </div>
                    <div class="card-body">
                        <!-- Company Logo -->
                        @if ($qrcode)
                            <x-file-browser-image :label="'QR Code Image'" :name="'qr_image'"
                                :defaultFile="$qrcode->getFirstOrDefaultMediaUrl('qrimage')" />
                        @else
                            <x-file-browser-image :label="'QR Code Image'" :name="'qr_image'" />
                        @endif

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>QR Code Status</h4>
                    </div>
                    <div class="card-body">
                        <!-- Status -->
                        <x-switch :label="'Status'" :name="'status'" :id="'switch1'"
                            :checked="$qrcode->status ?? FALSE" />

                    </div>
                </div>

            </div>
        </div>


        <x-button />

    </x-form-base>


    <x-file-manager />


</x-cms-master-layout>
