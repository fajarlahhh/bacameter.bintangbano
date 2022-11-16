<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutentikasiController extends Controller
{
  public function __construct()
  {
    Auth::viaRemember();
  }

  protected $redirectTo = '/';

  public function login(Request $req)
  {
    $credentials = $req->validate([
      'nik' => 'required',
      'kata_sandi' => 'required',
    ]);

    $remember = ($req->remember == 'on') ? true : false;

    if (Auth::attempt(['nip' => $req->nik, 'password' => $req->kata_sandi, 'status' => 1], $remember)) {
      if (auth()->user()->pegawai->status == 'Non Aktif') {
        Pengguna::where('nip', $req->nik)->update([
          'status' => 0,
        ]);

        Auth::logout();
        return redirect('login');
      }
      Auth::logoutOtherDevices($req->kata_sandi, 'kata_sandi');
      return redirect()->intended('dashboard');
    }
    alert()->error('Login Gagal', 'NIK atau Kata Sandi salah');
    return redirect()->back()->withInput();
  }

  public function logout()
  {
    Auth::logout();
    return redirect('login');
  }

  public function username()
  {
    return 'pengguna_id';
  }
}
