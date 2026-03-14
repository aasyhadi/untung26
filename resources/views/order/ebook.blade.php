<?php
$main_path = Request::segment(1);
loadHelper('akses');

?>
@extends('layout')
@section("pagetitle")
	BERANDALAN
@endsection

@section('content')

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">{{$pagetitle}}</h5>
						<h6 class="card-subtitle text-muted">{{$smalltitle}}</h6>
					</div>
					<div class="card-body">
						<table id="datatable" class="table table-striped table-hover table-md" style="width:100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Tanggal</th>
                                    <th>No Whatsapp</th>
									<th>Nama eBook</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>


					</div>
				</div>
			</div>
		</div>

@endsection

@section("modal")
@if(ucu())
<!-- MODAL FORM EDIT -->
{{ Form::bsOpen('form-edit',url($main_path."/update")) }}
	{{Html::mOpenLG('modal-edit','Edit Order Ebook')}}
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                {{ Form::bsReadOnly('Nama eBook', 'nama_ebook', '', false, 'md-12 mb-3') }}
                {{ Form::bsReadOnly('Tanggal Order', 'tanggal', '', false, 'md-12') }}
                {{ Form::bsReadOnly('Nama', 'nama', '', false, 'md-12') }}
                {{ Form::bsReadOnly('No Whatsapp', 'whatsapp', '', false, 'md-12') }}
                {{ Form::bsReadOnly('Email', 'email', '', false, 'md-12') }}
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                {{ Form::bsTextArea('Info Kiriman eBook', 'kirim_ebook', '', true, 'md-12') }}
            </div>
        </div>
        {{ Form::bsHidden('uuid','') }}
	{{Html::mCloseSubmitLG('Kirim Ebook Sekarang')}}
{{ Form::bsClose()}}
@endif
@endsection

@section("js")
<script type="text/javascript">
	$(function(){
		var $tabel1 = $('#datatable').DataTable({
		    processing: true,
		    responsive: true,
		    fixedHeader: true,
		    serverSide: true,
		    ajax: "{{url('order-ebook/dt')}}",
		    "iDisplayLength": 10,
		    columns: [
		    	 {data:'DT_RowIndex' , orderable:false, searchable: false,sClass:""},
		         {data:'tanggal' , name:"tanggal" , orderable:true, searchable: true,sClass:""},
		         {data:'whatsapp' , name:"whatsapp" , orderable:false, searchable: false,sClass:""},
		         {data:'nama_ebook' , name:"nama_ebook" , orderable:false, searchable: false,sClass:""},
                 {data:'status' , name:"status" , orderable:false, searchable: false,sClass:""},
		         {data:'action' , orderable:false, searchable: false,sClass:"text-center"},
		        ],
		        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		        $(nRow).addClass( aData["rowClass"] );
		        return nRow;
		    }
		});

		@if(ucu())
		$validator_form_edit = $("#form-edit").validate();
		$("#modal-edit").on('show.bs.modal', function(e){
			$uuid  = $(e.relatedTarget).data('uuid');
			$validator_form_edit.resetForm();
			$("#form-edit").clearForm();
			disableButton("#form-edit button[type=submit]")
			$.get("{{url('order-ebook/get-data')}}/"+$uuid, function(respon){
				if(respon.status){
					$('#form-edit #uuid').val(respon.data.uuid);
					$('#form-edit #nama').val(respon.data.nama);
					$('#form-edit #tanggal').val(respon.data.tanggal);
					$('#form-edit #whatsapp').val(respon.data.whatsapp);
                    $('#form-edit #email').val(respon.data.email);
                    $('#form-edit #nama_ebook').val(respon.data.nama_ebook);
                    $('#form-edit #status').val(respon.data.status);
                    $('#form-edit #kirim_ebook').val(respon.data.kirim_ebook);
					enableButton("#form-edit button[type=submit]");
				}else{
					errorNotify(respon.message);
				}
			})
		});

		$('#form-edit').ajaxForm({
			beforeSubmit:function(){disableButton("#form-edit button[type=submit]")},
			success:function($respon){
				if ($respon.status==true){
					 $("#modal-edit").modal('hide');
					 successNotify($respon.message);
					 $tabel1.ajax.reload(null, true);
				}else{
					errorNotify($respon.message);
				}
				enableButton("#form-edit button[type=submit]")
			},
			error:function(){
				$("#form-edit button[type=submit]").button('reset');
				$("#modal-edit").modal('hide');
				errorNotify('Terjadi Kesalahan!');
			}
		});
		@endif

	})
</script>
@endsection
