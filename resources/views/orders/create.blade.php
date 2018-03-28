@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        @if($errors->any())
            <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach()
            </div>
        @endif
        
        <div class="panel panel-default">
            <div class="panel-heading">
                Buy Product <a href="{{ route('products.index') }}" class="label label-primary pull-right">Cancel Purchase</a>
            </div>
            <div class="panel-body">
                <form action="{{ route('orders.store') }}" method="Post" class="form-horizontal">
                    {{ csrf_field() }}
                       <div class="form-group">
                        <label class="control-label col-sm-2" >Product Name</label>
                        <div class="col-sm-10">
                           <input type="text" name="name" id="name" class="form-control" value="{{$product->name}}"  readonly>
                           <input type="hidden" name="product_id" id="product_id" class="form-control" value="{{$product->id}}" >
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" >Category</label>
                        <div class="col-sm-10">
                            <input type="text" name='category' id='category'  value="{{$product->category}}" class='form-control' readonly>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-sm-2" >Price(Rands)</label>
                        <div class="col-sm-10">
                            <input type="text" name="product_price"   id="product_price"  value="{{$product->price}}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >Discount(%)</label>
                        <div class="col-sm-10">
                            <input type="text" name="discount"  value="{{$product->discount}}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >Discount(Rands)</label>
                        <div class="col-sm-10">
                            <input type="text" name="discount_amount"  id="discount_amount"  value="{{$discountamount}}" class="form-control" readonly>
                        </div>
                    </div>


                     <div class="form-group">
                        <label class="control-label col-sm-2" >Amount Due(Rands)</label>
                        <div class="col-sm-10">
                            <input type="text" name="amount_due"  id="amount_due"  value="{{$amountdue}}" class="form-control" readonly>
                        </div>
                    </div>
    

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-default" value="Confirm Purchase" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
