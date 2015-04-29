@extends('app')

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h2><small>Reply Comment</small></h2>
    </div>
</div>
<div class="row">
    <div class="col-md-8"> 
        {{ $comment->content }}
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <img src="/upload/picture/{{ $comment->user->userprofile->picture }}" class="author-thumb img-responsive img-circle"> 
        <a href="user/{{ $comment->user->id }}">{{ $comment->user->name }}</a> {{ $comment->interval }} ago
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
		<form role="form" method="post" action="/handle-reply-comment/{{ $blogid }}/{{ $comment->id }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <textarea name="content" class="form-control" rows="3" placeholder="Say something"></textarea>
            </div>
            <div class="form-group col-md-offset-11">
        	   <button type="submit" class="btn btn-primary">reply</button>
        	</div>
        </form>
    </div>
</div>
@endsection