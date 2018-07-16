@extends('layouts.dashboard')

@section('content')
<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title">Welcome Page</h4>
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    <ol class="breadcrumb">
    <li class="active">Welcome Page</li>
    </ol>
  </div>
</div>
<div class="row">
    @if(session()->has('success'))
      <div class="col-xs-12">
        <div class="alert alert-success" role="alert">{{ session()->get('success') }}</div>
      </div>
    @endif
    <div class="col-xs-12">
      <div class="white-box">
        <h3 class="box-title">Welcome</h3>
        Selamat datang admin!
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
