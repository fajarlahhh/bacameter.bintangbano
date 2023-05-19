<?php

namespace App\Http\Controllers;

use App\Models\Pembaca;
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
            'pembaca' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'gagal',
                'data' => $validator->messages(),
            ]);
        }

        $pengguna = Pembaca::where('kode', $req->pembaca)->get();

        if ($pengguna) {
            $pengguna = $pengguna->first();
            if ($pengguna) {
                if ($pengguna->cabang_id) {
                    return response()->json([
                        'status' => 'sukses',
                        'data' => Tagihan::where(fn ($q) => $q->where('nama', 'like', '%' . $req->cari . '%')->orWhere('no_langganan', 'like', '%' . $req->cari . '%'))->groupBy('no_langganan')->select('no_langganan', 'nama', 'alamat', 'cabang_id')->whereNull('tanggal_tagih')->with('tagihan')->get(),
                    ]);
                } else {
                    return response()->json([
                        'status' => 'gagal',
                        'data' => 'Cabang pengguna tidak ada',
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 'gagal',
                    'data' => 'Pengguna tidak ditemukan',
                ]);
            }
        } else {
            return response()->json([
                'status' => 'gagal',
                'data' => 'Pengguna tidak ditemukan',
            ]);
        }
    }

    public function terbayar(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'petugas' => 'required',
            'tanggal' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'gagal',
                'data' => $validator->messages(),
            ]);
        }

        $tanggal = explode(' - ', $req->tanggal);
        $pengguna = Pembaca::where('kode', $req->petugas)->get();

        if ($pengguna) {
            $pengguna = $pengguna->first();
            return response()->json([
                'status' => 'sukses',
                'data' => Tagihan::when($pengguna->cabang_id, fn ($q) => $q->where('cabang_id', $pengguna->cabang_id))->whereBetween('tanggal_tagih', [$tanggal[0] . ' 00:00:00', $tanggal[1] . ' 23:59:59'])->get(),
            ]);
        } else {
            return response()->json([
                'status' => 'gagal',
                'data' => 'Pengguna tidak ditemukan',
            ]);
        }
    }

    public function lunasi(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required',
            'petugas' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'gagal',
                'data' => $validator->messages(),
            ]);
        }

        try {
            Tagihan::whereIn('id', $req->id)->withoutGlobalScopes()->update([
                'pembaca_kode' => $req->petugas,
                'tanggal_tagih' => now(),
                'latitude' => $req->latitude,
                'longitude' => $req->longitude,
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
