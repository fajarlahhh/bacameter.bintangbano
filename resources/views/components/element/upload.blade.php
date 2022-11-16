<div>
  <div class="note note-secondary">
    <div class="note-icon"><i class="fa fa-file"></i></div>
    <div class="note-content">
      <h4><b>Upload File <small class="text-warning">(PDF/JPEG/PNG)</small></b></h4>
      <div wire:loading wire:target="file">
        <h4 class="text-danger">Mohon tunggu...</h4>
      </div>
      <div wire:target="file" wire:loading.remove>
        <div class="form-group">
          <input class="form-control-file" type="file" wire:model="file" accept="image/jpeg,image/png,application/pdf"
            autocomplete="off" multiple />
          @error('file')
            <small><span class="text-danger">{{ $message }}</span></small>
          @enderror
        </div>
      </div>
    </div>
  </div>
</div>
