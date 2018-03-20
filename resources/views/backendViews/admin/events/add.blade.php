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
.bg-preview{
  display: none;
}
</style>
@endsection
@section('content')
<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title">Create Event</h4>
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    <ol class="breadcrumb">
    	<li><a href="{{ route('admin.event') }}">Event</a></li>
      <li class="active">Create Event</li>
    </ol>
  </div>
</div>
<div class="row">
  <div class="col-xs-12" id="workshop-form">
  	<div class="white-box">
  		<form class="form-horizontal form-material" method="POST" enctype="multipart/form-data" action="{{ route('admin.event.store') }}">
        {{ csrf_field() }}
  			<div class="form-group">
  				<label class="col-xs-12">Title of Event</label>
  				<div class="col-xs-12">
  					<input type="text" placeholder="Enter a title for event" class="form-control form-control-line" name="name" required />
  				</div>
  			</div>
        <div class="form-group">
          <label class="col-xs-12">Image Background for Event</label>
          <div class="col-xs-12">
            <img class="bg-preview" id="bg-preview" style="height: 300px; width: auto; margin-top: 10px; margin-bottom: 10px;"/>
            <input id="img_event" name="img_event" type="file" accept="image/*" required/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12">Description of Event</label>
          <div class="col-xs-12">
            <textarea class="form-control form-control-line" name="desc" placeholder="Enter description for event" required></textarea>
          </div>
        </div>
  			<div class="form-group">
  				<label class="col-xs-12">Start Date</label>
  				<div class="col-xs-12">
  					<input type="text" id="tanggal_acara_start_date" class="form-control form-control-line no-block" placeholder="DD:MM:YYYY" required />
            <input type="text" name="waktu_acara_start_date" class="form-control form-control-line no-block clockpicker" placeholder="00:00 AM/PM" required />
  				</div>
          <input type="hidden" id="start_date" name="tanggal_acara_start_date" />
  			</div>
        <div class="form-group">
          <label class="col-xs-12">End Date</label>
          <div class="col-xs-12">
            <input type="text" id="tanggal_acara_end_date" class="form-control form-control-line no-block" placeholder="DD:MM:YYYY" required />
            <input type="text" name="waktu_acara_end_date" class="form-control form-control-line no-block clockpicker" placeholder="00:00 AM/PM" required />
          </div>
          <input type="hidden" id="end_date" name="tanggal_acara_end_date" />
        </div>
  			<div class="form-group">
  				<label class="col-xs-12">Place</label>
  				<div class="col-xs-12">
  					<input type="text" class="form-control form-control-line" id="alamat_acara" name="place" required />
            <input type="hidden" id="nama_tempat" name="place_name" />
            <input type="hidden" id="latitude" name="latitude" />
            <input type="hidden" id="longitude" name="longitude" />
  				</div>
  			</div>
        <div class="form-group">
          <label class="col-xs-12">Publish Event</label>
          <div class="col-xs-12">
            <input type="checkbox" name="published" value="1" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input type="submit" value="Create Event" class="btn btn-success pull-right">
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
const $tempatAcara = document.getElementById('alamat_acara');
const ENTER = 13;
$tempatAcara.addEventListener('keydown', function(e) {
  if (e.keyCode === ENTER) {
    e.preventDefault();
  }
})

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
  var autocomplete = new google.maps.places.Autocomplete($tempatAcara);

  autocomplete.addListener('place_changed', function() {
    var place = autocomplete.getPlace();
    document.getElementById('nama_tempat').value = place.name;
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
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#bg-preview').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }

        if($('#bg-preview').css('display') == 'none'){
          $('#bg-preview').slideToggle();
        }
    }

    $("#img_event").change(function () {
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
