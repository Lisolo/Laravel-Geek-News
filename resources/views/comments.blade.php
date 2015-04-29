@extends('app')

@section('content')
    <div class="row">
    	<div class="col-md-6 col-md-offset-3">
    		<h2><small>Comments</small></h2>
    	</div>
    </div>
	@foreach ($comments as $comment)
		<div class="row">
		    <div class="col-md-8">
		        <h5>
		            <button id ="{{ $comment->id}}" type="button"
		                @if ($comment->vote)
		                    class="vote-comment btn btn-primary btn-xs" vote="true"
                        @else
                            class="vote-comment btn btn-default btn-xs" vote="false"
                        @endif>
                    <span class="glyphicon glyphicon-thumbs-up"></span></button>
                    <b id="comment-points-{{ $comment->id }}">{{ $comment->points }}</b> points 
		            {{ $comment->content }}
		        </h5>
		    </div>
		</div>
		<div class="row">
		    <div class="col-md-8">
		        <img src="/upload/picture/{{ $comment->user->userprofile->picture }}" class="author-thumb img-responsive img-circle">
		        <a href="user/{{ $comment->user->id }}">{{ $comment->user->name }}</a>
		        @if ($comment->comment)
		            reply
		            <a href="user/{{ $comment->comment->user->id }}">{{ $comment->comment->user->name }}</a>
		        @endif
		        {{ $comment->interval }}
		        <a href="/reply-comment/{{ $id }}/{{ $comment->id }}">reply</a>
		    </div>
		</div>
    @endforeach
    @if (Auth::check())
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
		    <form role="form" method="post" action="/handle-comment/{{ $id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
        	    <div class="form-group">
        	        <textarea name="content" class="form-control" rows="3" placeholder="Say something"></textarea>
        	    </div>
        	    <div class="form-group col-md-offset-9">
        	        <button type="submit" class="btn btn-primary">add a comment</button>
                </div>
            </form>
        </div>
    </div>
    @endif       
@endsection
