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
        <h4 class="page-title">Editing Member</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.members') }}">Topics</a></li>
            <li class="active">Edit Member</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
      	<div class="white-box">
            @if($editable)
      		<form class="form-material" method="POST" action="{{ route('admin.members.update', ['member' => $member->id]) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <img class="bg-preview" src="{{ $member->avatar() }}" id="bg-preview" style="height: 300px; width: auto; margin-top: 10px; margin-bottom: 10px;"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Foto Profil</label>
                            <input id="img_event" name="photos" type="file" accept="image/*"/>
                            <small><b>Note: </b>Lewatkan saja jika tidak ada perubahan pada foto profil</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" name="name" value="{{ $member->name }}" id="name" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $member->email }}" id="email" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Password</label>
                            <input type="password" class="form-control" name="password">
                            <small><b>Note:</b> Lewatkan saja bagian ini jika tidak ada perubahan</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="staff">Staff?</label>
                            <select name="is_staff" id="staff" class="form-control form-control-line select2" required>
                                @foreach ($general_options as $key => $value)
                                    <option value="{{ $key }}" {{ ($member->is_staff == 1) ? 'checked' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label></label><br>
                            <input type="submit" value="Ubah Member" class="btn btn-success">
                        </div>
                    </div>
                </div>
            </form>
            @else
            <form class="form-material" method="POST" action="{{ route('admin.members.update', ['member' => $member->id]) }}">
            {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="staff">Staff?</label>
                            <select name="is_staff" id="staff" class="form-control form-control-line select2" required>
                                @foreach ($general_options as $key => $value)
                                    <option value="{{ $key }}"
                                    {{ $member->is_staff === $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label></label><br>
                            <input type="submit" value="Ubah Member" class="btn btn-success">
                        </div>
                    </div>
                </div>
            </form>
            @endif
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

@if($editable)
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
@endif
@endsection
