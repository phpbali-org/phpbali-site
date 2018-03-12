@extends('layouts.dashboard')
@section('additional-style')
<style>
.table .short-text td {
  white-space: nowrap;
  max-width: 200px;
  overflow: hidden;
  text-overflow: ellipsis;
}

.table th, .table td{
  text-align: center;
}
</style>
@endsection
@section('content')
<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title">Anggota Komunitas</h4>
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    <ol class="breadcrumb">
      <li class="active">Anggota Komunitas</li>
    </ol>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="white-box">
      <div class="table-responsive">
      	<table class="table">
      		<thead>
      			<tr>
      				<th>#</th>
      				<th>Nama</th>
              <th>Action</th>
      			</tr>
      		</thead>
      		<tbody>
      			<tr class="short-text">
      				<td>1</td>
      				<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      				tempor incididunt ut labore et dolore magna aliqua.</td>
              <td>View | Delete</td>
      			</tr>
      			<tr class="short-text">
      				<td>2</td>
      				<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      				tempor incididunt ut labore et dolore magna aliqua.</td>
              <td>View | Delete</td>
      			</tr>
      		</tbody>
      	</table>
      </div>
    </div>
  </div>
</div>
@endsection
