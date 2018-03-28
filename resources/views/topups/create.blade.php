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
                Top Up Account <a href="{{ route('topups.index') }}" class="label label-primary pull-right">Back</a>
            </div>
            <div class="panel-body">
                <form action="{{ route('topups.store') }}" method="Post" class="form-horizontal">
                    {{ csrf_field() }}
               
                     <div class="form-group">
                        <label class="control-label col-sm-2" >Topup Amount(Rands)</label>
                        <div class="col-sm-10">
                            <input type="number" min="1" max="10000000"  step="any" name="amount"   id="amount"   class="form-control" >
                        </div>
                    </div>
    
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-default" value="TopUp" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
