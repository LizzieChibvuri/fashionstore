
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Administration Dashboard</div>
                 @if (!Auth::guest())
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('products.create') }}"> Add Product</a>
                </div>
                @endif

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                      
                        @foreach($products as $product)
                        <tr>
                        <td>
                        <h3> <p><div><a href="{{ route('products.show', $product->id) }}">{{$product->name}}</a></div></p></h3>
                        <img style="width:100px;height:100px;" src="/storage/product_photos/{{$product->product_image}}"><br/>
                        </td>
                        <td>
                        <p>Product Category:{{$product->category}}</p>
                        <p>Product Price:{{$product->price}}</p>
                        <p>Quantity in Stock:{{$product->stocklevel}}</p>
                        </td>
                        <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="label label-warning">Edit</a>
                        <form action="{{action('ProductsController@destroy', $product->id)}}" method="post">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="Delete">
                        <button class="btn btn-danger" type="submit"  onclick="return confirm('Are you sure to delete?')">Delete</button>
                        </form>
                        </td>
                        </tr>
                    
                     @endforeach
                     </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
