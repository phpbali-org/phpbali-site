@extends('layouts.app')
@section('additional-styles')
<style type="text/css">
    
    .fileinput-new.thumbnail{
        margin-bottom: 50px;
    }

    .fileinput-new.thumbnail img {
        width: 200px;
        height: auto;
    }

    @media(max-width: 860px)
    {
        .fileinput-new.thumbnail img {
            width: 100%;
            height: auto;
        }
    }
</style>
@endsection
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
                                        <i class="now-ui-icons users_single-02"></i>
                                        Profile
                                    </a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#avatar" role="tab" aria-selected="true">
                                        <i class="now-ui-icons emoticons_satisfied"></i>
                                        Avatar
                                    </a>
                                  </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content ">
                                    <div class="tab-pane active show" id="profile" role="tabpanel">
                                        <div class="col-md-12">
                                            <div class="card card-plain">
                                                <div class="card-header text-center">
                                                    <h4 class="card-title ">Register</h4>
                                                </div>

                                                <div class="card-body">
                                                    <form method="POST" action="{{ route('myprofile.update.submit') }} ">
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
                                    <div class="tab-pane " id="avatar" role="tabpanel">
                                        <div class="col-md-12">
                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail">
                                                    <img id="avatar-preview" src="{{ Auth::guard('web')->user()->avatar() }}" alt="{{ Auth::guard('web')->user()->name }}">
                                                </div>
                                                <div class="row">
                                                    <form method="post" action="{{ route('myprofile.update.avatar.submit') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input id="avatar-user" type="file" name="photos" class="col-md-12 text-black" required accept="image/*">
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
@section('additional-scripts')
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#avatar-preview').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    };

    $("#avatar-user").change(function () {
        var file = this.files[0], img;
      if (Math.round(file.size / (1024 * 1024)) > 2) {
         alert('Image yang di upload terlalu besar! (Max: 2MB)');
         this.value = '';
         return false;
      }else{
        readURL(this);
      }
    });
</script>
@endsection
