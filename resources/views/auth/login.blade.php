<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Geek News</title>

    <link href="{{ asset('/css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="cont">
    <div class="demo">
    <div class="login">
        <div class="login__check"></div>
        <div class="login__form">
        @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                    <strong><h4 class="login__signup">{{ $error }}</h4></strong>
                @endforeach
            </ul>
                
        @endif
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
             
        <div class="login__row">
            <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
            </svg>
            <input name="email" type="text" class="login__input name" value="{{ old('email') }}" placeholder="Username"/>
        </div>
        <div class="login__row">
            <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
            </svg>
            <input name="password" type="password" class="login__input pass" placeholder="Password"/>
        </div>

        <button type="submit" class="login__submit">Sign in</button>
        <p class="login__signup"><a href="{{ url('/password/email') }}">Forgot Your Password?</a></p>
        <p class="login__signup">Don't have an account? &nbsp;<a>Sign up</a></p>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="/js/jquery.min.js"></script>
<script src="/js/login.js"></script>
</body>
</html>