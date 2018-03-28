@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                 @if(Session::has('success_msg'))
                    <div class="alert alert-success">{{ Session::get('success_msg') }}</div>
                @endif
                @if(Session::has('error_msg'))
                        <div class="alert alert-success">{{ Session::get('error_msg') }}</div>
                @endif
                 @if (!Auth::guest())
                <div class="pull-right">
                   
                    <a class="btn btn-success" href="{{ route('topups.index') }}">Manage Account</a>
                    <a class="btn btn-success" href="{{ route('products.index') }}"> Go to Shop</a>
                    </div>
                @endif

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                     @if(!empty($orders))
                        <div class="row">
                            <div class="col-lg-12 margin-tb">
                                <div class="pull-left">
                                    <h2>Purchase History </h2>
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
        </div>
    </div>
</div>
@endsection
