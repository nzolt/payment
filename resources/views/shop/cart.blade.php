@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cart') }}
                    <div class="float-right">
                        <a href="{{ route('cart.delete') }}" type="button" class="btn btn-danger" class="btn btn-sm float-right"><i class="fa fa-cart-arrow-down"></i>Empty cart</a>
                    </div>
                </div>

                <div class="card-body">
                    @forelse($products as $product)
                    <div class="col-md-4 float-left" style="min-height: 130px">
                        <figure class="card card-product">
                            <figcaption class="info-wrap">
                                <div class="float-right">{{ strtoupper($product->group) }}</div>
                                <h4 class="title" style="min-height: 75px"><a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a></h4>
                            </figcaption>
                            <figcaption class="info-wrap">
                                <div class="float-right">{{ strtoupper($product->group) }}</div>
                            </figcaption>
                            <div class="bottom-wrap">
                                <div class="btn btn-sm btn-success float-right">
                                    <i class="fa fa-cart-arrow-down"></i>Quantity: {{ $product->quantity }}</div>
                                <div class="price-wrap h5">
                                    @if($product->subscription)
                                        @php $s = '/m'; @endphp
                                    @else
                                        @php $s = ''; @endphp
                                    @endif
                                    <span class="price"> {{ config('settings.currency_symbol').number_format($product->price, 2).$s }} /u </span>
                                    <span class="price"> {{ config('settings.currency_symbol').number_format($product->price*$product->quantity, 2) }}</span>
                                </div>
                            </div>
                        </figure>
                    </div>
                    @empty
                        <div class="alert alert-success" role="alert">
                            No products found.
                        </div>
                    @endforelse
                </div>
                <div class="card-header">{{ __('Total') }}
                    <div class="float-right">{{ config('settings.currency_symbol').number_format($total, 2) }}</div>
                </div>
                @if(count($products) > 0)
                <div class="card-header">{{ __('Checkout') }}
                    <div class="float-right"><a href="{{ route('checkout')}}"type="button" class="btn btn-success">Checkout</a></div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
