<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Carbon\Carbon;

class KonsulTerjawabController extends Controller
{
    function index(){
    	$pagetitle = "Status Kiriman Konsultasi";
    	$smalltitle = "";
    	return view('order.jawaban', compact('pagetitle','smalltitle'));
    }

    function datatable(Request $r){

        $filter = "";
        if (request()->has('search')) {
            $search = request('search');
            $keyword = $search['value'];
            if(strlen($keyword)>=3){
                $keyword = strtolower($keyword);
                $filter = " and (lower(nama) like '%$keyword%' or lower(nama) like '%$keyword%') ";
            }
        }

        $sql_union = "select * from konsultasi $filter where status = 8 order by id";
        $query = DB::table(DB::raw("($sql_union) as x"))
                    ->select(['nama','whatsapp','email','tanggal',
                        'pertanyaan','jawaban','status','uuid']);

        return DataTables::of($query)
            ->addColumn('status', function ($row) {
                if ($row->status == 8) {
                    return '<span style="color: white; background-color: green; padding: 5px 10px; border-radius: 5px;">TERKIRIM</span>';
                }
                return 'Lainnya'; // Atau sesuaikan dengan status lain
            })
            ->addColumn('tanggal', function ($row) {
                return Carbon::parse($row->tanggal)->translatedFormat('d F Y');
            })
            ->addColumn('action', function ($query) {
                    $edit = ""; $ulang = "";
                    if($this->ucu()){
                        $edit = '<button data-bs-toggle="modal" data-uuid="'.$query->uuid.'" data-bs-target="#modal-edit" class="btn btn-outline-secondary btn-outline btn-sm" type="button"><i class="las la-eye"></i> Lihat Konsul</button>';
                        $ulang = '<button data-bs-toggle="modal" data-uuid="'.$query->uuid.'" data-bs-target="#modal-ulang" class="btn btn-outline-secondary btn-outline btn-sm" type="button"><i class="las la-sync"></i> Kirim Ulang</button>';
                    }
                    $action =  $edit." ".$ulang;
                    if ($action==""){$action='<a href="#" class="act"><i class="la la-lock"></i></a>'; }
                        return $action;
            })
            ->addIndexColumn()
            ->rawColumns(['action','status'])
            ->make(true);
    }

    function get_data($uuid){
    	$konsul = DB::table('konsultasi')->where('uuid', $uuid)->first();
        if($konsul){
            $respon = array('status'=>true,'data'=>$konsul,
            	'informasi'=>'Nama: '. $konsul->nama);
            return response()->json($respon);
        }
        $respon = array('status'=>false,'message'=>'Data Tidak Ditemukan');
        return response()->json($respon);
    }

    function submit_update(Request $r){
    	if($this->ucu()){
	    	loadHelper('format');
	    	$uuid = $r->uuid;

	    	$record = array(
	    		"jawaban"=>$r->jawaban
	    	);

	    	DB::table('konsultasi')->where('uuid', $uuid)->update($record);
	    	$respon = array('status'=>true,'message'=>'Jawaban Konsul Berhasil Dikirim Ulang!',
	    		'_token'=>csrf_token());
        	return response()->json($respon);
    	}else{
    		$respon = array('status'=>false,'message'=>'Akses Ditolak!');
        	return response()->json($respon);
    	}
    }

}
