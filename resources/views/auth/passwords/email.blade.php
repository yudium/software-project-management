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
                            <img src="./demo/brand/tabler.svg" class="h-6" alt="">
                        </div>

                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form method="POST" class="card" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                            @csrf
                            <div class="card-body p-6">
                                <div class="card-title">Forgot password</div>

                                <p class="text-muted">Enter your email address and your password will be reset and
                                    emailed to you.</p>
                                <div class="form-group">
                                    <label class="form-label" for="exampleInputEmail1">Email address</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email" value="{{ old('email') }}" required placeholder="Enter Email">
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif

                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary btn-block">Send me new password</button>
                                </div>
                            </div>
                        </form>
                        <div class="text-center text-muted">
                            Forget it, <a href="./login.html">send me back</a> to the sign in screen.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
