@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Orders') }}</div>

                    <div class="card-body">
                        <div class="container">
                            @if($orders)
                            <table class="dcf-table dcf-table-responsive dcf-table-bordered dcf-table-striped dcf-w-100%">
                                <thead class="">
                                    <tr>
                                        <th scope="col" class="col-xs-4">Id</th>
                                        <th scope="col" class="col-xs-3">Date</th>
                                        <th scope="col" class="col-xs-2">Value</th>
                                        <th scope="col" class="col-xs-2">Payment</th>
                                        <th scope="col" class="col-xs-2">Invoice</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->_id }}</td>
                                        <td>{{ $order->date }}</td>
                                        <td>£ {{ $order->price }}</td>
                                        <td>{{ $order->info }}</td>
                                        <td><a href="{{ route('getInvoice', ['orderId' => $order->_id]) }}"><button class="btn"><i class="fa fa-download"></i> {{ $order->button }}</button></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                                <h2>No orders to show</h2>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<style>
    /* Style buttons */
    .btn {
    background-color: DodgerBlue;
    border: none;
    color: white;
    padding: 12px 30px;
    cursor: pointer;
    font-size: 20px;
    }

    /* Darker background on mouse-over */
    .btn:hover {
    background-color: RoyalBlue;
    }
</style>

