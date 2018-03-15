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
                                        <label for="email" class=" text-black col-form-label">E-Mail Address</label>
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
                                            <label for="password" class="text-black col-form-label">Website</label>
                                            <input id="about" type="about" class="form-control{{ $errors->has('about') ? ' is-invalid' : '' }}" name="about" >
                
                                            @if ($errors->has('about'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('about') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="password-confirm" class="text-black col-form-label">About</label>
                                            <textarea name="about" class="form-control" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                            <span></span>
                                        </div>
                                        <div class="col-md-4 text-md-right">
                                            <button type="submit" class="btn btn-info btn-block">
                                                JOIN!
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
                                <img src="/img/avatar/default-avatar.png" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                            <div>
                                <span class="btn btn-raised btn-round btn-default btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" name="...">
                                </span>
                                <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="now-ui-icons ui-1_simple-remove"></i> Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection