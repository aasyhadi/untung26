<?php $main_path = Request::segment(1); loadHelper('akses'); ?>
@extends('layout')
@section('pagetitle') MASTER ARTIKEL @endsection

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
                    {{Html::btnModal('<i class="la la-plus-circle"></i> Tambah Artikel','modal-tambah','primary')}}
                    <hr>
                @endif
                <table id="datatable" class="table table-striped table-hover table-md" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Publish</th>
                            <th>Publik</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
@if(ucc())
{{ Form::bsOpen('form-tambah', url($main_path.'/insert')) }}
{{ Html::mOpenLG('modal-tambah', 'Tambah Artikel') }}
<div class="row">
    <div class="col-md-7">
        {{ Form::bsTextField('Judul', 'judul', '', true, 'md-12') }}
        {{ Form::bsTextArea('Ringkasan', 'ringkasan', '', false, 'md-12') }}
        <div class="col-md-12 mb-3">
            <br>
            <label class="form-label">Isi Artikel <star>*</star></label>
            <div class="rich-editor-wrapper" data-target="#form-tambah #isi_artikel">
                <div class="rich-editor-toolbar">
                    <button type="button" data-command="bold"><strong>B</strong></button>
                    <button type="button" data-command="italic"><em>I</em></button>
                    <button type="button" data-command="underline"><u>U</u></button>
                    <button type="button" data-command="formatBlock" data-value="h2">H2</button>
                    <button type="button" data-command="formatBlock" data-value="h3">H3</button>
                    <button type="button" data-command="insertUnorderedList">• List</button>
                    <button type="button" data-command="insertOrderedList">1. List</button>
                    <button type="button" data-command="formatBlock" data-value="blockquote">Quote</button>
                    <button type="button" data-command="createLink">Link</button>
                    <button type="button" data-command="removeFormat">Clear</button>
                </div>
                <div class="rich-editor" contenteditable="true" data-editor-for="isi_artikel" data-placeholder="Tulis isi artikel di sini..."></div>
                <textarea name="isi_artikel" id="isi_artikel" required class="d-none"></textarea>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        {{ Form::bsTextField('Teks Foto', 'teks_foto', '', false, 'md-12') }}
        {{ Form::bsTextField('Penulis', 'penulis', 'Untung Yasril', false, 'md-12') }}
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="draft">Draft</option>
                <option value="publish">Publish</option>
            </select>
        </div>
        {{ Form::bsDate('Tanggal Publish', 'published_at', '', false, 'md-12') }}
        {{ Form::bsFile('Foto', 'foto', '', false, 'md-12') }}
    </div>
</div>
{{ Html::mCloseSubmitLG('Simpan') }}{{ Form::bsClose() }}
@endif

@if(ucu())
{{ Form::bsOpen('form-edit', url($main_path.'/update')) }}
{{ Html::mOpenLG('modal-edit', 'Edit Artikel') }}
<div class="row">
    <div class="col-md-7">
        {{ Form::bsTextField('Judul', 'judul', '', true, 'md-12') }}
        {{ Form::bsTextArea('Ringkasan', 'ringkasan', '', false, 'md-12') }}
        <div class="col-md-12 mb-3">
            <label class="form-label">Isi Artikel <star>*</star></label>
            <div class="rich-editor-wrapper" data-target="#form-edit #isi_artikel">
                <div class="rich-editor-toolbar">
                    <button type="button" data-command="bold"><strong>B</strong></button>
                    <button type="button" data-command="italic"><em>I</em></button>
                    <button type="button" data-command="underline"><u>U</u></button>
                    <button type="button" data-command="formatBlock" data-value="h2">H2</button>
                    <button type="button" data-command="formatBlock" data-value="h3">H3</button>
                    <button type="button" data-command="insertUnorderedList">• List</button>
                    <button type="button" data-command="insertOrderedList">1. List</button>
                    <button type="button" data-command="formatBlock" data-value="blockquote">Quote</button>
                    <button type="button" data-command="createLink">Link</button>
                    <button type="button" data-command="removeFormat">Clear</button>
                </div>
                <div class="rich-editor" contenteditable="true" data-editor-for="isi_artikel" data-placeholder="Tulis isi artikel di sini..."></div>
                <textarea name="isi_artikel" id="isi_artikel" required class="d-none"></textarea>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        {{ Form::bsTextField('Teks Foto', 'teks_foto', '', false, 'md-12') }}
        {{ Form::bsTextField('Penulis', 'penulis', '', false, 'md-12') }}
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="draft">Draft</option>
                <option value="publish">Publish</option>
            </select>
        </div>
        {{ Form::bsDate('Tanggal Publish', 'published_at', '', false, 'md-12') }}
        <div class="form-group">
            <label for="foto">Foto</label>
            <input type="file" id="foto" name="foto" class="form-control">
            <br>
            <img id="preview-foto" src="" alt="Foto Artikel" style="max-width: 180px; display:none;">
        </div>
    </div>
