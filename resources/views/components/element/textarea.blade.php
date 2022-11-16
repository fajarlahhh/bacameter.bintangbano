<div>
  <div class="form-group">
    @if ($label)
      <label class="control-label">{!! $label !!}</label>
    @endif
    <textarea class="form-control" rows="4" {{ $attribute }}>{{ $value }}</textarea>
    @if ($id)
      @error($id)
        <small><span class="text-danger">{{ $message }}</span></small>
      @enderror
    @endif
  </div>
</div>
