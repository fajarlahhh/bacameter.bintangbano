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
                        <x-element.select attribute="wire:model=pembaca" style="warning">
                            <option value="">-- Semua Cabang --</option>
                            @foreach (\App\Models\Cabang::orderBy('nama')->get() as $row)
                                <option value="{{ $row->getKey() }}">{{ $row->nama }}</option>
                            @endforeach
                        </x-element.select>&nbsp;
                        <x-element.select attribute="wire:model=status" style="warning">
                            <option value="0">Belum Ditagih</option>
                            <option value="1">Tertagih</option>
                        </x-element.select>
                        &nbsp;
                        @if ($status == 1)
                            <div class="form-group">
                                <input class="form-control" type="date" autocomplete="off" wire:model="tanggal1"
                                    name="tanggal1" />
                            </div>&nbsp;
                            <div class="form-group">
                                <label> s/d</label>&nbsp;
                                <input class="form-control" type="date" autocomplete="off" wire:model="tanggal2"
                                    name="tanggal2" />
                            </div>&nbsp;
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
                                <th>Status</th>
                                <th>Golongan</th>
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
                                    <td class="align-middle">{{ $row->status }}</td>
                                    <td class="align-middle">{{ $row->golongan }}</td>
                                    <td class="align-middle">{{ $row->periode }}</td>
                                    <td class="align-middle">{{ $row->stand_lalu }}</td>
                                    <td class="align-middle">{{ $row->stand_ini }}</td>
                                    <td class="align-middle">{{ $row->jumlah }}</td>
                                    <td class="align-middle">{{ $row->denda }}</td>
                                    @if ($status == 1)
                                        <td class="align-middle">{{ $row->tanggal_tagih }}</td>
                                        <td class="align-middle">{{ $row->pembaca_kode }}</td>
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
                                                    Hapus</a>
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
