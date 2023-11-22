@php use Modules\Order\Models\Order; @endphp
<div class="search-box mb-3" xmlns:x-base="http://www.w3.org/1999/html">
    <div class="card">
        <div class="card-header bg-white" data-toggle="collapse" data-target="#form-search-box" aria-expanded="false" aria-controls="form-search-box">
            <div class="fw-semibold">{{ trans("Search") }}</div>
        </div>
        <div class="card-body collapse show" id="form-search-box">
            <form action="{{ route('get.order.sold_product_list') }}" method="get">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="code">{{ trans("Order code") }}</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{ $filters['code'] ?? null}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="name">{{ trans("Name") }}</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $filters['name'] ?? null}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="phone">{{ trans("Phone") }}</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="{{ $filters['phone'] ?? null}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="from-date">{{ trans("From Date") }}</label>
                        <div class="input-group mb-3">
                            <input type="text" name="from_date" autocomplete="off" value="{{ $filters['from_date'] ?? null }}" class="form-control date" id="from-date" placeholder="dd-mm-yyyy">
                            <span class="input-group-text">
                                <i class="fas fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="to-date">{{ trans("To Date") }}</label>
                        <div class="input-group mb-3">
                            <input type="text" name="to_date" autocomplete="off" value="{{ $filters['to_date'] ?? null }}" class="form-control date" id="to-date" placeholder="dd-mm-yyyy">
                            <span class="input-group-text">
                                <i class="fas fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="chassis_number">{{ trans('Chassis number') }}</label>
                        <input type="text" name="chassis_number" class="form-control" id="chassis_number" value="{{ $filters['chassis_number'] ?? null }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="vehicle_engine_number">{{ trans('Vehicle engine number') }}</label>
                        <input type="text" name="vehicle_engine_number" class="form-control" id="" value="{{ $filters['vehicle_engine_number'] ?? null }}">
                    </div>
                </div>
                <div class="row">
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-info text-white me-2">{{ trans("Search") }}</button>
                    <a href="{{ route('get.order.sold_product_list') }}" class="btn btn-outline-dark">{{ trans("Reset") }}</a>
                </div>
            </form>
        </div>
    </div>
</div>