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