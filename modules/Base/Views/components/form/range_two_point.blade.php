@php
    $minValue = (int)(request($min_name) ?? $min);
    $maxValue = (int)(request($max_name) ?? $max);
@endphp
<div id="range-two-point">
    <div class="range-input-group mb-4">
        <label class="w-100">
            <span class="fw-semibold">{{ trans('Price') }} {{ trans('From') }}</span>
            <input type="text" class="form-control range-min-display" value="{{ currency_format($minValue) }}" aria-label="Min price display">
        </label>
        <label class="w-100">
            <span class="fw-semibold">{{ trans('To') }}</span>
            <input type="text" class="form-control range-max-display" value="{{ currency_format($maxValue) }}" aria-label="Max price display">
        </label>
    </div>
    <div class="range-slide w-100 mb-3 d-none">
        <div class="slide">
            <div class="range-line" style="left: {{ ($minValue/$max) * 100 }}%; right: {{ 100 - (($maxValue/$max) * 100) }}%"></div>
            <span class="thumb" id="range-thumb-min" style="left: {{ ($minValue/$max) * 100 }}%;"></span>
            <span class="thumb" id="range-thumb-max" style="left: {{ ($maxValue/$max) * 100 }}%;"></span>
        </div>
        <input type="range" name="{{ $min_name }}" class="range-min" max="{{ $max }}" min="{{ $min }}" step="5" value="{{ $minValue }}" aria-label="Min price">
        <input type="range" name="{{ $max_name }}" class="range-max" max="{{ $max }}" min="{{ $min }}" step="5" value="{{ $maxValue }}" aria-label="Max price">
    </div>
</div>

@push('js')
    <script>
		$(document).ready(function () {
			handleRangeTwoPoint({{ $min }}, {{ $max }});
		});
    </script>
@endpush
