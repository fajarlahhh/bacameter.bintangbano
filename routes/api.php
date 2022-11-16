<?php

use App\Http\Controllers\BacameterController;
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
Route::middleware(['cors'])->get('/', function () {
  return response()->json([
    'status' => 'sukses',
    'data' => '',
  ]);
});

Route::middleware(['cors'])->get('/statusbaca/{pembaca}', function ($pembaca) {
  $pembaca = \App\Models\Pembaca::where('uid', $pembaca)->withoutGlobalScopes()->first();
  return response()->json([
    'status' => 'sukses',
    'data' => \App\Models\StatusBaca::withoutGlobalScopes()->where('pengguna_id', $pembaca->pengguna_id)->get(),
  ]);
});

Route::middleware(['cors'])->get('/targetbaca/{pembaca}', function ($pembaca) {
  $pembaca = \App\Models\Pembaca::where('uid', $pembaca)->withoutGlobalScopes()->first();
  return response()->json([
    'status' => 'sukses',
    'data' => \App\Models\BacaMeter::withoutGlobalScopes()->where('pengguna_id', $pembaca->pengguna_id)->get(),
  ]);
});

Route::middleware(['cors'])->post('/upload/{pembaca}', [BacameterController::class, 'upload']);
