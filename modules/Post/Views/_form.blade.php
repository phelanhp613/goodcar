<form action="" method="post" id="post-form">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="name" class="form-label">{{ trans('Name') }}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $data->name ?? old('name') }}">
                </div>
                <div class="col-md-6 form-group">
                    <label for="slug" class="form-label">Đường dẫn</label>
                    <input type="text" name="slug" class="form-control" id="slug" value="{{ $data->slug ?? old('slug') }}">
                </div>
                <div class="col-md-12 form-group">
                    <label for="description" class="form-label">{{ trans('Description') }}</label>
                    <textarea name="description" class="form-control" id="description">{!! $data->description ?? old('description') !!}</textarea>
                </div>
                <div class="col-md-12 form-group">
                    <x-base::textarea-content-tab content="{{ $data->content ?? '[]' }}"/>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="status" class="form-label">{{ trans('Status') }}</label>
                <x-base::select-status id="status" name="status" status="{{ $data->status ?? 1 }}" />
            </div>
            <div class="form-group">
                <label for="image" class="form-label">{{ trans('Image') }}</label>
                <x-base::image-input id="image" name="images" value="{{ $data->images ?? '' }}"/>
            </div>
            <div class="form-group">
                <label for="post_category" class="form-label">Danh mục bài viết</label>
                <select name="post_category" class="form-control select2 w-100" id="type">
                    <option value="">{{ trans('Select') }}</option>
                    <option value="Đánh giá sản phẩm" @if(($data->post_category ?? '') === 'Đánh giá sản phẩm' || request()->post_category === 'Đánh giá sản phẩm') selected @endif>Đánh giá sản phẩm</option>
                    <option value="Khuyến Mãi" @if(($data->post_category ?? '') === 'Khuyến Mãi' || request()->post_category === 'Khuyến Mãi') selected @endif>Khuyến Mãi</option>
                </select>
            </div>
        </div>
    </div>
    <div class="button-group">
        <button type="submit" class="btn btn-info text-white me-2">{{ trans('Save') }}</button>
        <button type="reset" class="btn btn-outline-dark">{{ trans('Reset') }}</button>
    </div>
</form>


@push('js')
{!! JsValidator::formRequest('Modules\Post\Requests\PostRequest','#post-form') !!}
@endpush