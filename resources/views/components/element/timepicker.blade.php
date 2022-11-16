<div>
  <div class="form-group">
    @if ($label)
      <label class="control-label">{!! $label !!}</label>
    @endif
    <input type="text" readonly class="form-control timepicker" {{ $attribute }}
      onblur="@this.set('{{ $id }}', this.value);" autocomplete="off" />
    @if ($id)
      @error($id)
        <small><span class="text-danger">{{ $message }}</span></small>
      @enderror
    @endif
  </div>
</div>
