@extends('layouts.dashboard')
@section('additional-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css">
<style>
[class^='select2'] {
  border-radius: 0px !important;
  box-shadow: none !important;
}

.select2-container--default .select2-selection--single, .select2-container--default .select2-selection--multiple {
  border-bottom: none;
  border-top: none;
  border-left: none;
  border-right: none;
  background-image: linear-gradient(#b5a8b9,#b5a8b9),linear-gradient(rgba(120,130,140,.13),rgba(120,130,140,.13));
  float: none;
  background-color: rgba(0,0,0,0);
  background-position: center bottom,center calc(99%);
  background-repeat: no-repeat;
  background-size: 0 2px,100% 1px;
  padding: 0;
  transition: background 0s ease-out 0s;
}

.select2-container--default.select2-container--focus .select2-selection--single, .select2-container--default.select2-container--focus .select2-selection--multiple {
  background-size: 100% 2px,100% 1px;
  outline: 0;
  border-bottom: none;
  border-top: none;
  border-left: none;
  border-right: none;
  transition-duration: .3s;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
  border: none;
}

@media screen and (max-width: 767px) {
  .select2 {
    width: 100% !important;
  }
}
</style>
@endsection
@section('content')
<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title">Adding Topic</h4>
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    <ol class="breadcrumb">
    	<li><a href="{{ route('admin.topic') }}">Topics</a></li>
      <li class="active">Add Topic</li>
    </ol>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
  	<div class="white-box">
  		<form class="form-horizontal form-material" method="POST" action="{{ route('admin.topic.store') }}">
        {{ csrf_field() }}
  			<div class="form-group">
  				<label class="col-xs-12">Title of Topic</label>
  				<div class="col-xs-12">
  					<input type="text" class="form-control form-control-line" placeholder="Enter a title for topic" name="title" required />
  				</div>
  			</div>
        <div class="form-group">
          <label class="col-xs-12">Event</label>
          <select class="form-control form-control-line select2" name="id_event" required>
            <option value="" selected hidden></option>
            @foreach($events as $event)
            <option value="{{ $event->id }}">{{ $event->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label class="col-xs-12">Speakers of Topic</label>
          <select class="form-control form-control-line select2" name="id_user[]" multiple="multiple" required>
            @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
          </select>
          <div class="col-xs-12">
            <small><strong>Note</strong>: Jika terdapat lebih dari satu speaker, silahkan ketik lalu 'enter', lalu ketikkan lagi nama speaker lainnya</small>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12">Description of Topic</label>
          <div class="col-xs-12">
            <textarea class="form-control form-control-line" name="desc" placeholder="Enter description for topic" required></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input type="submit" value="Tambah Topic" class="btn btn-success pull-right">
          </div>
        </div>
  		</form>
  	</div>
  </div>
</div>
@endsection

@if(Session::get('Error'))
    @component('components.alerts.modal')
        @slot('title')
            Operasi Gagal!
        @endslot

        <h3>{{ Session::get('Error') }}</h3>
    @endcomponent
@endif

@section('additional-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
$(document).ready(function() {
  $('.select2').select2({
    placeholder: "Please choose"
  });
});
</script>

@if(Session::get('Error'))
<script>
$(document).ready(function() {
  $('#modal-dialog').modal('show');
});
</script>
@endif
@endsection
