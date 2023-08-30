<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HistoryController extends Controller
{
  
    //     public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function Get()
    {
        try {
            $tasks = DB::table('history_lelang as l')
            ->get();
            return response()->json(['status' => true, 'data' => $tasks]);
        } catch (Exception $error) {
            return response()->json(['status' => false, 'error' => $error]);
        }
    }

    public function ImputDB(Request $request)
    {
        try {
            DB::table('history_lelang')->insert([
                'id_lelang' => $request->id_lelang,
                'id_user' => $request->id_user,
                 'id_barang' => $request->id_barang,
            ]);
            return response()->json(['status' => true]);
        } catch (Exception $error) {
            return response()->json(['status' => false, 'error' => $error]);
        }
    }

    public function GetID(Request $request)
    {
        try {
            $tasks = DB::table('history_lelang')
                ->where('id_history', $request['id_history'])
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
            $update = DB::table('history_lelang')
                ->where('id_history', $request['id_history'])
                ->limit(1)
                ->update([
                    'id_lelang' => $request->id_lelang,
                    'id_user' => $request->id_user,
                     'id_barang' => $request->id_barang,
                ]);
            return response()->json(['status' => true]);
        } catch (Exception $error) {
            return response()->json(['status' => false, 'error' => $error]);
        }
    }

    public function Hapus(Request $req)
    {
        try {
            DB::table('history_lelang')
                ->where('id_history', $req['id_history'])
                ->delete();
            return response()->json(['status' => true]);
        } catch (Exception $error) {
            return response()->json(['status' => false, 'error' => $error]);
        }
    }

}
