<form action="" method="post" id="role-form">
    @csrf
    <div class="form-group row mb-3">
        <div class="col-md-4">
            <label for="name">{{ trans('Name') }}</label>
        </div>
        <div class="col-md-8">
            <input type="text" class="form-control" id="name" name="name" value="{{ $role->name ?? old('name') }}">
        </div>
    </div>
    <div class="form-group row mb-3">
        <div class="col-md-4">
            <label for="status">{{ trans('Status') }}</label>
        </div>
        <div class="col-md-8">
            @php($prompt = ['' => trans('Select')])
            {!! Form::select('status', $prompt + $statuses, $role->status ?? null, [
                'id' => 'status',
                'class' => 'select2 form-control',
                'style' => 'width: 100%']) !!}
        </div>
    </div>
    <div class="form-group row mb-5">
        <div class="col-md-4">
            <label for="description">{{ trans('Description') }}</label>
        </div>
        <div class="col-md-8">
            <textarea name="description" id="description" class="form-control"
                      rows="5">{{ $role->description ?? null }}</textarea>
        </div>
    </div>
    <div class="button-group">
        <button type="submit" class="btn btn-info text-white me-2">{{ trans('Save') }}</button>
        <button type="reset" class="btn btn-outline-dark">{{ trans('Reset') }}</button>
    </div>
</form>
{!! JsValidator::formRequest('Modules\Role\Requests\RoleRequest','#role-form') !!}
