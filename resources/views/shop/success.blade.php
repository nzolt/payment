@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Checkout successful') }}</div>

                    <div class="card-body">
                        <div class="container">
                            <h2>{{ $title }}</h2>
                            <!--iframe src="{{ route('getInvoice', ['orderId' => $orderId]) }}" width="100%" height="100%"></iframe-->
                            <a href="{{ route('getInvoice', ['orderId' => $orderId]) }}"><button class="btn"><i class="fa fa-download"></i> {{ $button }}</button></a>
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