</div>
{{ Form::bsHidden('uuid','') }}
{{ Html::mCloseSubmitLG('Simpan') }}{{ Form::bsClose() }}
@endif

@if(ucd())
{{ Form::bsOpen('form-delete',url($main_path.'/delete')) }}
{{ Form::bsHidden('uuid','') }}
{{ Form::bsClose() }}
@endif
@endsection

@section('js')
<style>
.rich-editor-wrapper { border:1px solid #d7dee8; border-radius:12px; overflow:hidden; background:#fff; }
.rich-editor-toolbar { display:flex; flex-wrap:wrap; gap:8px; padding:10px; background:#f8fafc; border-bottom:1px solid #e2e8f0; }
.rich-editor-toolbar button { border:1px solid #cbd5e1; background:#fff; border-radius:8px; padding:6px 10px; font-size:13px; }
.rich-editor { min-height:280px; padding:16px; outline:none; line-height:1.8; }
.rich-editor:empty:before { content: attr(data-placeholder); color:#94a3b8; }
.rich-editor h2, .rich-editor h3 { margin-top:1rem; }
.rich-editor blockquote { border-left:4px solid #cbd5e1; padding-left:12px; color:#475569; }

.rich-editor-wrapper { border:1px solid #d7dee8; border-radius:12px; overflow:hidden; background:#fff; }
.rich-editor-toolbar { display:flex; flex-wrap:wrap; gap:8px; padding:10px; background:#f8fafc; border-bottom:1px solid #e2e8f0; }
.rich-editor-toolbar button { border:1px solid #cbd5e1; background:#fff; border-radius:8px; padding:6px 10px; font-size:13px; }
.rich-editor { min-height:280px; padding:16px; outline:none; line-height:1.8; }
.rich-editor:empty:before { content: attr(data-placeholder); color:#94a3b8; }
.rich-editor h2, .rich-editor h3 { margin-top:1rem; }
.rich-editor blockquote { border-left:4px solid #cbd5e1; padding-left:12px; color:#475569; }

/* kecilkan space ringkasan */
#form-tambah textarea[name="ringkasan"],
#form-edit textarea[name="ringkasan"] {
    min-height: 90px !important;
    height: 90px !important;
    resize: vertical;
}
</style>
<script>
function initRichEditors(scope){
    $(scope).find('.rich-editor-wrapper').each(function(){
        var wrapper = $(this);
        var textarea = wrapper.find('textarea');
        var editor = wrapper.find('.rich-editor');

        function syncToTextarea(){
            textarea.val(editor.html().trim());
        }

        wrapper.find('[data-command]').off('click').on('click', function(){
            var command = $(this).data('command');
            var value = $(this).data('value') || null;
            editor.trigger('focus');
            if(command === 'createLink'){
                var url = prompt('Masukkan URL link');
                if(url){ document.execCommand(command, false, url); }
            } else {
                document.execCommand(command, false, value);
            }
            syncToTextarea();
        });

        editor.off('input blur keyup paste').on('input blur keyup paste', function(){
            syncToTextarea();
        });

        var currentValue = textarea.val();
        if(currentValue && editor.html().trim() === ''){
            editor.html(currentValue);
        }
    });
}

function setRichEditorContent(formSelector, fieldName, value){
    var form = $(formSelector);
    form.find('textarea[name="'+fieldName+'"]').val(value || '');
    form.find('.rich-editor[data-editor-for="'+fieldName+'"]').html(value || '');
}

function clearRichEditor(formSelector, fieldName){
    setRichEditorContent(formSelector, fieldName, '');
}

function initKonfirmDelete(){}
$(function(){
    initRichEditors(document);

    var $tabel1 = $('#datatable').DataTable({
        processing:true,
        responsive:true,
        fixedHeader:true,
        serverSide:true,
        ajax:"{{url($main_path.'/dt')}}",
        iDisplayLength:10,
        columns:[
            {data:'DT_RowIndex',orderable:false,searchable:false},
            {data:'judul',name:'judul'},
            {data:'status_badge',orderable:false,searchable:false},
            {data:'published_at',name:'published_at', render:function(data){ return data ? data : '-'; }},
            {data:'link_public',orderable:false,searchable:false},
            {data:'action',orderable:false,searchable:false,className:'text-center'}
        ],
                error:function(xhr){
            console.error(xhr.responseText);
            errorNotify('Gagal memuat data artikel. Pastikan migrasi artikel sudah dijalankan.');
        }
    });

    @if(ucc())
    $('#form-tambah').ajaxForm({
        beforeSubmit:function(){
            $('#form-tambah .rich-editor').each(function(){ $(this).trigger('blur'); });
            disableButton('#form-tambah button[type=submit]');
        },
        success:function(r){
            if(r.status){
                $('#modal-tambah').modal('hide');
                successNotify(r.message);
                $tabel1.ajax.reload(null,true);
                $('#form-tambah').clearForm();
                clearRichEditor('#form-tambah', 'isi_artikel');
            }else{ errorNotify(r.message); }
            enableButton('#form-tambah button[type=submit]');
        },
        error:function(xhr){
            enableButton('#form-tambah button[type=submit]');
            errorNotify(xhr.responseJSON?.message || 'Terjadi kesalahan');
        }
    });
    @endif

    @if(ucu())
    $('#modal-edit').on('show.bs.modal', function(e){
        var uuid = $(e.relatedTarget).data('uuid');
        $('#form-edit').clearForm();
        $('#preview-foto').attr('src','').hide();
        clearRichEditor('#form-edit', 'isi_artikel');
        $.get("{{url($main_path.'/get-data')}}/"+uuid, function(respon){
            if(respon.status){
                $('#form-edit #uuid').val(respon.data.uuid);
                $('#form-edit #judul').val(respon.data.judul);
                $('#form-edit #ringkasan').val(respon.data.ringkasan);
                setRichEditorContent('#form-edit', 'isi_artikel', respon.data.isi_artikel || '');
                $('#form-edit #teks_foto').val(respon.data.teks_foto);
                $('#form-edit #penulis').val(respon.data.penulis);
                $('#form-edit #status').val(respon.data.status);
                $('#form-edit #published_at').val(respon.data.published_at ? respon.data.published_at.substring(0,10) : '');
                if(respon.data.foto){
                    $('#preview-foto').attr('src', adminMediaUrl(respon.data.foto)).show();
                }
            }
        });
    });

    $('#form-edit').ajaxForm({
        beforeSubmit:function(){
            $('#form-edit .rich-editor').each(function(){ $(this).trigger('blur'); });
            disableButton('#form-edit button[type=submit]');
        },
        success:function(r){
            if(r.status){
                $('#modal-edit').modal('hide');
                successNotify(r.message);
                $tabel1.ajax.reload(null,true);
            }else{ errorNotify(r.message); }
            enableButton('#form-edit button[type=submit]');
        },
        error:function(xhr){
            enableButton('#form-edit button[type=submit]');
            errorNotify(xhr.responseJSON?.message || 'Terjadi kesalahan');
        }
    });
    @endif

    @if(ucd())
    $(document).on('click','.btn-konfirm-delete',function(){
        $('#form-delete #uuid').val($(this).data('uuid'));
        $.confirm({
            title:'Konfirmasi',
            content:'Hapus artikel ini?',
            buttons:{
                ya:function(){
                    $('#form-delete').ajaxSubmit({
                        success:function(r){
                            if(r.status){
                                successNotify(r.message);
                                $tabel1.ajax.reload(null,true);
                            }else{ errorNotify(r.message); }
                        }
                    });
                },
                tidak:function(){}
            }
        });
    });
    @endif
});
</script>
@endsection
