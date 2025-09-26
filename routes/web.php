<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    if (!Auth::check()) {
        return view('auth.login');
    }
    return redirect()->route('pegawais.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('pegawais', PegawaiController::class);
    Route::get('pegawais/{id}/restore', [PegawaiController::class, 'restore'])
        ->name('pegawais.restore');
    Route::delete('pegawais/{id}/force-delete', [PegawaiController::class, 'forceDelete'])
        ->name('pegawais.forceDelete');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/password/reset', [PasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [PasswordController::class, 'updatePassword'])->name('password.update');
    Route::post('/password/update', [PasswordController::class, 'update'])->name('password.update')->middleware('auth');

    Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');

});
});
