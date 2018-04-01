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
                Add a New product <a href="{{ route('admin') }}" class="label label-primary pull-right">Back</a>
            </div>
            <div class="panel-body">
                <form action="{{ route('products.store') }}" method="Post" enctype='multipart/form-data' class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-sm-2" >Product Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" >Category</label>
                        <div class="col-sm-10">
                            <select name='category' id='category' class='form-control'>
                                <option>Accessories</option>
                                <option>Tops</option>
                                <option>Skirts</option>
                                <option>Shoes</option>
                                <option>Dresses</option>
                                <option>Other</option>
                            </select>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-sm-2" >Price/(Rands)</label>
                        <div class="col-sm-10">
                            <input type="number" name="price" id="price" min='0' max='10000'  step='any' class="form-control">
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-sm-2" >Stock Available</label>
                        <div class="col-sm-10">
                            <input type="number" name="stocklevel" id="stocklevel" min='1' max='10000'  step='any' class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2" >Photo</label>
                        <div class="col-sm-10">
                            <input type="file" name="product_image" id="product_image" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-default" value="Add product" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
