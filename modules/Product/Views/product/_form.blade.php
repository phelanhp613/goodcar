<form action="" method="post" id="product-form">
    @csrf
    @php(($prompt = ['' => trans('Select')]))
    <div class="d-md-flex d-block justify-content-between">
        <div class="d-flex mb-3">
            <button type="submit" class="btn btn-info text-white me-2">{{ trans('Save') }}</button>
            <button type="reset" class="btn btn-outline-dark">{{ trans('Reset') }}</button>
        </div>
        @if(!empty($data))
            <div class="d-flex mb-3">
                <div class="me-2">
                    <x-base::gallery-button/>
                </div>
                @if($data->has_variant)
                    <div>
                        <a href="{{ route('get.product_variant.list', $data->id) }}" class="btn btn-info text-white fw-semibold">{{ trans('Config Attribute') }}</a>
                    </div>
                @endif
            </div>
        @endif
    </div>
    <div class="card mb-3">
        <div class="card-header bg-white" data-bs-toggle="collapse" href="#product-general" role="button" aria-expanded="false" aria-controls="product-general">
            <h5>{{ trans("General") }}</h5>
        </div>
        <div class="card-body collapse @if(empty(request()->get('next-step')) && !request()->get('next-step')) show @endif row" id="product-general">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="name" class="form-label">{{ trans('Name') }}</label>
                        <input type="text" name="name" class="form-control product-name" id="name" value="{{ $data->name ?? old('name') }}">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="slug" class="form-label">{{ trans('Slug') }}</label>
                        <input type="text" name="slug" class="form-control" id="slug" value="{{ $data->slug ?? old('slug') }}">
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="sku" class="form-label">{{ trans('SKU') }}</label>
                        <input type="text" name="sku" class="form-control product-sku" id="sku" value="{{ $data->sku ?? old('sku') }}">
                    </div>
                </div>
                <div class="row">
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
                    <x-base::select-status name="status" id="status" status="{{ $data->status ?? 1 }}"/>
                </div>
                <div class="form-group">
                    <label for="featured" class="form-label">
                        <input type="checkbox" name="featured" id="featured" @if(!empty($data) && $data->featured == 1) checked @endif> {{ trans('Featured') }}?
                    </label>
                </div>
                <div class="form-group">
                    <input type="hidden" name="has_variant" value="1">
                </div>
                <div class="form-group">
                    <label for="product_category_id" class="form-label">{{ trans('Main Category') }}</label>
                    <select name="product_category_id" class="form-control select2" style="width: 100%;" id="product_category_id">
                        {!! getRecursiveProductCategoryOptions($categories, $data->product_category_id ?? null) !!}
                    </select>
                </div>
                <div class="form-group">
                    <label for="product_category_ids" class="form-label">{{ trans('Category') }}</label>
                    <select name="product_category_ids[]" class="form-control select2-multiple" style="width: 100%;" id="product_category_ids" multiple="multiple">
                        {!! getRecursiveProductCategoryOptions($categories, json_decode($data->product_category_ids ?? "[]", 1)) !!}
                    </select>
                </div>
                <div class="form-group">
                    <label for="image" class="form-label">{{ trans('Image') }}</label>
                    <x-base::image-input id="image" name="images[main]" value="{{ getMainImage($data->images ?? '') ?? '' }}"/>
                </div>
                <hr>
                <div class="form-group">
                    <label for="tags" class="form-label">{{ trans('Tag') }}</label>
                    {!! Form::select('tags[]', $tags, !empty($data) ? $data->tags->pluck("name")->toArray() : [],
                        ['class' => 'select2-multiple-tag form-control', 'style' => 'width:"100%"', "multiple" => "multiple"]) !!}
                </div>
                @if(!empty($data))
                    <hr>
                    <div>
                        <label for="tags" class="form-label">{{ trans('Created By') }}: </label>
                        <span>{{ $data->createdBy->name }}</span>
                    </div>
                    <div>
                        <label for="tags" class="form-label">{{ trans('Created At') }}: </label>
                        <span>{{ formatDate($data->created_at,'d-m-Y H:i:s') }}</span>
                    </div>
                    <div>
                        <label for="tags" class="form-label">{{ trans('Updated By') }}: </label>
                        <span>{{ $data->updatedBy->name }}</span>
                    </div>
                    <div>
                        <label for="tags" class="form-label">{{ trans('Updated At') }}: </label>
                        <span>{{ formatDate($data->updated_at,'d-m-Y H:i:s') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="d-flex mb-3">
        <button type="submit" class="btn btn-info text-white me-2">{{ trans('Save') }}</button>
        <button type="reset" class="btn btn-outline-dark">{{ trans('Reset') }}</button>
    </div>
</form>{!! getModal(['class' => 'modal-ajax', "size" => 'modal-lg']) !!}
@if(!empty($data))
    <x-base::gallery :images="$data->images" action="{{ route('post.product.add_image', $data->id) }}"/>
@endif
@push('js')
    {!! JsValidator::formRequest('Modules\Product\Requests\ProductRequest','#product-form')->ignore('[textarea]') !!}
    <script>
		$(document).ready(function () {
			renderCkEditor(`description`, '{{ route('setting.elfinder.ckeditor4') }}', 170);
		});
    </script>
@endpush
