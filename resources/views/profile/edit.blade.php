@extends('layouts.app')

@section('content')
    <div class="page-header " filter-color="orange">
        <div class="page-header-image" data-parallax="true" style="background-image: url(&quot;../img/bg3.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
        </div>
        <div class="main-profile">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card card-raised">
                            <div class="card-header text-center">
                                <h4 class="card-title ">Register</h4>
                            </div>
                
                            <div class="card-body">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="name" class="text-black col-form-label ">Name</label>
                                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>
                
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                        <label for="email" class=" text-black col-form-label">E-Mail Address</label>
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>
                
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="password" class="text-black col-form-label">Website</label>
                                            <input id="website" type="website" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}"  value="{{ $user->website }}" name="website" >
                
                                            @if ($errors->has('website'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('website') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="password-confirm" class="text-black col-form-label">About</label>
                                            <textarea name="about" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" id="" cols="30" rows="10">{{ $user->about }}</textarea>

                                            @if ($errors->has('about'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('about') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                            <span></span>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <button type="submit" class="btn btn-info btn-block">
                                                Update!
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-8">
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                            <div class="fileinput-new thumbnail img-raised">
                                <img src="/img/avatar/{{$user->photos}}" alt="...">
                            </div>
                            <div class="row">
                                <form method="post" action="" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="file" name="photos" class="col-md-12" required accept="image/*">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection