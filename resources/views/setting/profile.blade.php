@extends('layout')
@section("pagetitle")
	BERANDALAN
@endsection

@section('content')
<?php
	$main_path = Request::segment(1);
	loadHelper('akses');
	$profile = DB::table('users')
                ->where('id', Auth::user()->id)
                ->first();
?>

<!-- Default box -->
<div class="box">
<div class="col-12">
<div class="card">
    <div class="card-header">
		<h5 class="card-title">{{$pagetitle}}</h5>
		<h6 class="card-subtitle text-muted">{{$smalltitle}}</h6>
	</div>

<div class="box-body" style="padding: 20px;">
	<div class="row">
		<div class="col-md-3">
		<center><img src="{{ asset('img/'. $profile->avatar) }}" class="avatar img-fluid rounded-circle me-1" style="width: 200px; height: 200px;"/>
		<br><br>{{$profile->nama_pengguna}}
		</center>
		</div>
		<div class="col-md-5">
			<hr>
			<table class="no-border">
				<tr>
					<td width='160pt'>Nama Pengguna</td>
					<td>: {{$profile->nama_pengguna}}</td>
				</tr>
                <tr>
					<td>Username</td>
					<td>: {{$profile->username}}</td>
				</tr>
				<tr>
				<tr>
					<td>Email</td>
					<td>: {{$profile->email}}</td>
				</tr>
				<tr>
					<td>Telepon</td>
					<td>: {{$profile->telp}}</td>
				</tr>
			</table>
			<hr>
		</div>
	</div>
</div>
<!-- /.box-body -->
<div class="box-footer">
  &nbsp;
</div>
<!-- /.box-footer-->
</div>
</div>
</div>
<!-- /.box -->

@endsection

@section('modal')
@endsection

@section('js')
@endsection
