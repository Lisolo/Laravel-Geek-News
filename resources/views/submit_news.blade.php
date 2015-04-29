@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2><small>Submit News</small></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
        @if (count($errors) > 0)
            <div class="alert alert-danger"> 
            @foreach ($errors->all() as $error)
                <p class="error text-danger">{{ $error }}</p>
            @endforeach
            </div>
        @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-8"> 
            <form role="form" method="post" action="{{ url('/handle-blog') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
        	    <div class="form-group">
                    <input id="submit-new-title" name="title" class="form-control" type="text" placeholder="Enter title">
        	    </div>
                <div class="form-group">
                    <input id="submit-new-url" name="url" class="form-control" type="text" placeholder="Enter url">
        	    </div>
                <div class="form-group">
                    <input id="add-tags" name="add-tags" type="text" class="form-control">
        	    </div>
                <div class="form-group col-md-offset-11">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>    
    </div>
@endsection