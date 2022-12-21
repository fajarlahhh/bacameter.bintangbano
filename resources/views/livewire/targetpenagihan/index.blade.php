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
              <option value="">-- Semua Petugas --</option>
              @foreach (\App\Models\Pembaca::orderBy('nama')->get() as $row)
                <option value="{{ $row->kode }}">{{ $row->nama }}</option>
              @endforeach
            </x-element.select>&nbsp;
            <x-element.select attribute="wire:model=status" style="warning">
              <option value="0">Belum Ditagih</option>
              <option value="1">Tertagih</option>
            </x-element.select>
            &nbsp;
            <x-element.input type="text" attribute="wire:model.lazy=cari" placeholder="Pencarian" />
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
                <th>Jumlah</th>
                <th>Denda</th>
                <th>Tanggal Tagih</th>
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
                  <td class="align-middle">{{ $row->jumlah }}</td>
                  <td class="align-middle">{{ $row->denda }}</td>
                  <td class="align-middle">{{ $row->tanggal_tagih }}</td>
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
