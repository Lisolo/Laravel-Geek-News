@extends('app')

@section('content')
<div class="container">
	<div class="row clearfix">
		<div class="col-md-2">
            <img src="/upload/picture/{{ $user->userprofile->picture }}" class="img-responsive img-circle">
        </div>

        <div class="col-md-5">
            <div class="row">
               <h5>Email     {{ $user->email }}</h5>
            </div>
            <div class="row">
                <h5>Profile views {{ $user->userProfile->views }}</h5>
            </div>
        </div>
        
    </div>
    <div class="row clearfix">
        <div class="col-md-2">
        @if (Auth::check())
            <button id="change-picture" type="button" class="btn btn-link">change picture</button>
        @endif
        </div>
    </div> 
    <div class="row clearfix">
        <div class="col-md-3">
            <h2><small>Submissions</small></h2>
        </div> 
    </div>
    @foreach ($user->blogs as $blog)
    <div class="row clearfix">
        <a href="{{ $blog->url }}">{{ $blog->title }}</a>
    </div>
    @endforeach
</div>
<div id="dialog-form" title="Change your picture">
    <p class="validateTips">Add Image.</p>
    <form role="form" method="post" enctype="multipart/form-data" action="/upload/{{ $user->id }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <fieldset>
            <input name="picture" type="file">
            <button type="submit" class="btn btn-primary">Submit</button>
        </fieldset>
    </form>
</div>
@endsection
 