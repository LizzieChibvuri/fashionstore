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
                Edit order <a href="{{ route('orders.index') }}" class="label label-primary pull-right">Back</a>
            </div>
            <div class="panel-body">
                <form action="{{ route('orders.update', $order->id) }}" method="Post" enctype="multipart/form-data" class="form-horizontal">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                       <div class="form-group">
                        <label class="control-label col-sm-2" >order Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" id="name" class="form-control" value="{{$order->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" >Category</label>
                        <div class="col-sm-10">
                            <select name='category' id='category'  selected="{{$order->category}}" class='form-control'>
                                <option>Accessories</option>
                                <option>Tops</option>
                                <option>Skirts</option>
                                <option>Shoes</option>
                                <option>Dresses<option>
                                <option>Other<option>
                            </select>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-sm-2" >Price/(Rands)</label>
                        <div class="col-sm-10">
                            <input type="number" name="price" id="price" min='0' max='10000'  step='any' value="{{$order->price}}" class="form-control">
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-sm-2" >Stock Available</label>
                        <div class="col-sm-10">
                            <input type="number" name="stocklevel" id="stocklevel" min='1' max='10000' value="{{$order->stocklevel}}" step='any' class="form-control">
                        </div>
                    </div>

                      <div class="form-group">
                        <label class="control-label col-sm-2" >order Image</label>
                        <div class="col-sm-10">
                            <img style="width:200px;height:200px;" src="/storage/order_photos/{{$order->order_image}}"><br/>
                        </div>
                    </div>
                     
                    <div class="form-group">
                        <label class="control-label col-sm-2" >Change Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="order_image" id="order_image" class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-default" value="Update order" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
