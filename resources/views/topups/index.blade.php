@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        @if(Session::has('success_msg'))
        <div class="alert alert-success">{{ Session::get('success_msg') }}</div>
        @endif
    <!-- topups list -->

    @if(!empty($topups))
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Account History </h2>
                </div>
                
            </div>
        </div>

        <div class="panel-heading">
            Current Account Balance:{{$balance}}
            <a href="{{ route('topups.create') }}" class="label label-primary pull-right">New Topup</a>
            <a href="{{ route('home') }}" class="label label-primary pull-right">Back</a>

        </div>

       
        <table class="table">
            <tr>
                <th>Date</th>
                <th>Amount</th>
            </tr>
           @foreach($topups as $topup)
           <tr>
                <td>{{$topup->created_at}}</td>
                <td>{{$topup->amount}}</td>
            </tr>
            
             @endforeach
        </table>

        @else
        <strong>No topups found!</strong>

    @endif
    
    </div>

</div>
@endsection