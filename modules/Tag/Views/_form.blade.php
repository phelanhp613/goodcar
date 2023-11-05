<form action="" method="post" id="tag-form">
    @csrf
    <div class="form-group mb-3">
        <label for="name">{{ trans('Name') }}</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $data->name ?? old('name') }}">
    </div>
    <div class="button-group">
        <button type="submit" class="btn btn-info text-white me-2">{{ trans('Save') }}</button>
        <button type="reset" class="btn btn-outline-dark">{{ trans('Reset') }}</button>
    </div>
</form>
{!! JsValidator::formRequest('Modules\Tag\Requests\TagRequest','#tag-form') !!}
