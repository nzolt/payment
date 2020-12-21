@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Shop') }}</div>

                <div class="card-body">
                    @forelse($products as $product)
                    <div class="col-md-4 float-left" style="min-height: 130px">
                        <figure class="card card-product">
                            <figcaption class="info-wrap">
                                <div class="float-right">{{ strtoupper($product->group) }}</div>
                                <h4 class="title" style="min-height: 75px"><a href="{{ route('product.show', $product->_id) }}">{{ $product->name }}</a></h4>
                            </figcaption>
                            <div class="bottom-wrap">
                                <a href="{{ route('cart.addLink', $product->_id) }}" class="btn btn-sm btn-success float-right"><i class="fa fa-cart-arrow-down"></i> Buy Now</a>
                                <div class="price-wrap h5">
                                    @if($product->subscription)
                                        @php $s = '/m'; @endphp
                                    @else
                                        @php $s = ''; @endphp
                                    @endif
                                    <span class="price"> {{ config('settings.currency_symbol').$product->price.$s }} | </span>
                                    <del class="price-old"> {{ config('settings.currency_symbol').$product->price*1.2 }}</del>
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
            </div>
        </div>
    </div>
</div>
@endsection
