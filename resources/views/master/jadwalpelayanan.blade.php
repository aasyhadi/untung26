<?php
$main_path = Request::segment(1);
loadHelper('akses');

$metode = DB::table('sub_kategori')
    ->select('id as value', 'nama_sub_kategori as text')
    ->where('id_kategori','2')->orderby('id','asc')->get();

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
				   		{{Html::btnModal('<i class="la la-plus-circle"></i> Tambah Pelatihan | Seminar','modal-tambah','primary')}}
				   		<hr>
				   		@endif
						<table id="datatable" class="table table-striped table-hover table-md" style="width:100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Nama Pelatihan | Seminar</th>
                                    <th>Tema</th>
                                    <th>Narasumber</th>
                                    <th>Biaya</th>
                                    <th>Status</th>
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
    {{ Html::mOpenLG('modal-tambah', 'Tambah Pelatihan | Seminar') }}
    <div class="row">
        <!-- Kolom Kiri -->
        <div class="col-md-6">
            {{ Form::bsTextArea2('Nama Pelatihan | Seminar', 'nama_pelatihan', '', true, 'md-12 mb-3') }}
            {{ Form::bsTextArea2('Tema', 'deskripsi', '', false, 'md-12 mb-3') }}
            {{ Form::bsTextField('Narasumber', 'narasumber', '', false, 'md-12') }}
            {{ Form::bsNumeric('Biaya', 'biaya', '', false, 'md-12') }}
            {{ Form::bsSelect2('Metode', 'metode', $metode, '', false, 'md-12') }}
            {{ Form::bsTextField('Lokasi', 'lokasi', '', false, 'md-12') }}
        </div>

        <!-- Kolom Kanan -->
        <div class="col-md-6">
            {{ Form::bsDateMask('Tanggal', 'tanggal', '', false, 'md-12 mb-3') }}
            {{ Form::bsTextField('Durasi (Hari/Jam)', 'durasi', '', false, 'md-12 mb-3') }}
            {{ Form::bsTextField('Link Pendaftaran', 'link_pendaftaran', '', false, 'md-12 mb-3') }}
            <!-- {{ Form::bsFile('Cover Flyer', 'cover', '', false, 'md-12 mb-3') }}  -->
            <div class="form-group md-12 mb-3">
                <label for="cover">Cover Flyer</label>
                <input type="file" name="cover" class="form-control" accept=".jpg,.jpeg,.png">
            </div>
        </div>
    </div>
    {{ Html::mCloseSubmitLG('Simpan') }}
{{ Form::bsClose() }}
@endif

@if(ucu())
<!-- MODAL FORM EDIT -->
{{ Form::bsOpen('form-edit',url($main_path."/update")) }}
	{{Html::mOpenLG('modal-edit','Edit Pelatihan | Seminar')}}
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                {{ Form::bsTextArea2('Nama Pelatihan | Seminar', 'nama_pelatihan', '', true, 'md-12 mb-3') }}
                {{ Form::bsTextArea2('Tema', 'deskripsi', '', false, 'md-12 mb-3') }}
                {{ Form::bsTextField('Narasumber', 'narasumber', '', false, 'md-12') }}
                {{ Form::bsNumeric('Biaya', 'biaya', '', false, 'md-12') }}
                {{ Form::bsSelect2('Metode', 'metode', $metode, '', false, 'md-12') }}
                {{ Form::bsTextField('Lokasi', 'lokasi', '', false, 'md-12') }}
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                {{ Form::bsDateMask('Tanggal', 'tanggal', '', false, 'md-12 mb-3') }}
                {{ Form::bsTextField('Durasi (Hari/Jam)', 'durasi', '', false, 'md-12 mb-3') }}
                {{ Form::bsTextField('Link Pendaftaran', 'link_pendaftaran', '', false, 'md-12 mb-3') }}
                <div class="form-group">
                    <label for="cover">Cover Flyer</label>
                    <input type="file" id="cover" name="cover" class="form-control" accept=".jpg,.jpeg,.png">
                    <br>
                    <img id="preview-cover" src="" alt="Cover Buku" style="max-width: 150px; display: none;">
                </div>
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
            ordering: false,
		    ajax: "{{url('jadwal-pelayanan/dt')}}",
		    "iDisplayLength": 10,
		    columns: [
		    	 {data:'DT_RowIndex' , orderable:false, searchable: false,sClass:""},
		         {data:'nama_pelatihan' , name:"nama_pelatihan" , orderable:false, searchable: true,sClass:""},
		         {data:'deskripsi' , name:"deskripsi" , orderable:false, searchable: false,sClass:""},
                 {data:'narasumber' , name:"narasumber" , orderable:false, searchable: false,sClass:""},
		         {data:'biaya' , name:"biaya" , orderable:false, searchable: false,sClass:""},

                 {data:'status' , name:"status" , orderable:false, searchable: false,sClass:""},
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
            $('#form-tambah #metode').selectize()[0].selectize.clear();
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
			$.get("{{url('jadwal-pelayanan/get-data')}}/"+$uuid, function(respon){
				if(respon.status){
					$('#form-edit #uuid').val(respon.data.uuid);
					$('#form-edit #nama_pelatihan').val(respon.data.nama_pelatihan);
                    $('#form-edit #narasumber').val(respon.data.narasumber);
					$('#form-edit #biaya').val(respon.data.biaya);
                    $('#form-edit #metode').selectize()[0].selectize.setValue(respon.data.metode,false);
                    $('#form-edit #lokasi').val(respon.data.lokasi);
                    $('#form-edit #tanggal').val(respon.data.tanggal);
                    $('#form-edit #durasi').val(respon.data.durasi);
                    $('#form-edit #link_pendaftaran').val(respon.data.link_pendaftaran);
                    $('#form-edit #deskripsi').val(respon.data.deskripsi);
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
                console.error('Status:', status);
                console.error('Error thrown:', error);
                console.error('Response Text:', xhr.responseText);
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

				$.get("{{url('jadwal-pelayanan/get-data')}}/"+$uuid, function(respon){
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

        // Mengaktifkan jQuery UI Datepicker
        $(".datepicker").datepicker({
            dateFormat: "yy-mm-dd",  // Format yang sesuai (yyyy-mm-dd)
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            yearRange: "-100:+10",  // Rentang tahun (100 tahun sebelumnya sampai 10 tahun ke depan)
            autoclose: true
        });


	})
</script>
@endsection
