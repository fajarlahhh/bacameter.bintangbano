<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenagihanController extends Controller
{
  //
  public function index(Request $req)
  {
    $validator = Validator::make($req->all(), [
      'cari' => 'required',
    ]);
    if ($validator->fails()) {
      return response()->json([
        'status' => 'gagal',
        'data' => $validator->messages(),
      ]);
    }

    return response()->json([
      'status' => 'sukses',
      'data' => Tagihan::where('nama', 'like', '%' . $req->cari . '%')->orWhere('no_langganan', 'like', '%' . $req->cari . '%')->get(),
    ]);
  }

  public function lunasi(Request $req)
  {
    $validator = Validator::make($req->all(), [
      'id' => 'required',
      'tanggal_tagih' => 'required',
      'longitude' => 'required',
      'latitude' => 'required',
    ]);
    if ($validator->fails()) {
      return response()->json([
        'status' => 'gagal',
        'data' => $validator->messages(),
      ]);
    }

    try {
      Tagihan::where('id', $req->id)->withoutGlobalScopes()->update([
        'tanggal_tagih' => $req->tanggal_tagih,
        'latitude' => $req->latitude,
        'longitude' => $req->longitude,
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
