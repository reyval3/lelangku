<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LelangController;
use App\Http\Controllers\HistoryController;




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/ceklogin', [AuthController::class, 'ceklogin']);
    Route::get('/notlogin', [AuthController::class, 'notlogin'])->name('notlogin');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);  
    Route::get('/ubah-password', [AuthController::class, 'ubahpassword']);  

    Route::prefix('lelang')->group(function () {
        Route::get('/', [LelangController::class, 'GetLelang']);
        Route::post('/store', [LelangController::class, 'ImputDB']);
        Route::get('/edit', [LelangController::class, 'GetID']);
        Route::put('/update', [LelangController::class, 'Update']);
        Route::delete('/hapus', [LelangController::class, 'Hapus']);
    });

    Route::prefix('barang')->group(function () {
        Route::get('/', [BarangController::class, 'Get']);
        Route::post('/store', [BarangController::class, 'ImputDB']);
        Route::get('/edit', [BarangController::class, 'GetID']);
        Route::put('/update', [BarangController::class, 'Update']);
        Route::delete('/hapus', [BarangController::class, 'Hapus']);
    });

    Route::prefix('history')->group(function () {
        Route::get('/', [HistoryController::class, 'Get']);
        Route::post('/store', [HistoryController::class, 'ImputDB']);
        Route::get('/edit', [HistoryController::class, 'GetID']);
        Route::put('/update', [HistoryController::class, 'Update']);
        Route::delete('/hapus', [HistoryController::class, 'Hapus']);
    });
});  
