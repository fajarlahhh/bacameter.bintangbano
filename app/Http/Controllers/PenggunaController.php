<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
  //
  public function simpan_sandi(Request $req)
  {
    $validate = $req->validate(
      [
        'kata_sandi_baru' => 'required',
        'kata_sandi_lama' => 'required',
      ]
    );

    try {
      $id = Auth::id();
      $pengguna = Pengguna::findOrFail($id);
      if ($pengguna) {
        if (!Hash::check($req->get('kata_sandi_lama'), $pengguna->kata_sandi)) {
          alert()->error('Ganti Sandi', 'Gagal mengganti kata sandi. Kata sandi lama salah')->autoClose(3000);
          return redirect()->back();
        }
      } else {
        alert()->error('Ganti Sandi', 'Gagal mengganti kata sandi. Data pengguna tidak ada')->autoClose(3000);
        return redirect()->back();
      }
      $pengguna->kata_sandi = Hash::make($req->get('kata_sandi_baru'));
      $pengguna->save();
      return redirect()->back();
    } catch (\Exception $e) {
      alert()->error('Ganti Sandi', $e->getMessage());
      return redirect()->back();
    }
  }
}
