<?php $main_path = Request::segment(1); loadHelper('akses'); ?>
@extends('layout')
@section('pagetitle') BERANDALAN @endsection
@section('content')
<div class="row"><div class="col-12"><div class="card"><div class="card-header"><h5 class="card-title">{{$pagetitle}}</h5><h6 class="card-subtitle text-muted">{{$smalltitle}}</h6></div><div class="card-body">
@if(ucc()) {{Html::btnModal('<i class="la la-plus-circle"></i> Tambah Produk','modal-tambah','primary')}} <hr> @endif
<table id="datatable" class="table table-striped table-hover table-md" style="width:100%"><thead><tr><th>#</th><th>Judul</th><th>Harga</th><th>Status</th><th>Publik</th><th>Actions</th></tr></thead><tbody></tbody></table>
</div></div></div></div>
@endsection
@section('modal')
@if(ucc())
{{ Form::bsOpen('form-tambah', url($main_path.'/insert')) }}
{{ Html::mOpenLG('modal-tambah', 'Tambah Produk') }}
<div class="row"><div class="col-md-6">{{ Form::bsTextField('Judul', 'judul', '', true, 'md-12') }}{{ Form::bsTextArea('Ringkasan', 'ringkasan', '', false, 'md-12') }}<br>{{ Form::bsTextArea2('Ulasan Produk', 'ulasan', '', true, 'md-12') }}</div><div class="col-md-6">{{ Form::bsNumeric('Harga', 'harga', '', true, 'md-12') }}{{ Form::bsTextField('Nomor WA Order', 'nomor_wa_order', site_setting('whatsapp_number'), false, 'md-12') }}{{ Form::bsNumeric('Urutan Tampil', 'urutan', '0', false, 'md-12') }}<div class="mb-3"><label class="form-label">Status</label><select name="status" id="status" class="form-control"><option value="draft">Draft</option><option value="publish">Publish</option></select></div>{{ Form::bsFile('Foto Produk', 'foto', '', false, 'md-12') }}</div></div>
{{ Html::mCloseSubmitLG('Simpan') }}{{ Form::bsClose() }}
@endif
@if(ucu())
{{ Form::bsOpen('form-edit', url($main_path.'/update')) }}
{{ Html::mOpenLG('modal-edit', 'Edit Produk') }}
<div class="row"><div class="col-md-6">{{ Form::bsTextField('Judul', 'judul', '', true, 'md-12') }}{{ Form::bsTextArea('Ringkasan', 'ringkasan', '', false, 'md-12') }}<br>{{ Form::bsTextArea2('Ulasan Produk', 'ulasan', '', true, 'md-12') }}</div><div class="col-md-6">{{ Form::bsNumeric('Harga', 'harga', '', true, 'md-12') }}{{ Form::bsTextField('Nomor WA Order', 'nomor_wa_order', '', false, 'md-12') }}{{ Form::bsNumeric('Urutan Tampil', 'urutan', '0', false, 'md-12') }}<div class="mb-3"><label class="form-label">Status</label><select name="status" id="status" class="form-control"><option value="draft">Draft</option><option value="publish">Publish</option></select></div><div class="form-group"><label for="foto">Foto Produk</label><input type="file" id="foto" name="foto" class="form-control"><br><img id="preview-foto" src="" alt="Foto Produk" style="max-width: 180px; display:none;"></div></div></div>
{{ Form::bsHidden('uuid','') }}
{{ Html::mCloseSubmitLG('Simpan') }}{{ Form::bsClose() }}
@endif
@if(ucd()){{ Form::bsOpen('form-delete',url($main_path.'/delete')) }}{{ Form::bsHidden('uuid','') }}{{ Form::bsClose() }}@endif
@endsection
@section('js')
<style>

/* Ringkasan lebih pendek */

#form-tambah textarea[name="ringkasan"],
#form-edit textarea[name="ringkasan"]{
min-height:110px !important;
height:110px !important;
resize:vertical;
}


/* Ulasan lebih besar */

#form-tambah textarea[name="ulasan"],
#form-edit textarea[name="ulasan"]{
min-height:260px !important;
height:260px !important;
resize:vertical;
}

</style>

<script>
function initKonfirmDelete(){}
$(function(){
var $tabel1 = $('#datatable').DataTable({processing:true,responsive:true,fixedHeader:true,serverSide:true,ajax:"{{url($main_path.'/dt')}}",iDisplayLength:10,columns:[
{data:'DT_RowIndex',orderable:false,searchable:false},{data:'judul',name:'judul'},{data:'harga',name:'harga'},{data:'status_badge',orderable:false,searchable:false},{data:'link_public',orderable:false,searchable:false},{data:'action',orderable:false,searchable:false,className:'text-center'}],});
@if(ucc()) $('#form-tambah').ajaxForm({beforeSubmit:function(){disableButton('#form-tambah button[type=submit]')},success:function(r){if(r.status){$('#modal-tambah').modal('hide');successNotify(r.message);$tabel1.ajax.reload(null,true);}else{errorNotify(r.message);}enableButton('#form-tambah button[type=submit]')},error:function(xhr){enableButton('#form-tambah button[type=submit]');errorNotify(xhr.responseJSON?.message || 'Terjadi kesalahan');}}); @endif
@if(ucu()) $('#modal-edit').on('show.bs.modal', function(e){var uuid=$(e.relatedTarget).data('uuid');$('#form-edit').clearForm();$('#preview-foto').attr('src','').hide();$.get("{{url($main_path.'/get-data')}}/"+uuid, function(respon){ if(respon.status){$('#form-edit #uuid').val(respon.data.uuid);$('#form-edit #judul').val(respon.data.judul);$('#form-edit #ringkasan').val(respon.data.ringkasan);$('#form-edit #ulasan').val(respon.data.ulasan);$('#form-edit #harga').val(respon.data.harga);$('#form-edit #nomor_wa_order').val(respon.data.nomor_wa_order);$('#form-edit #urutan').val(respon.data.urutan);$('#form-edit #status').val(respon.data.status); if(respon.data.foto){ $('#preview-foto').attr('src', adminMediaUrl(respon.data.foto)).show(); } }});});
$('#form-edit').ajaxForm({beforeSubmit:function(){disableButton('#form-edit button[type=submit]')},success:function(r){if(r.status){$('#modal-edit').modal('hide');successNotify(r.message);$tabel1.ajax.reload(null,true);}else{errorNotify(r.message);}enableButton('#form-edit button[type=submit]')},error:function(xhr){enableButton('#form-edit button[type=submit]');errorNotify(xhr.responseJSON?.message || 'Terjadi kesalahan');}}); @endif
@if(ucd())
$(document).on('click','.btn-konfirm-delete',function(){ $('#form-delete #uuid').val($(this).data('uuid')); $.confirm({title:'Konfirmasi',content:'Hapus produk ini?',buttons:{ya:function(){ $('#form-delete').ajaxSubmit({success:function(r){if(r.status){successNotify(r.message);$tabel1.ajax.reload(null,true);}else{errorNotify(r.message);}}}); },tidak:function(){}}});});
@endif
});
</script>
@endsection



