@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        @if(Session::has('success_msg'))
        <div class="alert alert-success">{{ Session::get('success_msg') }}</div>
        @endif
    <!-- orders list -->
    @if(!empty($orders))
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Orders List </h2>
                </div>
                
            </div>
        </div>

       
        <table class="table">
            <tr>
                <th>Order Number</th>
                <th>Product Item</th>
                <th>Purchased By</th>
                <th>Order Date</th>
                <th>Action</th>
            </tr>
           @foreach($orders as $order)
           <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->product->name}}</td>
                <td>{{$order->user->name}}</td>
                <td>{{$order->created_at}}</td>
                <td><a href="{{ route('orders.show', $order->id) }}">View Details</a></td>
            </tr>
            
             @endforeach
        </table>

    @endif
    </div>
</div>
@endsection