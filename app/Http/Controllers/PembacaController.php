<?php

namespace App\Http\Controllers;

use App\Models\Pembaca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PembacaController extends Controller
{
    //
    public function login(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'pembaca' => 'required',
            'sandi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'gagal',
                'data' => $validator->messages(),
            ]);
        }

        $pembaca = Pembaca::where('uid', $req->pembaca)->withoutGlobalScopes()->get();

        if ($pembaca->count() > 0) {
            $pembaca = $pembaca->first();
            if (!Hash::check($req->sandi, $pembaca->kata_sandi)) {
                return response()->json([
                    'status' => 'gagal',
                    'data' => 'Kata sandi salah',
                ]);
            }
            return response()->json([
                'status' => 'sukses',
                'data' => $pembaca,
            ]);
        }
        return response()->json([
            'status' => 'gagal',
            'data' => 'Tidak ada data petugas',
        ]);
    }
}
