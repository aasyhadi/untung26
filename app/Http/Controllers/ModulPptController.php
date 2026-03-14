<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ModulPptController extends Controller
{
    function index(){
    	$pagetitle = "Master Modul PPT";
    	$smalltitle = "";
    	return view('master.modulppt', compact('pagetitle','smalltitle'));
    }

    function datatable(Request $r){

        $filter = "";
        if (request()->has('search')) {
            $search = request('search');
            $keyword = $search['value'];
            if(strlen($keyword)>=3){
                $keyword = strtolower($keyword);
                $filter = " and (lower(nama_modul) like '%$keyword%' or lower(nama_modul) like '%$keyword%') ";
            }
        }

        $sql_union = "select * from modulppt $filter order by id_modul";
        $query = DB::table(DB::raw("($sql_union) as x"))
                    ->select(['nama_modul','deskripsi','harga','type_file',
                        'cover','modul_link','landing_page_link','uuid']);

        return DataTables::of($query)
            ->addColumn('epayment', function ($row) {
                if ($row->landing_page_link) {
                    return '<a href="' . url($row->landing_page_link) . '" target="_blank">Lihat Landing Page</a>';
                } else {
                    return 'Belum tersedia';
                }
            })
            ->addColumn('edocument', function ($row) {
                if ($row->modul_link) {
                    return '<a href="' . url($row->modul_link) . '" target="_blank">Lihat Document</a>';
                } else {
                    return 'Belum tersedia';
                }
            })
            ->addColumn('action', function ($query) {
                    $edit = ""; $delete = "";
                    if($this->ucu()){
                        $edit = '<button data-bs-toggle="modal" data-uuid="'.$query->uuid.'" data-bs-target="#modal-edit" class="btn btn-outline-secondary btn-outline btn-sm" type="button"><i class="las la-pen"></i></button>';
                    }
                    if($this->ucd()){
                        $delete = '<button  data-uuid="'.$query->uuid.'" class="btn btn-outline-secondary btn-sm btn-konfirm-delete" type="button"><i class="las la-trash"></i></button>';
                    }
                    $action =  $edit." ".$delete;
                    if ($action==""){$action='<a href="#" class="act"><i class="la la-lock"></i></a>'; }
                        return $action;
            })
            ->addIndexColumn()
            ->rawColumns(['action','epayment','edocument'])
            ->make(true);
    }

    function get_data($uuid){
    	$modulppt = DB::table('modulppt')->where('uuid', $uuid)->first();
        if($modulppt){
            $respon = array('status'=>true,'data'=>$modulppt,
            	'informasi'=>'Nama Modul: '. $modulppt->nama_modul);
            return response()->json($respon);
        }
        $respon = array('status'=>false,'message'=>'Data Tidak Ditemukan');
        return response()->json($respon);
    }

    function submit_insert(Request $r){
    	if($this->ucc()){
	    	loadHelper('format');
	    	$uuid = $this->genUUID();

            $coverPath = null;
            if ($r->hasFile('cover')) {
                $cover = $r->file('cover');
                $coverPath = $cover->store('covers', 'public');
            }

	    	$record = array(
	    		"nama_modul"=>trim($r->nama_modul),
	    		"deskripsi"=>trim($r->deskripsi),
                "harga"=>$r->harga,
                "type_file"=>$r->type_file,
                "modul_link"=>$r->modul_link,
                "landing_page_link"=>$r->landing_page_link,
                "cover" => $coverPath,
	    		"uuid"=>$uuid);

	    	DB::table('modulppt')->insert($record);
	    	$respon = array('status'=>true,'message'=>'Modul Berhasil Ditambahkan!', '_token'=>csrf_token());
        	return response()->json($respon);
    	}else{
    		$respon = array('status'=>false,'message'=>'Akses Ditolak!');
        	return response()->json($respon);
    	}
    }

    function submit_update(Request $r){
    	if($this->ucu()){
	    	loadHelper('format');
	    	$uuid = $r->uuid;

	    	$record = array(
	    		"nama_modul"=>trim($r->nama_modul),
	    		"deskripsi"=>trim($r->deskripsi),
                "harga"=>$r->harga,
                "type_file"=>$r->type_file,
                "modul_link"=>$r->modul_link,
                "landing_page_link"=>$r->landing_page_link
	    	);

            // Proses Upload Cover Baru
            if ($r->hasFile('cover')) {
                $cover = $r->file('cover');
                $coverPath = $cover->store('covers', 'public');

                $oldCover = DB::table('template')->where('uuid', $uuid)->value('cover');
                if ($oldCover) {
                    Storage::disk('public')->delete($oldCover);
                }

                $record['cover'] = $coverPath;
            }

	    	DB::table('modulppt')->where('uuid', $uuid)->update($record);
	    	$respon = array('status'=>true,'message'=>'Data Modul Berhasil Disimpan!',
	    		'_token'=>csrf_token());
        	return response()->json($respon);
    	}else{
    		$respon = array('status'=>false,'message'=>'Akses Ditolak!');
        	return response()->json($respon);
    	}
    }

    function submit_delete(Request $r){
        if($this->ucd()){
            loadHelper('format');
            $uuid = $r->uuid;
            $oldCover = DB::table('modulppt')->where('uuid', $uuid)->value('cover');
            if ($oldCover) {
                Storage::disk('public')->delete($oldCover);
            }
            DB::table('modulppt')->where('uuid', $uuid)->delete();
                $respon = array('status'=>true,'message'=>'Data Modul Berhasil Dihapus!',
                '_token'=>csrf_token());
            return response()->json($respon);
        }else{
            $respon = array('status'=>false,'message'=>'Akses Ditolak!');
            return response()->json($respon);
        }
    }
}
