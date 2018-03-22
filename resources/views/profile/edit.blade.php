@extends('layouts.app')

@section('content')
    <div class="page-header " filter-color="orange">
        <div class="page-header-image" data-parallax="true" style="background-image: url(&quot;../img/bg3.jpg&quot;); transform: translate3d(0px, 0px, 0px);">
        </div>
        <div class="main-profile">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto col-xl-6 mr-auto">
                        <!-- Nav tabs -->
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs justify-content-center" role="tablist">
                                  <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="tab" href="#profile" role="tab" aria-selected="false">
                                        <i class="now-ui-icons shopping_cart-simple"></i>
                                        Profile
                                    </a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#settings" role="tab" aria-selected="true">
                                        <i class="now-ui-icons ui-2_settings-90"></i>
                                        Settings
                                    </a>
                                  </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <!-- Tab panes -->
                                <div class="tab-content ">
                                    <div class="tab-pane active show" id="profile" role="tabpanel">
                                        <div class="col-md-12">
                                            <div class="card card-plain">
                                                <div class="card-header text-center">
                                                    <h4 class="card-title ">Register</h4>
                                                </div>
                                    
                                                <div class="card-body">
                                                    <form method="POST" action="{{ url('/update') }} ">
                                                        @csrf
                                                        <div class="form-group row">
                                                            <label for="name" class="text-black col-md-4 col-form-label ">Name</label>
                                                            
                                                            <input id="name" type="text" class="col-md-8 form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus />
                                    
                                                                @if ($errors->has('name'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('name') }}</strong>
                                                                    </span>
                                                                @endif
                                                            
                                                        </div>
                                    
                                                        <div class="form-group row">
                                                            <label for="email" class=" text-black col-md-4 col-form-label">E-Mail Address</label>
                                                                <input id="email" type="email" class="col-md-8 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>
                                    
                                                                @if ($errors->has('email'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('email') }}</strong>
                                                                    </span>
                                                                @endif
                                                        </div>
                                    
                                                        <div class="form-group row">
                                                            <label for="password" class="text-black col-md-4 col-form-label">Website</label>
                                                            <input id="website" type="website" class="col-md-8 form-control{{ $errors->has('website') ? ' is-invalid' : '' }}"  value="{{ $user->website }}" name="website" >
                                
                                                            @if ($errors->has('website'))
                                                                <span class="invalid-feedback">
                                                                    <strong>{{ $errors->first('website') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                    
                                                        <div class="form-group row">
                                                            <label for="password-confirm" class="text-black col-md-4 col-form-label">About</label>
                                                            <textarea name="about" class="col-md-8 form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" id="" cols="30" rows="10">{{ $user->about }}</textarea>

                                                            @if ($errors->has('about'))
                                                                <span class="invalid-feedback">
                                                                    <strong>{{ $errors->first('about') }}</strong>
                                                                </span>
                                                            @endif
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
                                    </div>
                                    <div class="tab-pane " id="settings" role="tabpanel">
                                        <div class="col-md-12">
                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail img-raised">
                                                    <img src="/img/avatar/{{$user->photos}}" alt="...">
                                                </div>
                                                <div class="row">
                                                    <form method="post" action="{{ url('/updateavatar') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input type="file" name="photos" class="col-md-12 text-black" required accept="image/*">
                                                        <button type="submit" class="btn btn-info">Update Avatar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection