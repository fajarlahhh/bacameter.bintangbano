<div>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Status Baca</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Status Baca</li>
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
            <a href="/statusbaca/tambah" class="btn text-white btn-primary"><i class="fa fa-plus"></i>
              Tambah</a>&nbsp;
            <x-element.input type="text" attribute="wire:model.lazy=cari" placeholder="Pencarian" />
          </div>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>No.</th>
                <th>Keterangan</th>
                <th>Input Angka</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $i => $row)
                <tr>
                  <td class="align-middle">{{ ++$i }}</td>
                  <td class="align-middle">{{ $row->keterangan }}</td>
                  <td class="align-middle">{{ $row->input_angka == 1 ? 'YA' : 'TIDAK' }}</td>
                  <td class="with-btn-group align-middle text-right" nowrap>
                    <div class="btn-group btn-group-sm" role="group">
                      @if ($key === $row->getKey())
                        <button wire:click="hapus" class="btn text-white btn-danger">Ya, Hapus</button>
                        <button wire:click="setKey" class="btn text-white btn-success">Batal</button>
                      @else
                        <a href="/statusbaca/edit/{{ $row->getKey() }}" class="btn text-white btn-info"><i
                            class="fas fa-sm fa-pencil-alt"></i></a>
                        <button wire:click="setKey({{ $row->getKey() }})" class="btn text-white btn-danger"><i
                            class="fas fa-sm fa-trash-alt"></i></button>
                      @endif
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer  text-right">
          Jumlah Data : {{ $data->count() }}
        </div>
      </div>
    </div>
  </section>
</div>
