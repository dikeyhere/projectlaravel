<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/pegawai', function () {
//     return view('hrd/pegawai');
// });
// Route::get('/', function () {
//     return redirect()->route('login');
// });

Route::get('/', function () {
    if (!Auth::check()) {
        return view('auth.login');
    }
    return redirect()->route('pegawais.index');
});

// Route::resource('pegawais', PegawaiController::class);
// Route::get('pegawais/{id}/restore', [PegawaiController::class, 'restore'])->name('pegawais.restore');
// Route::delete('pegawais/{id}/force-delete', [PegawaiController::class, 'forceDelete'])->name('pegawais.forceDelete');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('pegawais', PegawaiController::class);
    Route::get('pegawais/{id}/restore', [PegawaiController::class, 'restore'])
        ->name('pegawais.restore');
    Route::delete('pegawais/{id}/force-delete', [PegawaiController::class, 'forceDelete'])
        ->name('pegawais.forceDelete');
});
