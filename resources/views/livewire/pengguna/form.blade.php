<div>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pengguna</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Pengguna</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <x-notif.alert />
      <form wire:submit.prevent="submit">
        <div class="card card-default">
          <div class="card-header">
            Form
          </div>
          <div class="card-body">
            <x-element.input type="text" id="uid" attribute="wire:model.defer=uid {{ $key ? 'readonly' : '' }}"
              label="UID" />
            <x-element.input type="text" id="nama" attribute="wire:model.defer=nama" label="Nama" />
            <x-element.input type="password" id="kataSandi" attribute="wire:model.defer=kataSandi" label="Kata Sandi" />
            <hr>
            <x-element.input type="text" id="perusahaan" attribute="wire:model.defer=perusahaan"
              label="Perusahaan" />
          </div>
          <div class="card-footer">
            <input type="submit" value="Simpan" class="btn text-white btn-success m-r-3" />
            <a wire:click="batal" class="btn text-white btn-danger">Batal</a>
          </div>
        </div>
      </form>
      <x-notif.info />
    </div>
  </section>
</div>
