<div>
  <select class="form-control selectpicker" data-size="5" wire:model.defer="akunKode" data-live-search="true"
    data-style="btn-primary" data-width="100%">
    <option selected hidden>-- Pilih Kode Akun --</option>
    @foreach ($dataAkun as $row)
      <option value="{{ $row->kode }}">{{ $row->kode }} - {{ $row->keterangan }}</option>
    @endforeach
  </select>
  @error('akunKode')
    <small><span class="text-danger">{{ $message }}</span></small>
  @enderror
</div>
