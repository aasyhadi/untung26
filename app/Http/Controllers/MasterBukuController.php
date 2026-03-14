<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Crypt;

class MasterBukuController extends Controller
{
    function index(){
    	$pagetitle = "Master Buku";
    	$smalltitle = "";
    	return view('master.buku', compact('pagetitle','smalltitle'));
    }

    function datatable(Request $r){

        $filter = "";
        if (request()->has('search')) {
            $search = request('search');
            $keyword = $search['value'];
            if(strlen($keyword)>=3){
                $keyword = strtolower($keyword);
                $filter = " and (lower(judul) like '%$keyword%' or lower(judul) like '%$keyword%') ";
            }
        }

        $sql_union = "select * from buku $filter order by id_buku";
        $query = DB::table(DB::raw("($sql_union) as x"))
                    ->select(['judul','penulis','tahun_terbit',
                        'isbn','penerbit','deskripsi','cover','harga','harga_ebook',
                        'ebook_link','landing_page_link','uuid']);

        return DataTables::of($query)
            ->addColumn('epayment', function ($row) {
                if ($row->landing_page_link) {
                    return '<a href="' . url($row->landing_page_link) . '" target="_blank">Lihat Landing Page</a>';
                } else {
                    return 'Belum tersedia';
                }
            })
            ->addColumn('ebook', function ($row) {
                if ($row->ebook_link) {
                    return '<a href="' . url($row->ebook_link) . '" target="_blank">Lihat eBook</a>';
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
            ->rawColumns(['action','epayment','ebook'])
            ->make(true);
    }

    function get_data($uuid){
    	$buku = DB::table('buku')->where('uuid', $uuid)->first();
        if($buku){
            $respon = array('status'=>true,'data'=>$buku,
            	'informasi'=>'Judul Buku: '. $buku->judul);
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
	    		"judul"=>trim($r->judul),
	    		"penulis"=>trim($r->penulis),
	    		"tahun_terbit"=>$r->tahun_terbit,
	    		"deskripsi"=>$r->deskripsi,
                "penerbit"=>$r->penerbit,
                "isbn"=>$r->isbn,
                "harga"=>$r->harga,
                "harga_ebook"=>$r->harga_ebook,
                "ebook_link"=>$r->ebook_link,
                "landing_page_link"=>$r->landing_page_link,
                "cover" => $coverPath,
	    		"uuid"=>$uuid);

	    	DB::table('buku')->insert($record);
	    	$respon = array('status'=>true,'message'=>'Buku Berhasil Ditambahkan!', '_token'=>csrf_token());
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
	    		"judul"=>trim($r->judul),
	    		"penulis"=>trim($r->penulis),
	    		"tahun_terbit"=>$r->tahun_terbit,
	    		"penerbit"=>$r->penerbit,
                "isbn"=>$r->isbn,
                "harga"=>$r->harga,
                "harga_ebook"=>$r->harga_ebook,
                "ebook_link"=>$r->ebook_link,
                "landing_page_link"=>$r->landing_page_link,
                "deskripsi"=>$r->deskripsi
	    	);

            // Proses Upload Cover Baru
            if ($r->hasFile('cover')) {
                $cover = $r->file('cover');
                $coverPath = $cover->store('covers', 'public');

                $oldCover = DB::table('buku')->where('uuid', $uuid)->value('cover');
                if ($oldCover) {
                    Storage::disk('public')->delete($oldCover);
                }

                $record['cover'] = $coverPath;
            }

	    	DB::table('buku')->where('uuid', $uuid)->update($record);
	    	$respon = array('status'=>true,'message'=>'Data Buku Berhasil Disimpan!',
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
            $oldCover = DB::table('buku')->where('uuid', $uuid)->value('cover');
            if ($oldCover) {
                Storage::disk('public')->delete($oldCover);
            }
            DB::table('buku')->where('uuid', $uuid)->delete();
                $respon = array('status'=>true,'message'=>'Data Buku Berhasil Dihapus!',
                '_token'=>csrf_token());
            return response()->json($respon);
        }else{
            $respon = array('status'=>false,'message'=>'Akses Ditolak!');
            return response()->json($respon);
        }
    }

}
