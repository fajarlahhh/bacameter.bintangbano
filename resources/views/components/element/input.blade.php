<div>
  <div class="form-group">
    @if ($label)
      <label class="control-label">{!! $label !!}</label>
    @endif
    <input class="form-control {{ $class }}" type="{{ $type }}" autocomplete="off"
      placeholder="{{ $placeholder }}" {{ $attribute }} value="{{ $value }}" />
    @if ($id)
      @error($id)
        <small><span class="text-danger">{{ $message }}</span></small>
      @enderror
    @endif
  </div>
</div>
