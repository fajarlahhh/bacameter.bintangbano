<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Penagihan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Penagihan</li>
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
                        <x-element.select attribute="wire:model=status" style="warning">
                            <option value="0">Belum Ditagih</option>
                            <option value="1">Tertagih</option>
                        </x-element.select>
                        &nbsp;
                        @if ($status == 1)
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
                        @endif
                        <x-element.input type="text" attribute="wire:model.lazy=cari" placeholder="Pencarian" />
                        &nbsp;
                        <button class="btn btn-success" wire:click="export">Export</button>&nbsp;
                        <a class="btn btn-warning" href="/targetpenagihan/import">Import</a>
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
                                <th>Periode</th>
                                <th>Stand Lalu</th>
                                <th>Stand Ini</th>
                                <th>Jumlah</th>
                                <th>Denda</th>
                                @if ($status == 1)
                                    <th>Tanggal Tagih</th>
                                    <th>Petugas</th>
                                @endif
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $i => $row)
                                <tr>
                                    <td class="align-middle">{{ ++$no }}</td>
                                    <td class="align-middle">{{ $row->no_langganan }}</td>
                                    <td class="align-middle">{{ $row->nama }}</td>
                                    <td class="align-middle">{{ $row->alamat }}</td>
                                    <td class="align-middle">{{ $row->periode }}</td>
                                    <td class="align-middle">{{ $row->stand_lalu }}</td>
                                    <td class="align-middle">{{ $row->stand_ini }}</td>
                                    <td class="align-middle">{{ $row->jumlah }}</td>
                                    <td class="align-middle">{{ $row->denda }}</td>
                                    @if ($status == 1)
                                        <td class="align-middle">{{ $row->tanggal_tagih }}</td>
                                        <td class="align-middle">{{ $row->penagih->nama }}</td>
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
