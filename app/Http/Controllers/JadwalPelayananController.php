<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JadwalPelayananController extends Controller
{
    function index(){
    	$pagetitle = "Jadwal Pelayanan";
    	$smalltitle = "";
    	return view('master.jadwalpelayanan', compact('pagetitle','smalltitle'));
    }

    function datatable(Request $r){

        $filter = "";
        if (request()->has('search')) {
            $search = request('search');
            $keyword = $search['value'];
            if(strlen($keyword)>=3){
                $keyword = strtolower($keyword);
                $filter = " and (lower(nama_pelatihan) like '%$keyword%' or lower(nama_pelatihan) like '%$keyword%') ";
            }
        }

        $sql_union = "select * from jadwal_pelatihan $filter order by tanggal desc";
        $query = DB::table(DB::raw("($sql_union) as x"))
                    ->select(['nama_pelatihan','deskripsi','biaya','narasumber','lokasi',
                        'metode','cover','tanggal','durasi','uuid']);

        return DataTables::of($query)
            ->addColumn('status', function ($row) {
                $status = ($row->tanggal >= date('Y-m-d')) ?
                    '<span style="color: white; background-color: green; padding: 5px 10px; border-radius: 5px;">BUKA</span>' :
                    '<span style="color: black; background-color: yellow; padding: 5px 10px; border-radius: 5px;">TUTUP</span>';
                return $status;
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
            ->rawColumns(['action','status'])
            ->make(true);
    }

    function get_data($uuid){
    	$pelayanan = DB::table('jadwal_pelatihan')->where('uuid', $uuid)->first();
        if($pelayanan){
            $respon = array('status'=>true,'data'=>$pelayanan,
            	'informasi'=>'Nama Pelatihan: '. $pelayanan->nama_pelatihan);
            return response()->json($respon);
        }
        $respon = array('status'=>false,'message'=>'Data Tidak Ditemukan');
        return response()->json($respon);
    }

    function submit_insert(Request $r){
    	if($this->ucc()){
	    	loadHelper('format');
	    	$uuid = $this->genUUID();

            $r->validate([
                'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $coverPath = null;
            if ($r->hasFile('cover')) {
                $cover = $r->file('cover');
                $coverPath = $cover->store('covers', 'public');
            }

	    	$record = array(
	    		"nama_pelatihan"=>trim($r->nama_pelatihan),
	    		"deskripsi"=>trim($r->deskripsi),
                "biaya"=>$r->biaya,
                "metode"=>$r->metode,
                "lokasi"=>$r->lokasi,
                "narasumber"=>$r->narasumber,
                "tanggal"=>$r->tanggal,
                "durasi"=>$r->durasi,
                "link_pendaftaran"=>$r->link_pendaftaran,
                "cover" => $coverPath,
	    		"uuid"=>$uuid);

	    	DB::table('jadwal_pelatihan')->insert($record);
	    	$respon = array('status'=>true,'message'=>'Jadwal Berhasil Ditambahkan!', '_token'=>csrf_token());
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

            $r->validate([
                'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ]);

	    	$record = array(
	    		"nama_pelatihan"=>trim($r->nama_pelatihan),
	    		"deskripsi"=>trim($r->deskripsi),
                "biaya"=>$r->biaya,
                "metode"=>$r->metode,
                "lokasi"=>$r->lokasi,
                "narasumber"=>$r->narasumber,
                "tanggal"=>$r->tanggal,
                "durasi"=>$r->durasi,
                "link_pendaftaran"=>$r->link_pendaftaran
	    	);

            // Proses Upload Cover Baru
            if ($r->hasFile('cover')) {
                $cover = $r->file('cover');
                $coverPath = $cover->store('covers', 'public');

                $oldCover = DB::table('jadwal_pelatihan')->where('uuid', $uuid)->value('cover');
                if ($oldCover) {
                    Storage::disk('public')->delete($oldCover);
                }

                $record['cover'] = $coverPath;
            }

	    	DB::table('jadwal_pelatihan')->where('uuid', $uuid)->update($record);
	    	$respon = array('status'=>true,'message'=>'Data Jadwal Berhasil Disimpan!',
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
            $oldCover = DB::table('jadwal_pelatihan')->where('uuid', $uuid)->value('cover');
            if ($oldCover) {
                Storage::disk('public')->delete($oldCover);
            }
            DB::table('jadwal_pelatihan')->where('uuid', $uuid)->delete();
                $respon = array('status'=>true,'message'=>'Data Jadwal Berhasil Dihapus!',
                '_token'=>csrf_token());
            return response()->json($respon);
        }else{
            $respon = array('status'=>false,'message'=>'Akses Ditolak!');
            return response()->json($respon);
        }
    }
}
