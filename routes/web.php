<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', \App\Http\Livewire\Dashboard::class);
    Route::get('/dashboard', \App\Http\Livewire\Dashboard::class)->name('dashboard');
    Route::view('/gantisandi', 'pages.ganti-sandi');

    Route::group(['middleware' => ['admin']], function () {
        Route::prefix('pengguna')->group(function () {
            Route::get('/', \App\Http\Livewire\Pengguna\Index::class);
            Route::get('/tambah', \App\Http\Livewire\Pengguna\Form::class);
            Route::get('/edit/{key}', \App\Http\Livewire\Pengguna\Form::class);
        });
    });
    Route::prefix('petugas')->group(function () {
        Route::get('/', \App\Http\Livewire\Pembaca\Index::class);
        Route::get('/tambah', \App\Http\Livewire\Pembaca\Form::class);
        Route::get('/edit/{key}', \App\Http\Livewire\Pembaca\Form::class);
    });
    Route::prefix('statusbaca')->group(function () {
        Route::get('/', \App\Http\Livewire\Statusbaca\Index::class);
        Route::get('/tambah', \App\Http\Livewire\Statusbaca\Form::class);
        Route::get('/edit/{key}', \App\Http\Livewire\Statusbaca\Form::class);
    });
    Route::prefix('cabang')->group(function () {
        Route::get('/', \App\Http\Livewire\Cabang\Index::class);
        Route::get('/tambah', \App\Http\Livewire\Cabang\Form::class);
        Route::get('/edit/{key}', \App\Http\Livewire\Cabang\Form::class);
    });
    Route::prefix('targetbaca')->group(function () {
        Route::get('/', \App\Http\Livewire\Targetbaca\Index::class);
        Route::get('/import', \App\Http\Livewire\Targetbaca\Import::class);
    });
    Route::prefix('targetpenagihan')->group(function () {
        Route::get('/', \App\Http\Livewire\Targetpenagihan\Index::class);
        Route::get('/import', \App\Http\Livewire\Targetpenagihan\Import::class);
    });
});
