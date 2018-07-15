@extends('layouts.dashboard')

@section('content')
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Profile Page</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="active">Profile Page</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 white-box">
        <div class="col-xs-12">
            <div class="col-xs-6">
                <h3 class="box-title">Profil</h3>
            </div>
            <div class="col-xs-6 text-right">
                <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">Edit Profil</a>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="col-xs-2">
                <p>Nama : </p>
                <p>Email : </p>
            </div>
            <div class="col-xs-10">
                <p>{{ $adminmeta->name }}</p>
                <p>{{ $adminmeta->email }}</p>
            </div>
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
