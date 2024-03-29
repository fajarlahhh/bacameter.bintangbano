<?php

namespace App\Http\Controllers;

use App\Models\Pembaca;
use App\Models\BacaMeter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class BacameterController extends Controller
{
    //
    public function index(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'pembaca' => 'required',
            'periode' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'gagal',
                'data' => $validator->messages(),
            ]);
        }

        $pembaca = Pembaca::where('uid', $req->pembaca)->withoutGlobalScopes()->get();
        if ($pembaca->count() > 0) {
            return response()->json([
                'status' => 'sukses',
                'data' => BacaMeter::withoutGlobalScopes()->where('periode', $req->periode)->whereNull('tanggal_baca')->where('pembaca_kode', $pembaca->first()->kode)->get(),
            ]);
        }
    }

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
            $namaFile = date('YmdHims') . time() . uniqid() . '.jpg';
            $file = Image::make($gambar)->encode('jpg', 0)->resize(300, null, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            Storage::put('public/foto2/' . $namaFile, $file->stream());
            //Storage::putFileAs('public/foto/', $gambar, $namaFile);
            BacaMeter::where('id', $req->id)->withoutGlobalScopes()->update([
                'stand_ini' => $req->stand,
                'status_baca' => $req->status_baca,
                'tanggal_baca' => $req->tanggal_baca,
                'latitude' => $req->latitude,
                'longitude' => $req->longitude,
                'foto' => 'public/foto2/' . $namaFile ,
            ]);
            return response()->json([
                'status' => 'sukses',
                'data' => null,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'gagal',
                'data' => $e->getMessage(),
            ]);
        }
    }
}
