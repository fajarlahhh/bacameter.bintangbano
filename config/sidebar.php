<?php

return [

  /*
  |--------------------------------------------------------------------------
  | View Storage Paths
  |--------------------------------------------------------------------------
  |
  | Most templating systems load templates from disk. Here you may specify
  | an array of paths that should be checked for your views. Of course
  | the usual Laravel view path has already been registered for you.
  |
   */

  'menu' => [[
    'icon' => 'fa fa-tachometer-alt',
    'title' => 'Dashboard',
    'url' => '/dashboard',
    'id' => 'anggarandashboard',
  ], [
    'icon' => 'fa fa-file',
    'title' => 'Cetak',
    'url' => 'javascript:;',
    'caret' => true,
    'id' => 'anggarancetak',
    'sub_menu' => [[
      'title' => 'Rekomendasi',
      'url' => '/cetak/rekomendasi',
      'id' => 'anggarancetakrekomendasi',
    ], [
      'title' => 'Usulan',
      'url' => 'javascript:;',
      'caret' => true,
      'id' => 'anggarancetakusulan',
      'sub_menu' => [[
        'title' => 'Perbidang',
        'url' => '/cetak/usulan/perbidang',
        'id' => 'anggarancetakusulanperbidang',
      ], [
        'title' => 'Perkode',
        'url' => '/cetak/usulan/perkode',
        'id' => 'anggarancetakusulanperkode',
      ]],
    ]],
  ], [
    'icon' => 'fa fa-database',
    'title' => 'Data Master',
    'url' => 'javascript:;',
    'caret' => true,
    'id' => 'anggarandatamaster',
    'sub_menu' => [
      [
        'url' => '/datamaster/akunanggaran',
        'id' => 'anggarandatamasterakunanggaran',
        'title' => 'Akun Anggaran',
      ], [
        'url' => '/datamaster/rekeningair',
        'id' => 'anggarandatamasterrekeningair',
        'title' => 'Rekening Air',
      ], [
        'url' => '/datamaster/tarif',
        'id' => 'anggarandatamastertarif',
        'title' => 'Tarif',
      ]],
  ], [
    'icon' => 'fa fa-cog',
    'title' => 'Pengaturan',
    'url' => 'javascript:;',
    'caret' => true,
    'id' => 'anggaranpengaturan',
    'sub_menu' => [[
      'url' => '/pengaturan/pengguna',
      'id' => 'anggaranpengguna',
      'title' => 'Pengguna',
    ], [
      'url' => '/pengaturan/periode',
      'id' => 'anggaranpengaturanperiode',
      'title' => 'Periode Anggaran',
    ]],
  ], [
    'icon' => 'fa fa-gavel',
    'title' => 'Posting Anggaran',
    'url' => '/postinganggaran',
    'id' => 'anggaranpostinganggaran',
  ], [
    'icon' => 'fas fa-clipboard',
    'title' => 'Rekomendasi',
    'url' => '/rekomendasi',
    'id' => 'anggaranrekomendasi',
  ], [
    'icon' => 'fa fa-chart-line',
    'title' => 'Simulasi',
    'url' => 'javascript:;',
    'caret' => true,
    'id' => 'anggaransimulasi',
    'sub_menu' => [[
      'url' => '/simulasi/rka',
      'id' => 'anggaransimulasirka',
      'title' => 'RKA',
    ], [
      'url' => '/simulasi/tarif',
      'id' => 'anggaransimulasitarif',
      'title' => 'Tarif',
    ]],
  ], [
    'icon' => 'fab fa-wpforms',
    'title' => 'Usulan',
    'url' => 'javascript:;',
    'caret' => true,
    'id' => 'anggaranusulan',
    'sub_menu' => [[
      'title' => 'Biaya',
      'url' => '/usulan/biaya',
      'id' => 'anggaranusulanbiaya',
    ], [
      'title' => 'Investasi',
      'url' => '/usulan/investasi',
      'id' => 'anggaranusulaninvestasi',
    ], [
      'title' => 'Pemakaian Air Sendiri',
      'url' => '/usulan/pemakaianairsendiri',
      'id' => 'anggaranusulanpemakaianairsendiri',
    ], [
      'title' => 'Pendapatan Air',
      'url' => 'javascript:;',
      'caret' => true,
      'id' => 'anggaranusulanpendapatanair',
      'sub_menu' => [[
        'title' => 'Mobil Tangki',
        'url' => '/usulan/pendapatanair/mobiltangki',
        'id' => 'anggaranusulanpendapatanairmobiltangki',
      ], [
        'title' => 'Penjualan Air',
        'url' => '/usulan/pendapatanair/penjualanair',
        'id' => 'anggaranusulanpendapatanairpenjualanair',
      ]],
    ], [
      'title' => 'Pendapatan Non Air',
      'id' => 'anggaranusulanpendapatannonair',
      'url' => 'javascript:;',
      'caret' => true,
      'sub_menu' => [[
        'title' => 'Denda Penjualan Air',
        'url' => '/usulan/pendapatannonair/dendapenjualanair',
        'id' => 'anggaranusulanpendapatannonairdendapenjualanair',
      ], [
        'title' => 'Lainnya',
        'url' => '/usulan/pendapatannonair/lainnya',
        'id' => 'anggaranusulanpendapatannonairlainnya',
      ], [
        'title' => 'Sambung Baru',
        'url' => '/usulan/pendapatannonair/sambungbaru',
        'id' => 'anggaranusulanpendapatannonairsambungbaru',
      ]],
    ], [
      'title' => 'Pendapatan Non Usaha',
      'url' => 'javascript:;',
      'url' => '/usulan/pendapatannonusaha',
      'id' => 'anggaranusulanpendapatannonusaha',
    ], [
      'title' => 'Produksi',
      'url' => '/usulan/produksi',
      'id' => 'anggaranusulanproduksi',
    ]],
  ], [
    'icon' => 'fas fa-check-square',
    'title' => 'Verifikasi',
    'url' => '/verifikasi',
    'id' => 'anggaranverifikasi',
  ]],
];
