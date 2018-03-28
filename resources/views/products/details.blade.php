@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>View Product</h2>
        </div>
        <div class="pull-right">
            <a href="{{ route('products.index') }}" class="label label-primary pull-right"> Back</a>
        </div>
    </div>
</div>

 <img style="width:200px;height:200px;" src="/storage/product_photos/{{$product->product_image}}">
 <br/><br/>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $product->name }}
        </div>
    </div>

     <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Category:</strong>
            {{ $product->category}}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Available Stock:</strong>
            {{ $product->stocklevel}}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Content:</strong>
            {{ $product->price}}
        </div>
    </div>
   
</div>
@endsection