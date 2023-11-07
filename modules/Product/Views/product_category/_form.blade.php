<form action="" method="post" id="product-category-form">
    @csrf
    @php(($prompt = ['' => trans('Select')]))
    <div class="row">
        <div class="col-md-12 mb-3 d-flex">
            <button type="submit" class="btn btn-info text-white me-2">{{ trans('Save') }}</button>
            <button type="reset" class="btn btn-outline-dark">{{ trans('Reset') }}</button>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="name" class="form-label">{{ trans('Name') }}</label>
                    <input type="text" name="name" class="form-control name" id="name" value="{{ $data->name ?? old('name') }}">
                </div>
                <div class="col-md-6 form-group">
                    <label for="slug" class="form-label">{{ trans('Slug') }}</label>
                    <input type="text" name="slug" class="form-control" id="slug" value="{{ $data->slug ?? old('slug') }}">
                </div>
                <div class="col-md-12 form-group">
                    <label for="description" class="form-label">{{ trans('Description') }}</label>
                    <textarea name="description" class="form-control" id="description" rows="6">{!! $data->description ?? old('description') !!}</textarea>
                </div>
                <div class="col-md-12 form-group">
                    <x-base::textarea-content-tab content="{{ $data->content ?? '[]' }}" />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="status" class="form-label">{{ trans('Status') }}</label>
                <x-base::select-status id="status" status="{{ $data->status ?? 1 }}" name="status" />
            </div>
            <div class="form-group">
                <label for="parent_id" class="form-label">{{ trans('Parent Category') }}</label>
                <select name="parent_id" class="form-control select2" style="width: 100%;" id="parent_id">
                    <option value="">{{ trans('Select') }}</option>
                    {!! $categoryRecursiveOptions !!}
                </select>
            </div>
            <div class="form-group">
                <label for="type" class="form-label">{{ trans('Category Type') }}</label>
                <select name="type" class="form-control select2 w-100" id="type">
                    <option value="">{{ trans('Select') }}</option>
                    <option value="brand" @if(($data->type ?? '') === 'brand' || request()->type === 'brand') selected @endif>{{ trans('Brand') }}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image" class="form-label">{{ trans('Image') }}</label>
                <x-base::image-input id="image" name="image" value="{{$data->image ?? '' }}"/>
            </div>
            <div class="form-group">
                <label for="banner" class="form-label">{{ trans('Banner') }}</label>
                <x-base::image-input id="banner" name="banner" value="{{$data->banner ?? '' }}"/>
            </div>
        </div>
        <div class="col-md-12 mb-3 d-flex">
            <button type="submit" class="btn btn-info text-white me-2">{{ trans('Save') }}</button>
            <button type="reset" class="btn btn-outline-dark">{{ trans('Reset') }}</button>
        </div>
    </div>
</form>
@push('js')
    {!! JsValidator::formRequest('Modules\Product\Requests\ProductCategoryRequest','#product-category-form') !!}
@endpush
