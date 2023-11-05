<form action="" method="post" id="order-detail-form">
    @csrf
    <div class="form-group mb-3">
        <label for="name">{{ trans('Name') }}</label>
        <div>{{ $data->product_name }}</div>
    </div>
    <div class="form-group mb-3">
        <label for="name">{{ trans('SKU') }}</label>
        <div>{{ $data->sku }}</div>
    </div>
    <div class="form-group mb-3">
        <label for="name">{{ trans('Attributes') }}</label>
        <div>{{ implode(", ", json_decode($data->product_attributes, 1)) }}</div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">{{ trans('Price') }}</label>
                <div>{{ currency_format($data->price) }}</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">{{ trans('Discount') }}</label>
                <div>{{ currency_format($data->discount) }}</div>
            </div>
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="quantity">{{ trans('Quantity') }}</label>
        <input type="number" class="form-control" min="0" name="quantity" id="quantity" value="{{ $data->quantity }}">
    </div>
    <div class="button-group">
        <button type="submit" class="btn btn-info text-white me-2">{{ trans('Save') }}</button>
        <button type="reset" class="btn btn-outline-dark">{{ trans('Reset') }}</button>
    </div>
</form>
