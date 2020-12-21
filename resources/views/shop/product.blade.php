@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Shop') }}</div>

                <div class="card-body">
                    @if($product != null)
                    <div class="col-md-12 float-left" style="min-height: 130px">
                        <figure class="card card-product">
                            <figcaption class="info-wrap">
                                <h4 class="title" style="min-height: 75px">{{ $product->name }}</h4>
                            </figcaption>
                            <div class="">
                                {{ $product->size }}
                            </div>
                            <div class="">
                                <ul class="">
                                    @foreach($product->info as $infoLine)
                                    <li>
                                        {{ $infoLine }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="bottom-wrap">
                                <a href="{{ route('cart.addLink', $product->_id) }}" class="btn btn-sm btn-success float-right"><i class="fa fa-cart-arrow-down"></i> Buy Now</a>
                                <div class="price-wrap h5">
                                    <span class="price"> {{ config('settings.currency_symbol').$product->price }} </span>
                                    <del class="price-old"> {{ config('settings.currency_symbol').$product->price*1.2 }}</del>
                                </div>
                            </div>
                        </figure>
                    </div>
                    @else
                        <div class="alert alert-success" role="alert">
                            No product found with this ID.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
