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
      <form wire:submit.prevent="submit">
        <div class="card card-default">
          <div class="card-header">
            Form
          </div>
          <div class="card-body">
            <x-element.input type="text" id="keterangan" attribute="wire:model.defer=keterangan"
              label="Keterangan" />
            <x-element.select attribute="wire:model=inputAngka" id="inputAngka" style="warning" label="Input Angka">
              <option selected hidden>-- Pilih Salah Satu --</option>
              <option value="1">YA</option>
              <option value="0">TIDAK</option>
            </x-element.select>
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
