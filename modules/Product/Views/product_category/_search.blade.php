<div class="search-box mb-3">
    <div class="card">
        <div class="card-header bg-white" data-toggle="collapse" data-target="#form-search-box" aria-expanded="false"
             aria-controls="form-search-box">
            <div class="fw-semibold">{{ trans("Search") }}</div>
        </div>
        <div class="card-body collapse show" id="form-search-box">
            <form action="{{ route('get.product_category.list') }}" method="get">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="name">Tên danh mục</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $filter['name'] ?? null}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="type">{{ trans('Category Type') }}</label>
                        <select name="type" class="form-control select2 w-100" id="type">
                            <option value="">{{ trans('Select') }}</option>
                            <option value="Thương hiệu" @if(($data->type ?? '') === 'Thương hiệu' || request()->type === 'Thương hiệu') selected @endif>Thương hiệu</option>
                    <option value="Kiểu dáng" @if(($data->type ?? '') === 'Kiểu dáng' || request()->type === 'Kiểu dáng') selected @endif>Kiểu dáng</option>
                    <option value="Số chỗ ngồi" @if(($data->type ?? '') === 'Số chỗ ngồi' || request()->type === 'Số chỗ ngồi') selected @endif>Số chỗ ngồi</option>
                        </select>
                    </div>
                    {{--<div class="form-group col-md-3">
                        <label for="parent">{{ trans("Category Parent") }}</label>
                        <input type="tel" class="form-control" id="parent" name="parent" value="{{ $filter['parent'] ?? null}}">
                    </div>--}}
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-info text-white me-2">{{ trans("Search") }}</button>
                    <a href="{{ route('get.product_category.list') }}" class="btn btn-outline-dark">{{ trans("Reset") }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
