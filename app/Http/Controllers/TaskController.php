<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function GetTask()
    {
        try {
            $tasks = DB::table('task as t')
            ->join('project as p', 'p.id_project', '=', 't.id_merge')
            ->paginate(1);
            dd($tasks);
            return response()->json(['status' => true, 'data' => $tasks]);
        } catch (Exception $error) {
            return response()->json(['status' => false, 'error' => $error]);
        }
    }

    public function ImputDBTask(Request $request)
    {
        try {
            DB::table('task')->insert([
                'id_task' => $request->id_task,
                'nama_task' => $request->nama_task,
                 'detail_task' => $request->detail_task,
                'id_merge' => $request->id_merge,
                'status' => $request->status
            ]);
            return response()->json(['status' => true]);
        } catch (Exception $error) {
            return response()->json(['status' => false, 'error' => $error]);
        }
    }

    public function GetIDTask(Request $request)
    {
        try {
            $tasks = DB::table('task as t')
            ->join('project as p', 'p.id_project', '=', 't.id_merge')
                ->where('id_task', $request['id_task'])
                ->get();
            return response()->json([
                'status' => true,
                'data' => $tasks,
            ]);
        } catch (Exception $error) {
            return response()->json(['status' => false, 'error' => $error]);
        }
    }

    public function UpdateTask(Request $request)
    {
        try {
            $update = DB::table('task')
                ->where('id_task', $request['id_task'])
                ->limit(1)
                ->update([
                    'id_task' => $request->id_task,
                    'nama_task' => $request->nama_task,
                     'detail_task' => $request->detail_task,
                    'status' => $request->status
                ]);
            return response()->json(['status' => true]);
        } catch (Exception $error) {
            return response()->json(['status' => false, 'error' => $error]);
        }
    }

    public function HapusTask(Request $req)
    {
        try {
            DB::table('task')
                ->where('id_task', $req['id_task'])
                ->delete();
            return response()->json(['status' => true]);
        } catch (Exception $error) {
            return response()->json(['status' => false, 'error' => $error]);
        }
    }
    
}
