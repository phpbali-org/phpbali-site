@extends('layouts.dashboard')
@section('additional-style')
@if($topics > 0)
<link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}" />

<style>
.table .short-text td {
  white-space: nowrap;
  max-width: 200px;
  overflow: hidden;
  text-overflow: ellipsis;
}

.table th, .table td {
  text-align: center;
}

table.dataTable thead th.sorting:after,
table.dataTable thead th.sorting_asc:after,
table.dataTable thead th.sorting_desc:after {
    position: absolute;
    top: 12px;
    right: 8px;
    display: block;
    font-family: FontAwesome;
}
</style>
@endif
@endsection

@section('content')
<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title">Topics</h4>
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    <ol class="breadcrumb">
      <li><a href="#">Meetups</a></li>
      <li class="active">Topics</li>
    </ol>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="pull-left" style="margin-bottom: 10px;">
      <a href="{{ route('admin.topic.create') }}" class="btn btn-primary">Add Topic</a>
    </div>
    <div style="clear:both;"></div>
    <div class="white-box">
      @if($topics > 0)
      <div class="table-responsive">
      	<table id="tableTopics" class="table">
      		<thead>
      			<tr>
      				<th>#</th>
      				<th>Title</th>
              <th>Speakers</th>
              <th>Event</th>
              <th>Action</th>
      			</tr>
      		</thead>
      	</table>
      </div>
      @else
      <div class="text-center">
        <h3>Tidak ada data yang ditemukan</h3>
      </div>
      @endif
    </div>
  </div>
</div>
@endsection

@section('additional-scripts')
  @if($topics > 0)
  <script src="{{ asset('js/datatables.min.js') }}"></script>
  <script type="text/javascript">
    $(function() {
      $('#tableTopics').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.topic.ajax') }}',
        columns: [
          { data: 'DT_Row_Index', name: 'DT_Row_Index' },
          { data: 'title', name: 'title' },
          { data: 'speakers', name: 'speakers' },
          { data: 'event', name: 'event' },
          { data: 'action', name: 'action' }
        ],
        language: {
          oPaginate: {
            sNext: '<i class="fa fa-forward"></i>',
            sPrevious: '<i class="fa fa-backward"></i>',
            sFirst: '<i class="fa fa-step-backward"></i>',
            sLast: '<i class="fa fa-step-forward"></i>'
          }
        },
        pagingType: 'full_numbers',
        bLengthChange: false,
        bSort: false,
      })
    })
  </script>
  @endif
  @component('components.alerts.modal-action')
  <h4>Yakin ingin menghapus data ini?</h4>
  @endcomponent

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

  <script>
    $('#modal-action').on('show.bs.modal', function(e) {
      $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
  </script>
@endsection
