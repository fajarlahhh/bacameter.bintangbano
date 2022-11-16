<div>
  <select class="form-control selectpicker" wire:model="periode" data-live-search="true" data-style="btn-info"
    data-width="100%">
    <option selected hidden>-- Pilih Periode Anggaran --</option>
    @foreach ($dataPeriode as $row)
      <option value="{{ $row->getKey() }}">
        {{ $row->tahun }}
        @if ($row->revisi)
          Ke {{ $row->revisi }}, tahun {{ $row->periode->tahun }}
        @endif
      </option>
    @endforeach
  </select>
  @error('periode')
    <small><span class="text-danger">{{ $message }}</span></small>
  @enderror
</div>
