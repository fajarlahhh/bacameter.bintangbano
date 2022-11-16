<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
Route::get('/', function () {
  return "Habit API";
});

Route::get('/statusbaca/{pembaca}', function ($pembaca) {
  $pembaca = \App\Models\Pembaca::where('uid', $pembaca)->withoutGlobalScopes()->first();
  return \App\Models\StatusBaca::withoutGlobalScopes()->where('pengguna_id', $pembaca->pengguna_id)->get();
});

Route::get('/targetbaca/{pembaca}', function ($pembaca) {
  $pembaca = \App\Models\Pembaca::where('uid', $pembaca)->withoutGlobalScopes()->first();
  return \App\Models\BacaMeter::withoutGlobalScopes()->where('pengguna_id', $pembaca->pengguna_id)->get();
});
