<div>
  <div class="form-group">
    @if ($label)
      <label class="control-label">{!! $label !!}</label>
    @endif
    <select class="form-control selectpicker" data-size="10" data-live-search="true" data-width="100%"
      data-style="btn-{{ $style }}" {{ $attribute }}>
      {{ $slot }}
    </select>
    @if ($id)
      @error($id)
        <small><span class="text-danger">{{ $message }}</span></small>
      @enderror
    @endif
  </div>
</div>
