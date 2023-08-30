<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BarangController extends Controller
{
  
    //     public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function Get()
    {
        try {
            $tasks = DB::table('tb_barang as l')
            ->get();
            return response()->json(['status' => true, 'data' => $tasks]);
        } catch (Exception $error) {
            return response()->json(['status' => false, 'error' => $error]);
        }
    }

    public function ImputDB(Request $request)
    {
        try {
            DB::table('tb_barang')->insert([
                'nama_barang' => $request->nama_barang,
                'harga_awal' => $request->harga_awal,
                 'tanggal' => $request->tanggal,
                'deskripsi_barang' => $request->deskripsi_barang,
            ]);
            return response()->json(['status' => true]);
        } catch (Exception $error) {
            return response()->json(['status' => false, 'error' => $error]);
        }
    }

    public function GetID(Request $request)
    {
        try {
            $tasks = DB::table('tb_barang')
                ->where('id_barang', $request['id_barang'])
                ->get();
            return response()->json([
                'status' => true,
                'data' => $tasks,
            ]);
        } catch (Exception $error) {
            return response()->json(['status' => false, 'error' => $error]);
        }
    }

    public function Update(Request $request)
    {
        try {
            $update = DB::table('tb_barang')
                ->where('id_barang', $request['id_barang'])
                ->limit(1)
                ->update([
                    'nama_barang' => $request->nama_barang,
                    'harga_awal' => $request->harga_awal,
                     'tanggal' => $request->tanggal,
                    'deskripsi_barang' => $request->deskripsi_barang,

                ]);
            return response()->json(['status' => true]);
        } catch (Exception $error) {
            return response()->json(['status' => false, 'error' => $error]);
        }
    }

    public function Hapus(Request $req)
    {
        try {
            DB::table('tb_barang')
                ->where('id_barang', $req['id_barang'])
                ->delete();
            return response()->json(['status' => true]);
        } catch (Exception $error) {
            return response()->json(['status' => false, 'error' => $error]);
        }
    }

}
