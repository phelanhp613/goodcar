<div class="input-group mb-3">
    <button type="button" class="input-group-text btn-elfinder">{{ trans('Choose Image') }}</button>
    <input type="text" name="{{ $name }}" class="form-control" id="{{ $id }}" value="{{ $value ?? "" }}">
</div>
<div class="main-image w-65">
    @if(!empty($value))
        <img src="{{ env('APP_URL') . $value }}" alt="{{ $value }}" loading="lazy" class="input-image-component-img">
    @endif
</div>
