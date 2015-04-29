@extends('app')

@section('head')
    <link href="{{ asset('/css/home.css') }}" rel="stylesheet">
@stop

@section('content')
    @foreach ($blogs as $blog)
        <div class="row clearfix">
            <div class="col-md-8">
                <h5>
                    <button id ="up-{{ $blog->id }}" blogid="{{ $blog->id }}" type="button" 
                    @if ($blog->voteUp) 
                        class="vote-up btn btn-primary btn-xs" vote-up="true" 
                    @else
                        class="vote-up btn btn-default btn-xs" vote-up="false"
                    @endif>
                    <span class="glyphicon glyphicon-thumbs-up"></span></button>
                    <b id="blog-count-{{ $blog->id }}">{{ $blog->likes - $blog->dislikes }}</b>
                    <button id ="down-{{ $blog->id }}" blogid="{{ $blog->id }}" type="button" 
                    @if ($blog->voteDown) 
                        class="vote-down btn btn-primary btn-xs" vote-down="true" 
                    @else
                        class="vote-down btn btn-default btn-xs" vote-down="false"
                    @endif>
                    <span class="glyphicon glyphicon-thumbs-down"></span></button>
                    <a href="goto/{{ $blog->id }}" id="{{ $blog->id }}" target="_blank">{{ $blog->title }}</a>  tag 
                    @foreach ($blog->tags as $tag)
                        <a href="/tag/{{ $tag->id }}"><span class="label label-info">{{ $tag->name }}</span></a>
                    @endforeach
                </h5>   
            </div>  
        </div>    
        <div class="row clearfix">
            <div class="col-md-8">
                <img src="/upload/picture/{{ $blog->user->userprofile->picture }}" class="author-thumb img-responsive img-circle">
                <a href="user/{{ $blog->submitter_id }}">{{ $blog->user->name }}</a> {{ $blog->interval }}
                @if (count($blog->comments))
                    <a href="news/{{ $blog->id }}/comments">{{ count($blog->comments) }} comments</a>
                @else
                    <a href="news/{{ $blog->id }}/comments">discuss</a>
                @endif
            </div>
        </div>
    @endforeach
    <?php echo $blogs->render(); ?>
@endsection
