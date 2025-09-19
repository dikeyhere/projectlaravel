<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/pegawai', function () {
//     return view('hrd/pegawai');
// });

Route::resource('pegawais', PegawaiController::class);
Route::get('pegawais/{id}/restore', [PegawaiController::class, 'restore'])->name('pegawais.restore');
Route::delete('pegawais/{id}/force-delete', [PegawaiController::class, 'forceDelete'])->name('pegawais.forceDelete');