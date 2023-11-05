<form action="" method="post" id="product-attribute-form">
    @csrf
    <div class="form-group mb-3">
        <label for="name">{{ trans('Name') }}</label>
        @if(empty($data))
            <select name="name[]" class="form-control select2-multiple" multiple="multiple" id="name"></select>
        @else
            <input type="text" name="name" class="form-control" value="{{ $data->name }}" id="name">
        @endif
    </div>
    @if(!empty($data))
        <div class="form-group mb-3">
            <label for="values">{{ trans('Values') }}</label>
            {!! Form::select('values[]', $children, $children, ['class' => 'select2 form-control select2-multiple', 'style' => 'width:"100%"', 'multiple' => 'multiple']) !!}
        </div>
    @endif
    <div class="form-group mb-3">
        <label for="description">{{ trans('Description') }}</label>
        <input type="text" name="description" class="form-control" value="{{ $data->description ?? '' }}" id="description">
    </div>
    <div class="button-group">
        <button type="submit" class="btn btn-info text-white me-2">{{ trans('Save') }}</button>
        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">{{ trans('Cancel') }}</button>
    </div>
</form>{!! JsValidator::formRequest('Modules\Product\Requests\ProductAttributeRequest','#product-attribute-form') !!}
