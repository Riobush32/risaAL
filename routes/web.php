<?php

use App\Http\Controllers\BahanBaku;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Query\IndexHint;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\BiayaPemesananController;
use App\Http\Controllers\BiayaPenyimpananController;

Route::middleware(['auth'])->group(function () {

    Route::get('/bahan-baku', [BahanBakuController::class, 'index']);
    Route::post('/bahan-baku', [BahanBakuController::class, 'store']);
    Route::patch('/bahan-baku/{id}', [BahanBakuController::class, 'update']);
    Route::delete('/bahan-baku/{id}', [BahanBakuController::class, 'destroy']);

    Route::get('/biaya-pemesanan', [BiayaPemesananController::class, 'index']);
    Route::post('/biaya-pemesanan', [BiayaPemesananController::class, 'store']);
    Route::patch('/biaya-pemesanan/{id}', [BiayaPemesananController::class, 'update']);
    Route::delete('/biaya-pemesanan/{id}', [BiayaPemesananController::class, 'destroy']);

    Route::get('/biaya-penyimpanan', [BiayaPenyimpananController::class, 'index']);
    Route::post('/biaya-penyimpanan', [BiayaPenyimpananController::class, 'store']);
    Route::patch('/biaya-penyimpanan/{id}', [BiayaPenyimpananController::class, 'update']);
    Route::delete('/biaya-penyimpanan/{id}', [BiayaPenyimpananController::class, 'destroy']);

    // Route::get('/hasil', [HasilController::class, 'index']);
    Route::get('/hasil-input', [HasilController::class, 'input']);
    Route::post('/hasil-input', [HasilController::class, 'store']);
    Route::patch('/hasil-input/{id}', [HasilController::class, 'update']);
    Route::delete('/hasil-input/{id}', [HasilController::class, 'destroy']);
    Route::get('/proses/{id}', [HasilController::class, 'index']);
});

// Route::get('/dashboard', function () {
//     return view('pages.dashboard.index', [
//         'title' => 'Dashboard'
//     ]);
// });

Route::get('/', function () {
    return view('pages.home.index', [
        'title' => 'home'
    ]);
});
