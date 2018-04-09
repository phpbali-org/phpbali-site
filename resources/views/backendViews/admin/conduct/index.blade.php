@extends('layouts.dashboard')
@section('additional-style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/medium-editor.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/tim.min.css') }}" />
<style type="text/css">
  #editor
  {
    max-height: 100px;
    overflow-y: scroll;
    height: 100px;
  }
</style>
@endsection
@section('content')
<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title">Code of Conduct Page</h4>
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    <ol class="breadcrumb">
      <li class="active">Code of Conduct</li>
    </ol>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="white-box">
      <form class="form-horizontal form-material" method="POST" action="{{ route('admin.about.store') }}">
        {{ csrf_field() }}
        <div class="form-group">
          <label class="col-xs-12">Code of Conduct</label>
          <div class="col-xs-12" style="margin-top: 20px">
            @if(isset($conduct->desc))
            <div id="editor" class="form-control form-control-line">{!! $conduct->desc !!}</div>
            <input type="hidden" id="desc" name="desc" value="{!! $conduct->desc !!}" />
            @else
            <div id="editor" class="form-control form-control-line"></div>
            <input type="hidden" id="desc" name="desc" />
            @endif
          </div>
          <br />
          <input type="submit" value="Save" class="btn btn-success pull-right">
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

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

@section('additional-scripts')
<script src="{{ asset('js/medium-editor.min.js') }}"></script>
<script type="text/javascript">
  var desc = new MediumEditor('#editor', {
    buttonLabels: 'fontawesome'
  });

  desc.subscribe('editableInput', function(eventObj, editable) {
    $('#desc').val(desc.getContent());
  });
</script>
@if(Session::get('Success') || Session::get('Error'))
<script>
  $(document).ready(function() {
    $('#modal-dialog').modal('show');
  });
</script>
@endif
@endsection