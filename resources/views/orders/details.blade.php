@extends('layouts.app')

@section('content')
<div class="row" align="center">
    <div class="row" >
        <div class="col-lg-12 margin-tb">
            <div class="pull-center">
                <h2>Order # {{$order->id}}</h2>
                <small>On :{{$order->created_at}}</small>

            </div>
            <div class="pull-right">
                <a href="{{ route('home') }}" class="label label-primary pull-right"> Back</a>
            </div>
        </div>
    </div>

    <div class="row" >

         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Product:</strong>
                {{ $order->product->name}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Original Price:</strong>
               R {{ $order->product_price}}
           </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Order Discount:</strong>
               R {{ $order->discount_amount}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Order Amount:</strong>
               R {{ $order->amount_paid}}
            </div>
        </div>
       
    </div>
</div>

@endsection