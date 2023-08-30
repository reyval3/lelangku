<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LelangController extends Controller
{
  
    //     public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function GetLelang()
    {
        try {
            $tasks = DB::table('tb_lelang as l')
            ->JOIN('tb_barang as b', 'l.id_barang', '=', 'b.id_barang' )
            ->get();
            return response()->json(['status' => true, 'data' => $tasks]);
        } catch (Exception $error) {
            return response()->json(['status' => false, 'error' => $error]);
        }
    }

    public function ImputDB(Request $request)
    {
        try {
            DB::table('tb_lelang')->insert([
                'id_barang' => $request->id_barang,
                'id_user' => $request->id_user,
                 'tanggal' => $request->tanggal,
                'harga_akhir' => $request->harga_akhir,
                'status' => $request->status
            ]);
            return response()->json(['status' => true]);
        } catch (Exception $error) {
            return response()->json(['status' => false, 'error' => $error]);
        }
    }

    public function GetID(Request $request)
    {
        try {
            $tasks = DB::table('tb_lelang')
                ->where('id_lelang', $request['id_lelang'])
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
            $update = DB::table('tb_lelang')
                ->where('id_lelang', $request['id_lelang'])
                ->limit(1)
                ->update([
                    'id_barang' => $request->id_barang,
                    'id_user' => $request->id_user,
                     'tanggal' => $request->tanggal,
                    'harga_akhir' => $request->harga_akhir,
                    'status' => $request->status
                ]);
            return response()->json(['status' => true]);
        } catch (Exception $error) {
            return response()->json(['status' => false, 'error' => $error]);
        }
    }

    public function Hapus(Request $req)
    {
        try {
            DB::table('tb_lelang')
                ->where('id_lelang', $req['id_lelang'])
                ->delete();
            return response()->json(['status' => true]);
        } catch (Exception $error) {
            return response()->json(['status' => false, 'error' => $error]);
        }
    }

}
