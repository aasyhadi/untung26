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
						@if(ucc())
				   		{{Html::btnModal('<i class="la la-plus-circle"></i> Tambah Template','modal-tambah','primary')}}
				   		<hr>
				   		@endif
						<table id="datatable" class="table table-striped table-hover table-md" style="width:100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama Template</th>
                                    <th>Harga</th>
                                    <th>Type File</th>
                                    <th>ePayment</th>
									<th>Actions</th>
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
@if(ucc())
<!-- MODAL FORM TAMBAH -->
{{ Form::bsOpen('form-tambah', url($main_path."/insert"), 'POST', ['enctype' => 'multipart/form-data']) }}
    {{ Html::mOpenLG('modal-tambah', 'Tambah Form Template') }}
    <div class="row">
        <!-- Kolom Kiri -->
        <div class="col-md-6">
            {{ Form::bsTextField('Nama Form Template', 'nama_template', '', true, 'md-12') }}
            {{ Form::bsNumeric('Harga', 'harga', '', false, 'md-12') }}
            <!-- {{ Form::bsTextField('Template Link', 'template_link', '', false, 'md-12') }} -->
            {{ Form::bsTextField('Landing Page Link', 'landing_page_link', '', false, 'md-12') }}
            {{ Form::bsFile('Cover', 'cover', '', false, 'md-12') }}
        </div>

        <!-- Kolom Kanan -->
        <div class="col-md-6">
            {{ Form::bsTextField('Type File', 'type_file', '', false, 'md-12') }}
            {{ Form::bsTextArea('Deskripsi', 'deskripsi', '', false, 'md-12') }}
        </div>
    </div>
    {{ Html::mCloseSubmitLG('Simpan') }}
{{ Form::bsClose() }}
@endif

@if(ucu())
<!-- MODAL FORM EDIT -->
{{ Form::bsOpen('form-edit',url($main_path."/update")) }}
	{{Html::mOpenLG('modal-edit','Edit Form Template')}}
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                {{ Form::bsTextField('Nama Form Template', 'nama_template', '', true, 'md-12') }}
                {{ Form::bsNumeric('Harga', 'harga', '', false, 'md-12') }}
                <!-- {{ Form::bsTextField('Template Link', 'template_link', '', false, 'md-12') }} -->
                {{ Form::bsTextField('Landing Page Link', 'landing_page_link', '', false, 'md-12') }}
                <div class="form-group">
                    <label for="cover">Cover</label>
                    <input type="file" id="cover" name="cover" class="form-control">
                    <br>
                    <img id="preview-cover" src="" alt="Cover Buku" style="max-width: 150px; display: none;">
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                {{ Form::bsTextField('Type File', 'type_file', '', false, 'md-12') }}
                {{ Form::bsTextArea('Deskripsi', 'deskripsi', '', false, 'md-12') }}
            </div>
        </div>
        {{ Form::bsHidden('uuid','') }}
	{{Html::mCloseSubmitLG('Simpan')}}
{{ Form::bsClose()}}
 @endif

@if(ucd())
 <!-- FORM DELETE -->
{{ Form::bsOpen('form-delete',url($main_path."/delete")) }}
	{{ Form::bsHidden('uuid','') }}
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
		    ajax: "{{url('master-form-template/dt')}}",
		    "iDisplayLength": 10,
		    columns: [
		    	 {data:'DT_RowIndex' , orderable:false, searchable: false,sClass:""},
		         {data:'nama_template' , name:"nama_template" , orderable:true, searchable: true,sClass:""},
		         {data:'harga' , name:"harga" , orderable:false, searchable: false,sClass:""},
                 {data:'type_file' , name:"type_file" , orderable:false, searchable: false,sClass:""},
                 {data:'epayment' , name:"epayment" , orderable:false, searchable: false,sClass:""},
                 {data:'action' , orderable:false, searchable: false,sClass:"text-center"},
		        ],
		        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		        $(nRow).addClass( aData["rowClass"] );
		        return nRow;
		    },
		    "drawCallback": function( settings ) {
		        initKonfirmDelete();
		    }
		});

		@if(ucc())
		$validator_form_tambah = $("#form-tambah").validate();
		$("#modal-tambah").on('show.bs.modal', function(e){
			$validator_form_tambah.resetForm();
			$("#form-tambah").clearForm();
			enableButton("#form-tambah button[type=submit]")
		});

		$('#form-tambah').ajaxForm({
			beforeSubmit:function(){disableButton("#form-tambah button[type=submit]")},
			success:function($respon){
				if ($respon.status==true){
					 $("#modal-tambah").modal('hide');
					 successNotify($respon.message);
					 $tabel1.ajax.reload(null, true);
				}else{
					errorNotify($respon.message);
				}
				enableButton("#form-tambah button[type=submit]")
			},
			error:function(){
				$("#form-tambah button[type=submit]").button('reset');
				$("#modal-tambah").modal('hide');
				errorNotify('Terjadi Kesalahan!');
			}
		});
		@endif

		@if(ucu())
		$validator_form_edit = $("#form-edit").validate();
		$("#modal-edit").on('show.bs.modal', function(e){
			$uuid  = $(e.relatedTarget).data('uuid');
			$validator_form_edit.resetForm();
			$("#form-edit").clearForm();
			disableButton("#form-edit button[type=submit]")
			$.get("{{url('master-form-template/get-data')}}/"+$uuid, function(respon){
				if(respon.status){
					$('#form-edit #uuid').val(respon.data.uuid);
					$('#form-edit #nama_template').val(respon.data.nama_template);
                    $('#form-edit #deskripsi').val(respon.data.deskripsi);
					$('#form-edit #harga').val(respon.data.harga);
                    $('#form-edit #type_file').val(respon.data.type_file);
                    $('#form-edit #template_link').val(respon.data.template_link);
                    $('#form-edit #landing_page_link').val(respon.data.landing_page_link);

                    if (respon.data.cover) {
                        $('#preview-cover').attr('src', adminMediaUrl(respon.data.cover)).show();
                    } else {
                        $('#preview-cover').attr('src', '').hide();
                    }
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

		@if(ucd())
		$('#form-delete').ajaxForm({
			beforeSubmit:function(){},
			success:function($respon){
				if ($respon.status==true){
					 successNotify($respon.message);
					 $tabel1.ajax.reload(null, true);
				}else{
					errorNotify($respon.message);
				}
			},
			error:function(){errorNotify('Terjadi Kesalahan!');}
		});
		var initKonfirmDelete= function(){
			$('.btn-konfirm-delete').on('click', function(e){
				$uuid  = $(this).data('uuid');

				$.get("{{url('master-form-template/get-data')}}/"+$uuid, function(respon){
					if(respon.status){
						$("#form-delete #uuid").val(respon.data.uuid);
						$.confirm({
						    title: 'Yakin Hapus Data?',
						    content: respon.informasi,
						    buttons: {

						        cancel :{
						        	text: 'Batalkan'
						        },
						        confirm: {
						        	text: 'Hapus',
						        	btnClass: 'btn-danger',
						        	action:function(){$("#form-delete").submit()}
						        },
						    }
						});
					}else{
						errorNotify(respon.message);
					}
				})
			})
		}
		@endif

	})
</script>
@endsection
