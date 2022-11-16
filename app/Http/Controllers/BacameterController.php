<?php

namespace App\Http\Controllers;

use App\Models\BacaMeter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BacameterController extends Controller
{
  //
  public function upload(Request $req)
  {
    $validator = Validator::make($req->all(), [
      'id' => 'required',
      'stand' => 'required',
      'status_baca' => 'required',
      'tanggal_baca' => 'required',
      'longitude' => 'required',
      'latitude' => 'required',
      'file' => 'required|image:jpeg,png,jpg',
    ]);
    if ($validator->fails()) {
      return response()->json([
        'status' => 'gagal',
        'data' => $validator->messages(),
      ]);
    }
    try {
      $gambar = $req->file('file');
      $extension = $gambar->getClientOriginalExtension();
      $namaFile = date('YmdHims') . time() . uniqid() . '_' . $req->id;
      Storage::disk('local')->putFileAs('public/foto', $gambar, $namaFile . '.' . $extension);
      BacaMeter::where('id', $req->id)->withoutGlobalScopes()->update([
        'stand_ini' => $req->stand,
        'status_baca' => $req->stand,
        'tanggal_baca' => $req->tanggal_baca,
        'latitude' => $req->latitude,
        'longitude' => $req->longitude,
        'foto' => 'public/foto/' . $namaFile . '.' . $extension,
      ]);
      return response()->json([
        'status' => 'sukses',
        'data' => null,
      ]);
    } catch (\Exception$e) {
      return response()->json([
        'status' => 'gagal',
        'data' => $e->getMessage(),
      ]);
    }
  }
}