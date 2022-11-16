<div>
  <div class="form-group">
    <label class="control-label">{!! $label !!}</label>
    <div class="input-group">
      <input type="text" readonly class="form-control date" {{ $attribute }}
        onblur="@this.set('{{ $id }}', this.value);" />
      @error($id)
        <small><span class="text-danger">{{ $message }}</span></small>
      @enderror
    </div>
  </div>
</div>
