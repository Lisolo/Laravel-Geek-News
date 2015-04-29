@extends('app')

@section('head')
    <link href="{{ asset('/css/home.css') }}" rel="stylesheet">
@stop

@section('content')
    @for ($i = 0; $i < 3; $i++)
        <div class="row clearfix">
            <div class="col-md-2 col-md-offset-2">
                <h4>{{ $i+1 }}. <a href="user/{{ $userProfiles[$i]->user->id }}">{{ $userProfiles[$i]->user->name }}</a></h4>
            </div>
            <div class="col-md-2">
                <h4>{{ $userProfiles[$i]->submissions }}</h4>
            </div>
        </div>
    @endfor
@endsection