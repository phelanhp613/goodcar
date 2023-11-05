@php use Modules\Order\Models\Order; @endphp
<div class="search-box mb-3">
    <div class="card">
        <div class="card-header bg-white" data-toggle="collapse" data-target="#form-search-box" aria-expanded="false" aria-controls="form-search-box">
            <div class="fw-semibold">{{ trans("Search") }}</div>
        </div>
        <div class="card-body collapse show" id="form-search-box">
            <form action="{{ route('get.order.list') }}" method="get">
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
                        <label for="invoice_info">{{ trans("Invoice Type") }}</label>
                        {!! Form::select('invoice_info', ['' => 'Select'] + Order::INVOICE_TYPES, $filters['invoice_info'] ?? '',
                            ['class' => 'select2 form-control w-100', 'id' => 'invoice_info']) !!}
                    </div>
                    <div class="form-group col-md-3">
                        <label for="status">{{ trans("Status") }}</label>
                        {!! Form::select('status', ['' => 'Select'] + $statues, $filters['status'] ?? '',
                            ['class' => 'select2 form-control w-100', 'id' => 'status']) !!}
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
                </div>
                <div class="row">
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-info text-white me-2">{{ trans("Search") }}</button>
                    <a href="{{ route('get.order.list') }}" class="btn btn-outline-dark">{{ trans("Reset") }}</a>
                </div>
            </form>
        </div>
    </div>
</div>