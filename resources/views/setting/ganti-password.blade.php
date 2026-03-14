@extends('layout')
@section("pagetitle")
	BERANDALAN
@endsection

@section('content')
<?php
$main_path = Request::segment(1);
loadHelper('akses');
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
	   	<div class="col-md-6">
	   		{{ Form::bsOpen('form-password-user',url("update-password")) }}
				{{ Form::bsReadOnly('Username','username',Auth::user()->username,true,'md-12') }}
				{{ Form::bsReadOnly('Nama Pengguna','nama_pengguna',Auth::user()->nama_pengguna,true,'md-12') }}
				{{ Form::bsPassword('Password Lama','password1','',true,'md-12') }}
				{{ Form::bsPassword('Password Baru','password2','',true,'md-12') }}
				{{ Form::bsPassword('Password Konfirmasi','password3','',true,'md-12') }}
				<hr>
				{{ Form::bsSubmit('<i class="la la-save"></i> Simpan')}}
			{{ Form::bsClose()}}

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
<script type="text/javascript">
	$(function(){
		$validator_form_password = $("#form-password-user").validate();

		$('#password2').passtrength({
			  tooltip: true,
			  textWeak: "Lemah",
			  textMedium: "Sedang",
			  textStrong: "Kuat",
			  textVeryStrong: "Sangat Kuat",
			  minChars: 6,
		});

		$('#password3').passtrength({
			  tooltip: true,
			  textWeak: "Lemah",
			  textMedium: "Sedang",
			  textStrong: "Kuat",
			  textVeryStrong: "Sangat Kuat",
			  minChars: 6,
		});

		@if(Session::has('error'))
	          $message = "{{Session::get('error')}}";
	          swal("Peringatan", $message, "error");
	    @endif

	    @if(Session::has('success'))
	          $message = "{{Session::get('success')}}";
	          swal("Berhasil", $message, "success");
	    @endif
	})
</script>
@endsection
