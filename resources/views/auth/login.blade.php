<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />

    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    @include('template.library')
    <style>
        .dropdown-item {
            padding-left: 35px;
        }
        .dropdown-item-title {
            padding-left: 24px;
            font-weight: bold;
            background: rgba(216, 216, 216, 0.2);
        }
        </style>
</head>

<body class="">

    <div class="page">
        <div class="page-single">
            <div class="container">
                <div class="row">
                    <div class="col col-login mx-auto">
                        <div class="text-center mb-6">
                            <img src="{{ asset('demo/logo.svg') }}" class="h-6" alt="">
                        </div>

                        <form class="card" action="{{ route('login') }}" method="post" aria-label="{{ __('Login') }}">
                                @csrf
                            <div class="card-body p-6">
                                <div class="card-title">Login to your account</div>

                                <div class="form-group">
                                    <label class="form-label">{{ __('E-Mail Address') }}</label>
                                    <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" aria-describedby="emailHelp"
                                        placeholder="Enter email" required autofocus >
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                            {{ __('Password') }}
                                        <a href="{{ route('password.request') }}" class="float-right small">I forgot password</a>
                                    </label>
                                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" placeholder="Password" name="password" required>
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="form-group">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                            <span class="custom-control-label">Remember me</span>
                                        </label>
                                    </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary btn-block">   {{ __('Login') }}</button>
                                    <div ><a href="'.route('loginAgent').'">Masuk Sebagai Agent</a></div>
                                </div>
                            </div>
                        </form>

                        <div class="text-center text-muted">
                            Dont have account yet? <a href="{{ route('register') }}">Sign up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>