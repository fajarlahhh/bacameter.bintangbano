<?php

namespace App\Http\Controllers;

use App\Models\BacaMeter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BacameterController extends Controller
{
  //
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
      BacaMeter::where('id', $req->id)->withoutGlobalScopes()->update([
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
