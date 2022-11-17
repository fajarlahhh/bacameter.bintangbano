<?php

use App\Http\Controllers\BacameterController;
use App\Http\Controllers\StatusbacaController;
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

Route::middleware(['cors'])->post('/statusbaca/{pembaca}', function ($pembaca) {
  $pembaca = \App\Models\Pembaca::where('uid', $pembaca)->withoutGlobalScopes()->first();
  return response()->json([
    'status' => 'sukses',
    'data' => \App\Models\StatusBaca::withoutGlobalScopes()->where('pengguna_id', $pembaca->pengguna_id)->get(),
  ]);
});

Route::middleware(['cors'])->post('/bacameter/target/{pembaca}/{periode}', function ($pembaca, $periode) {
  $pembaca = \App\Models\Pembaca::where('uid', $pembaca)->withoutGlobalScopes()->first();
  return response()->json([
    'status' => 'sukses',
    'data' => \App\Models\BacaMeter::withoutGlobalScopes()->where('periode', $periode)->where('pembaca_kode', $pembaca)->where('pengguna_id', $pembaca->pengguna_id)->get(),
  ]);
});

Route::middleware(['cors'])->post('/penagihan/target/{pembaca}', function ($pembaca, $periode) {
  $pembaca = \App\Models\Pembaca::where('uid', $pembaca)->withoutGlobalScopes()->first();
  return response()->json([
    'status' => 'sukses',
    'data' => \App\Models\Tagihan::withoutGlobalScopes()->where('pembaca_kode', $pembaca)->where('pengguna_id', $pembaca->pengguna_id)->get(),
  ]);
});
Route::middleware(['cors'])->post('/login', [StatusbacaController::class, 'index']);

Route::middleware(['cors'])->post('/statusbaca', [StatusbacaController::class, 'index']);
Route::middleware(['cors'])->post('/bacameter/upload/{pembaca}', [BacameterController::class, 'upload']);
Route::middleware(['cors'])->post('/penagihan/lunasi/{pembaca}', [PenagihanController::class, 'lunasi']);
