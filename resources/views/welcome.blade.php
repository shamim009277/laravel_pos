@extends('layouts.app')
@section('title','Inventory Management System')
@section('content')

<div class="vertical-align-wrap">
    <div class="vertical-align-middle">
        <div class="auth-box ">
            <div class="left">
                <div class="content">
                    <div class="header">
                        <div class="logo text-center">
                            <h2>Inventory</h2>
                        </div>
                        <p class="lead">Login to your account</p>
                    </div>
                    <form class="form-auth-small" action="{{route('login')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="signin-email" class="control-label sr-only">Email</label>
                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Your Email">

                                @error('email')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signin-password" class="control-label sr-only">Password</label>
                        <div class="">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter Your Password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        </div>

                        <div class="form-group clearfix">
                            <label class="fancy-checkbox element-left">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span>Remember me</span>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-md btn-block">LOGIN</button>

                        <h4>---OR LOGIN WITH---</h4>
                        <ul class="list-inline social-icons">
                            <li><a href="{{route('facebook.login')}}" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{route('google.login')}}" class="google-plus-bg"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="{{route('github.login')}}" class="github-bg"><i class="fa fa-github"></i></a></li>
                        </ul>



                        <div class="bottom">
                            @if (Route::has('password.request'))
                                <span class="helper-text"><i class="fa fa-lock"></i> <a href="{{ route('password.request') }}"> Forgot password?</a></span></br>
                            @endif

                            @if (Route::has('register'))
                                <span class="helper-text"><i class="fa fa-user"></i> <a href="{{route('register')}}"> Create new user</a></span>
                            @endif
                             
                        </div>
                    </form>
                </div>
            </div>
            <div class="right">
                <div class="overlay"></div>
                <div class="content text">
                    <h1 class="heading">Inventory Manage System</h1>
                    <p>by The Develovers</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
