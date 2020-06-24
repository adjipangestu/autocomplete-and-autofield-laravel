<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class JajanController extends Controller
{
    public function index()
    {
        $data_pasien = DB::table('data_pasien')->get();

        return view('welcome')->with([
            'data_pasien' => $data_pasien
        ]);
    }

    public function data_pasien(Request $request)
    {
        $search = $request->cari;

        if($search == ''){
           $data_pasien = DB::table('data_pasien')
                            ->join('data_faskes', 'data_faskes.id', '=', 'data_pasien.id_faskes')
                            ->join('data_kecamatan', 'data_kecamatan.id', '=', 'data_pasien.id_kecamatan')
                            ->select('data_pasien.id','data_pasien.nama_pasien', 'data_faskes.nama_faskes', 'data_kecamatan.nama_kecamatan')
                            ->limit(5)->get();
        }else{
           $data_pasien = DB::table('data_pasien')
                            ->join('data_faskes', 'data_faskes.id', '=', 'data_pasien.id_faskes')
                            ->join('data_kecamatan', 'data_kecamatan.id', '=', 'data_pasien.id_kecamatan')
                            ->select('data_pasien.id','data_pasien.nama_pasien', 'data_faskes.nama_faskes', 'data_kecamatan.nama_kecamatan')
                            ->where('data_pasien.nama_pasien', 'like', '%' .$search . '%')
                            ->limit(5)->get();
        }
  
        $response = array();
        foreach($data_pasien as $pasien){
           $response[] = array(
               "value" => $pasien->id,
               "label" => $pasien->nama_pasien,
               "faskes" => $pasien->nama_faskes,
               "kecamatan" => $pasien->nama_kecamatan
            );
        }
        return response()->json($response);
    }
}
