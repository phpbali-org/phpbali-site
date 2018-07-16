@extends('layouts.dashboard')
@section('additional-style')
<style>
.no-block {
  display: inline-block !important;
  width: unset !important;
  margin-right: 14px;
}
</style>
@endsection
@section('content')
<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title">Edit Profile</h4>
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">Home</a></li>
    	<li><a href="{{ route('admin.profile') }}">Profile</a></li>
      <li class="active">Edit Profile</li>
    </ol>
  </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="white-box">
            <form class="form-horizontal form-material" method="POST" action="{{ route('admin.profile.update') }}">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value=" PUT">
                <div class="form-group">
                    <label class="col-xs-12">Name</label>
                    <div class="col-xs-12">
                        <input type="text" placeholder="Enter a new name" class="form-control form-control-line" name="name" value="{{ $adminmeta->name }}"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12">Email</label>
                    <div class="col-xs-12">
                        <input type="email" placeholder="Enter a new email" class="form-control form-control-line" name="email" value="{{ $adminmeta->email }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12">Password</label>
                    <div class="col-xs-12">
                        <input type="password" placeholder="Enter a new password" class="form-control form-control-line" name="password">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="submit" value="Update Profile" class="btn btn-success pull-right">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('additional-scripts')
 @if(Session::get('Success') || Session::get('Error'))
    @component('components.alerts.modal')
      @if(Session::get('Success'))
        @slot('title')
          Operasi Sukses!
        @endslot

        <h3>{{ Session::get('Success') }}</h3>
      @endif

      @if(Session::get('Error'))
        @slot('title')
          Operasi Gagal!
        @endslot

        <h3>{{ Session::get('Error') }}</h3>
      @endif
    @endcomponent
  @endif

  @if(Session::get('Success') || Session::get('Error'))
  <script>
    $(document).ready(function() {
      $('#modal-dialog').modal('show');
    });
  </script>
  @endif
@endsection
