@extends('layouts.dashboard')
@section('additional-style')
<link rel="stylesheet" href="{{ asset('css/pikaday.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap-toggle.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap-clockpicker.min.css') }}">
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
    <h4 class="page-title">Edit Event</h4>
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    <ol class="breadcrumb">
    	<li><a href="{{ route('admin.event') }}">Event</a></li>
      <li class="active">Edit Event</li>
    </ol>
  </div>
</div>
<div class="row">
  <div class="col-xs-12" id="workshop-form">
  	<div class="white-box">
  		<form class="form-horizontal form-material" method="POST" action="{{ route('admin.event.update', ['slug' => $event->slug]) }}">
        {{ csrf_field() }}
  			<div class="form-group">
  				<label class="col-xs-12">Title of Event</label>
  				<div class="col-xs-12">
  					<input type="text" placeholder="Enter a title for event" value="{{ $event->name }}" class="form-control form-control-line" name="name" required />
  				</div>
  			</div>
        <div class="form-group">
          <label class="col-xs-12">Description of Event</label>
          <div class="col-xs-12">
            <textarea class="form-control form-control-line" name="desc" placeholder="Enter description for event" required>{!! $event->desc !!}</textarea>
          </div>
        </div>
  			<div class="form-group">
  				<label class="col-xs-12">Start Date</label>
  				<div class="col-xs-12">
  					<input type="text" id="tanggal_acara_start_date" class="form-control form-control-line no-block" placeholder="DD:MM:YYYY" value="{{ $tanggal_acara_start_date }}" />
            <input type="text" name="waktu_acara_start_date" class="form-control form-control-line no-block clockpicker" placeholder="00:00 AM/PM" value="{{ $waktu_acara_start_date }}" />
  				</div>
          <input type="hidden" id="start_date" name="tanggal_acara_start_date" value="{{ $tanggal_acara_start_date }}" />
  			</div>
        <div class="form-group">
          <label class="col-xs-12">End Date</label>
          <div class="col-xs-12">
            <input type="text" id="tanggal_acara_end_date" class="form-control form-control-line no-block" placeholder="DD:MM:YYYY" value="{{ $tanggal_acara_end_date }}" />
            <input type="text" name="waktu_acara_end_date" class="form-control form-control-line no-block clockpicker" placeholder="00:00 AM/PM" value="{{ $waktu_acara_end_date }}" />
          </div>
          <input type="hidden" id="end_date" name="tanggal_acara_end_date" value="{{ $tanggal_acara_end_date }}" />
        </div>
  			<div class="form-group">
  				<label class="col-xs-12">Place</label>
  				<div class="col-xs-12">
  					<input type="text" class="form-control form-control-line" name="place" id="alamat_acara" value="{{ $event->place }}" />
            <input type="hidden" id="latitude" name="latitude" value="{{ $event->latitude }}" />
            <input type="hidden" id="longitude" name="longitude" value="{{ $event->longitude }}" />
  				</div>
  			</div>
        <div class="form-group">
          <label class="col-xs-12">Publish Event</label>
          <div class="col-xs-12">
            <input type="checkbox" name="published" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" {{ ($event->published == 1) ? 'checked' : '' }}>
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input type="submit" value="Update Event" class="btn btn-success pull-right">
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
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/pikaday.js') }}"></script>
<script src="{{ asset('js/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-clockpicker.min.js') }}"></script>
<script>
$(document).ready(function() {
	var startDate = new Pikaday({
    field: $('#tanggal_acara_start_date')[0],
    minDate: new Date(),
    format: 'DD MMMM YYYY',
    onSelect: function() {
      $('#start_date').val(this.getMoment().format('D/MMM/Y'));
      endDate.setMinDate(this.getDate());
    }
  });

  var endDate = new Pikaday({
    field: $('#tanggal_acara_end_date')[0],
    format: 'DD MMMM YYYY',
    onSelect: function() {
      $('#end_date').val(this.getMoment().format('D/MMM/Y'));
      startDate.setMaxDate(this.getDate());
    }
  });

  $('.clockpicker').clockpicker();
});

function init() {
  var input = document.getElementById('alamat_acara');
  var autocomplete = new google.maps.places.Autocomplete(input);

  autocomplete.addListener('place_changed', function() {
    var place = autocomplete.getPlace();
    document.getElementById('latitude').value = place.geometry.location.lat();
    document.getElementById('longitude').value = place.geometry.location.lng();
  });
}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBczq4IbQDIhumdo6aUyb0V87HQoLwl75I&libraries=places&callback=init"></script>
@if(Session::get('Error'))
  <script>
    $(document).ready(function() {
      $('#modal-dialog').modal('show');
    });
  </script>
@endif
@endsection
