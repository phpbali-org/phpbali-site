@extends('layouts.verifiedemail')

@section('content')
<div class="container" style="margin-top: 88px;">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-raised">
                <div class="card-header text-center">
                    <h4 class="card-title ">Register</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" class="col-form-label ">Name</label>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                            <label for="email" class=" col-form-label">E-Mail Address</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="password" class="col-form-label">Password</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="password-confirm" class="col-form-label">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="about" class="col-md-8 control-label">About You</label>

                            <div class="col-md-12">
                                <textarea id="about" type="about" class="form-control{{ $errors->has('about') ? ' is-invalid' : '' }}" name="about" required></textarea>

                                @if ($errors->has('about'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('about') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                Have account? <a href="{{ route('login') }}">Login</a>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-info btn-block">
                                    Sign in
                                </button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                OR
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                <a href="{{ route('oauth.github.provider') }}" class="btn btn-info btn-block">Login with Github</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('partials.authsection')
    </div>
</div>
@endsection