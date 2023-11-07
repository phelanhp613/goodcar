<form action="" method="post" id="customer-form">
    @csrf
    <div class="row">
        <div class="col-md-4 form-group">
            <label for="name">{{ trans('Name') }}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $data->name ?? old('name') }}">
        </div>
        <div class="col-md-4 form-group">
            <label for="phone">{{ trans('Phone') }}</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $data->phone ?? old('phone') }}">
        </div>
        <div class="col-md-4 form-group">
            <label for="email">{{ trans('Email') }}</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $data->email ?? old('email') }}">
        </div>
        <div class="col-md-8 form-group">
            <label for="address">{{ trans('Address') }}</label>
            <textarea class="form-control" id="address" name="address" rows="5">{{ $data->address ?? old('address') }}</textarea>
        </div>
        <div class="col-md-4 form-group">
            <label for="status">{{ trans('Status') }}</label>
            <x-base::select-status id="status" name="status" status="{{ $data->status ?? 1 }}" />
        </div>
    </div>
    <div class="button-group">
        <button type="submit" class="btn btn-info text-white me-2">{{ trans('Save') }}</button>
        <button type="reset" class="btn btn-outline-dark">{{ trans('Reset') }}</button>
    </div>
</form>

{!! JsValidator::formRequest('Modules\Customer\Requests\CustomerRequest','#customer-form') !!}
