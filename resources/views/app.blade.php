<?php
use DebugBar\StandardDebugBar;

$debugbar = new StandardDebugBar();
$debugbarRenderer = $debugbar->getJavascriptRenderer();

$debugbar["messages"]->addMessage("hello world!");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Geek News</title>

	<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
	@yield('head')

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    
	<?php echo $debugbarRenderer->renderHead() ?>
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/') }}">Geek News</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<form class="navbar-form navbar-left" role="search">
				    <div class="form-group">
					    <input type="search" class="form-control" id="search" placeholder="Search for...">
					    <div class="result">
                            <ul class="nav nav-list">
                            </ul>
					    </div>
				    </div>
				</form>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">New</a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/leaders') }}">Leaders</a></li>
				</ul>
				<ul class="nav navbar-nav">
				    @if (Auth::check())
					    <li><a href="{{ url('/submit-news') }}">Submit</a></li>
					@endif
				</ul>
				<ul class="nav navbar-nav navbar-right">
				@if (Auth::guest())
					<li><a href="{{ url('/auth/login') }}">Login</a></li>
					<li><a href="{{ url('/auth/register') }}">Register</a></li>
				@else
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
	                        <li><a href="/user/{{ Auth::user()->id }}">Userprofile</a></li>
					        <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
					    </ul>
					</li>
				@endif
				</ul>
			</div>
		</div>
	</nav>
    <div class="container-fluid">
	    <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="container">
	                @yield('content')
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Scripts -->
	<script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/jquery-ui.min.js"></script>
	<script src="/js/jquery.tagsinput.min.js"></script>
	<script src="/js/geek-news-ajax.js"></script>
	<?php echo $debugbarRenderer->render() ?>
</body>
<footer>
	<nav class="navbar-fixed-bottom">
        <div class="container">
            <p align="center">&copy; 2015 <a href="https://github.com/Lisolo">Solo</a> Inc.</p>
        </div>
    </nav>
</footer>
</html>
