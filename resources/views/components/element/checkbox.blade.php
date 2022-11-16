<div>
  <div class="checkbox checkbox-css">
    <input type="checkbox" {{ $attribute }} id="{{ $value }}"
      @if ($value) value="{{ $value }}" @endif />
    <label for="{{ $value }}">{!! $label !!}
      {{ $slot }}
    </label>
  </div>
</div>
