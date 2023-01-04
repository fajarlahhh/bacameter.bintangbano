<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Carbon\Carbon;
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
            'data' => Tagihan::where('nama', 'like', '%' . $req->cari . '%')->orWhere('no_langganan', 'like', '%' . $req->cari . '%')->groupBy('no_langganan')->select('no_langganan', 'nama', 'alamat')->whereNull('tanggal_tagih')->with('tagihan')->get(),
        ]);
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
        return response()->json([
            'status' => 'sukses',
            'data' => Tagihan::whereBetween('tanggal_tagih', [$tanggal[0] . ' 00:00:00', $tanggal[1] . ' 23:59:59'])->get(),
        ]);
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
                'denda' => Carbon::now()->addHours(1)->format('Ymd') > Carbon::now()->addHours(1)->format('Ym25') ? 5000 : 0,
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
