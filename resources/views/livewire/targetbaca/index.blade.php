<div>
    @push('css')
        <style>
            .zoom-without-container {
                transition: transform .2s;
                /* Animation */
                margin: 0 auto;
            }

            .zoom-without-container img {
                width: 100%;
                height: auto;
            }

            .zoom-without-container:active {
                transform: scale(10);
                /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
                z-index: 3000;
                position: absolute;
                padding-top: 30px;
                padding-bottom: 20px;
            }
        </style>
    @endpush
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Target Baca</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Target Baca</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <x-notif.alert />
            <div class="card card-default">
                <div class="card-header">
                    <div class="form-inline">
                        <div class="form-group">
                            <select class="form-control " wire:model="bulan" data-live-search="true"
                                data-style="btn-info" data-width="100%">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ sprintf('%02s', $i) }}">
                                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>&nbsp;
                        <div class="form-group">
                            <select class="form-control " wire:model="tahun" data-live-search="true"
                                data-style="btn-info" data-width="100%">
                                @for ($i = 2016; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>&nbsp;
                        <x-element.select attribute="wire:model=pembaca" style="warning">
                            <option value="">-- Semua Petugas --</option>
                            @foreach (\App\Models\Pembaca::orderBy('nama')->get() as $row)
                                <option value="{{ $row->kode }}">{{ $row->nama }}</option>
                            @endforeach
                        </x-element.select>&nbsp;
                        <x-element.select attribute="wire:model=status" style="warning">
                            <option value="0">Belum Baca</option>
                            <option value="1">Terbaca</option>
                        </x-element.select>
                        &nbsp;
                        @if ($status == 1)
                            <x-element.select attribute="wire:model=statusBaca" style="warning">
                                <option value="">-- Semua Status Baca --</option>
                                @foreach (\App\Models\StatusBaca::orderBy('keterangan')->get() as $row)
                                    <option value="{{ $row->keterangan }}">{{ $row->keterangan }}</option>
                                @endforeach
                            </x-element.select>&nbsp;
                        @endif
                        <x-element.input type="text" attribute="wire:model.lazy=cari" placeholder="Pencarian" />
                        &nbsp;
                        <button class="btn btn-success" wire:click="export">Export</button>&nbsp;
                        <a class="btn btn-warning" href="/targetbaca/import">Import</a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Langganan</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Stand Ini</th>
                                <th>Foto</th>
                                <th>Status Baca</th>
                                <th>Tanggal Baca</th>
                                @if ($status == 1)
                                    <th></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $i => $row)
                                <tr>
                                    <td class="align-middle">{{ ++$no }}</td>
                                    <td class="align-middle">{{ $row->no_langganan }}</td>
                                    <td class="align-middle">{{ $row->nama }}</td>
                                    <td class="align-middle">{{ $row->alamat }}</td>
                                    <td class="align-middle">{{ $row->stand_ini }}</td>
                                    <td class="align-middle">{!! $row->foto
                                        ? "<div class='zoom-without-container'><img src='" .
                                            asset('/' . $row->foto) .
                                            "'  alt='zoom' style='width:50px'></div>"
                                        : null !!}
                                    </td>
                                    <td class="align-middle">{{ $row->status_baca }}</td>
                                    <td class="align-middle">{{ $row->tanggal_baca }}</td>
                                    @if ($status == 1)
                                        <td>
                                            @if ($reset == $row->getKey())
                                                <a href="javascript:;" wire:click="ulangi" class="btn btn-danger">Ya,
                                                    Ya, Reset</a>
                                                <a href="javascript:;" wire:click="setReset"
                                                    class="btn btn-success">Batal</a>
                                            @else
                                                <a href="javascript:;" wire:click="setReset({{ $row->getKey() }})"
                                                    class="btn btn-danger">Reset</a>
                                            @endif
                                        </td>
                                    @else
                                        <td>
                                            @if ($hapus == $row->getKey())
                                                <a href="javascript:;" wire:click="hapus" class="btn btn-danger">Ya,
                                                    Ya, Hapus</a>
                                                <a href="javascript:;" wire:click="setHapus"
                                                    class="btn btn-success">Batal</a>
                                            @else
                                                <a href="javascript:;" wire:click="setHapus({{ $row->getKey() }})"
                                                    class="btn btn-danger">Hapus</a>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6 col-lg-10 col-xl-10 col-xs-12">
                            {{ $data->links() }}
                        </div>
                        <div class="col-md-6 col-lg-2 col-xl-2 col-xs-12 text-right">
                            Jumlah Data : {{ $data->total() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
