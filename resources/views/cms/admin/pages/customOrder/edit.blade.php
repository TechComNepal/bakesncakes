<x-cms-master-layout :pageTitle="$pageTitle">
    @push('stylesheet')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif
        }

        body {
            background-color: #7C4135
        }

        #order-heading {
            background-color: #edf4f7;
            position: relative;
            border-top-left-radius: 25px;
            max-width: 800px;
            padding-top: 20px;
            margin: 30px auto 0px
        }

        #order-heading .text-uppercase {
            font-size: 0.9rem;
            color: #777;
            font-weight: 600
        }

        #order-heading .h4 {
            font-weight: 600
        }

        #order-heading .h4+div p {
            font-size: 0.8rem;
            color: #777
        }

        .close {
            padding: 10px 15px;
            background-color: #777;
            border-radius: 50%;
            position: absolute;
            right: -15px;
            top: -20px
        }

        .wrapper {
            padding: 0px 50px 50px;
            max-width: 800px;
            margin: 0px auto 40px;
            border-bottom-left-radius: 25px;
            border-bottom-right-radius: 25px
        }

        .table th {
            border-top: none
        }

        .table thead tr.text-uppercase th {
            font-size: 0.8rem;
            padding-left: 0px;
            padding-right: 0px
        }

        .table tbody tr th,
        .table tbody tr td {
            font-size: 0.9rem;
            padding-left: 0px;
            padding-right: 0px;
            padding-bottom: 5px
        }

        .table-responsive {
            height: 100px
        }

        .list div b {
            font-size: 0.8rem
        }

        .list .order-item {
            font-weight: 600;
            color: #6db3ec
        }

        .list:hover {
            background-color: #f4f4f4;
            cursor: pointer;
            border-radius: 5px
        }

        label {
            margin-bottom: 0;
            padding: 0;
            font-weight: 900
        }

        button.btn {
            font-size: 0.9rem;
            background-color: #66cdaa
        }

        button.btn:hover {
            background-color: #5cb99a
        }

        .price {
            color: #5cb99a;
            font-weight: 700
        }

        p.text-justify {
            font-size: 0.9rem;
            margin: 0
        }

        .row {
            margin: 0px
        }

        .subscriptions {
            border: 1px solid #ddd;
            border-left: 5px solid #ffa500;
            padding: 10px
        }

        .subscriptions div {
            font-size: 0.9rem
        }

        @media(max-width: 425px) {
            .wrapper {
                padding: 20px
            }

            body {
                font-size: 0.85rem
            }

            .subscriptions div {
                padding-left: 5px
            }

            img+label {
                font-size: 0.75rem
            }
        }
    </style>



    <style>
        .bootstrap-tagsinput {
            width: 100%;
        }
    </style>

    @endpush


    <div class="d-flex flex-column justify-content-center align-items-center" id="order-heading">
        <div class="text-uppercase">
            <h3> Custom Order detail </h3>
            <hr>
        </div>

        <div class="h4"> {{ $customOrder->created_at->isoFormat('LL') }}</span></div>

        <div class="pt-1">
            <p>#orderId{{ " "}} {{ $customOrder->id}}<b class="text-dark"> processing</b></p>
        </div>
        <div class="btn close text-white"> &times; </div>
    </div>

    <hr>
    <div class="row border rounded p-1 my-3">

        <div class="row border rounded p-1 my-3">
            <div class="col-md-6 py-3">
                <div class="d-flex flex-column align-items start">
                    <h4> <u> Address Details </u></h4>
                    <p class="text-justify pt-2"><b>Name: </b> {{ $customOrder->name }}
                    <p class="text-justify pt-2"> <b> Email: </b> {{ $customOrder->email }}</p>
                    <p class="text-justify pt-2"> <b> Address:</b> {{ $customOrder->quantity }}</p>
                    <p class="text-justify pt-2"> <b> Address:</b> {{ $customOrder->city }}, {{$customOrder->address }}
                    </p>
                    <p class="text-justify pt-2"> <b> Mobile Number:</b> {{ $customOrder->primary_number }},
                        {{$customOrder->secondary_number }}</p>

                    <div class="d-flex flex-column align-items start"> <b>Shipping Address:</b>
                        {{ $customOrder->city }}, {{$customOrder->address }}
                    </div>
                    <p class="text-justify pt-2"><b>Time to Deliver: {{ $customOrder->dtime}}</b>
                        {{ \Carbon\Carbon::parse($customOrder->date)->isoFormat('LLL') }}

                        <br>




                        <x-form-base :route="'admin.customOrders.update'" :requiredParam="$customOrder"
                            :title="$pageTitle" :method="'PUT'">
                            <!-- Status-->

                            <div class="form-group col-4 mb-4">

                                @if ($customOrder->status == 'cancel' || $customOrder->status == 'completed')
                                <div class="text-danger mb-2">
                                    This order has been {{ $customOrder->status }}
                                </div>
                                @endif

                                @if ($customOrder->status != 'cancel' && $customOrder->status != 'completed')
                                <select name="status"
                                    class="form-control js-choice @error('type') is-invalid @enderror">
                                    <option value="">Select Status </option>

                                    <option value="cancel" {{ $customOrder->status == 'cancel' ? 'selected' : ''
                                        }}>CANCEL
                                    </option>

                                    <option value="pending" {{ $customOrder->status == 'pending' ? 'selected' : ''
                                        }}>PENDING </option>
                                    <option value="inprocess" {{ $customOrder->status == 'inprocess' ? 'selected' : ''
                                        }}>INPROCESS
                                    </option>
                                    <option value="accepted" {{ $customOrder->status == 'accepted' ? 'selected' : ''
                                        }}>ACCEPTED </option>
                                    <option value="completed" {{ $customOrder->status == 'completed' ? 'selected' : ''
                                        }}>COMPLETED
                                    </option>
                                </select>
                                @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @endif
                            </div>
                            <div class="form-group col-3 mb-3">

                                <x-button />
                            </div>

                        </x-form-base>

                </div>
            </div>


            <div class="col-md-6 py-3">
                <p> <b> Custom Cake:</b></p>

                <div class="mx-3" className="flex-center">
                    
                    {{-- <img
                    src="{{ $customOrder->getFirstOrDefaultMediaUrl('image', 'thumb') }}" alt="apple" 
                    width="150" height="150"> --}}
                    @foreach ($gallerys as $gallery)
                    
                    <img src="{{ $gallery->getUrl('thumb') }}" alt="Gallery Image"  style="margin-top: 10px; margin-left: 7px; ">
                       @endforeach
                    </div>
                </div>
        
        <div class="row border rounded p-1 my-3">
            <p class="text-justify pt-2">
            <h4> <b> <u>Description: </u> </b> </h4>{!! $customOrder->description !!} </p>

        </div>


    </div>


</x-cms-master-layout>