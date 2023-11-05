@php use Modules\Order\Models\Order; @endphp@extends("Base::backend.master")
@section("content")
    @php($status = $data->status ?? 0)
    <div id="role-module" class="container">
        <div class="row page-titles mb-4">
            <div class="col-5 align-self-center">
                <h5 class="title">{{ trans('Order') }}</h5>
            </div>
            <div class="col -7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb fs-7">
                        <li class="breadcrumb-item"><a href="/admin">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('get.order.list') }}">{{ trans('Order') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ trans('Detail') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between">
                        <h5>{{ $title ?? trans('Detail') }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" id="order-form">
                            @csrf
                            <div class="form-group">
                                <label for="code">{{ trans('Order code') }}</label>
                                <input type="text" class="form-control" name="code" id="code" value="{{ $data->code ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="name">{{ trans('Name') }}</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $data->name ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">{{ trans('Phone') }}</label>
                                <input type="tel" class="form-control" name="phone" id="phone" value="{{ $data->phone ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{ trans('Email') }}</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ $data->email ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="address">{{ trans('Delivery address') }}</label>
                                <textarea name="address" class="form-control" id="address" rows="3">{{ $data->address ?? '' }}</textarea>
                            </div>
                            <div class="form-outline mb-3">
                                <label class="form-label fw-semibold" for="payment-method">{{ trans('Payment Method') }}
                                    <span class="text-danger">*</span></label>
                                {!! Form::select('payment_method', ['cod' => trans('Cash On Delivery (COD)'), 'bank' => trans('Bank transfer')], $data->payment_method ?? 'cod',
                                    ['class' => 'select2 form-control w-100', 'id' => 'status']) !!}
                            </div>
                            <div class="form-group">
                                <label for="status" class="me-2">{{ trans('Status') }}:</label>
                                @if ($status == 0)
                                    <span class="badge bg-danger text-white">{{ Order::getStatus($status) }}</span>
                                @elseif($status == 1)
                                    <span class="badge bg-success">{{ Order::getStatus($status) }}</span>
                                @elseif($status == -1)
                                    <span class="badge bg-gray">{{ Order::getStatus($status) }}</span>
                                @else
                                    <span class="badge bg-warning">{{ Order::getStatus($status) }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="note">{{ trans('Note') }}</label>
                                <textarea name="note" class="form-control" id="note" rows="4">{{ $data->note ?? '' }}</textarea>
                            </div>
                            <div class="button-group">
                                <button type="submit" class="btn btn-info text-white me-2">{{ trans('Save') }}</button>
                                <button type="reset" class="btn btn-outline-dark">{{ trans('Reset') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>
                                    @if ($status == 0)
                                        <span class="badge bg-danger text-white">{{ Order::getStatus($status) }}</span>
                                    @elseif($status == 1)
                                        <span class="badge bg-success">{{ Order::getStatus($status) }}</span>
                                    @elseif($status == -1)
                                        <span class="badge bg-gray">{{ Order::getStatus($status) }}</span>
                                    @else
                                        <span class="badge bg-warning">{{ Order::getStatus($status) }}</span>
                                    @endif
                                </h4>
                                <div>
                                    @if(!empty($data->voucher_code))
                                        <h5 class="fw-semibold">
                                            {{ trans('Total Price') }}:
                                            <span class="text-primary me-2">{{ currency_format($data->total_price ?? 0) }}</span>
                                        </h5>
                                        <h5 class="fw-semibold">
                                            {{ trans('Voucher Price') }}:
                                            <span class="text-primary me-2">-{{ currency_format($data->voucher_price ?? 0) }} ({{ trans('Code') . ': ' . $data->voucher_code }})</span>
                                        </h5>
                                        <h3>
                                            {{ trans('Final Price') }}:
                                            <span class="text-success me-2">{{ currency_format($data->total_price - $data->voucher_price) }}</span>
                                        </h3>
                                    @else
                                        <h3 class="fw-semibold">
                                            {{ trans('Final Price') }}:
                                            <span class="text-success me-2">{{ currency_format($data->total_price ?? 0) }}</span>
                                        </h3>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-block d-md-flex justify-content-end w-100">
                                    @if($status == 2)
                                        <a href="{{ route("get.order.accept", $data->id) }}" class="btn btn-success fw-semibold text-white me-2">{{ trans('Accept') }}</a>
                                        <a href="{{ route("get.order.abort", $data->id) }}" class="btn btn-danger fw-semibold text-white">{{ trans('Abort') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5>{{ trans("Order Detail") }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 50px">#</th>
                                    <th>{{ trans('Product Name') }}</th>
                                    <th style="width: 130px">{{ trans('SKU') }}</th>
                                    <th>{{ trans('Attributes') }}</th>
                                    <th style="width: 115px;">{{ trans('Price') }}</th>
                                    <th style="width: 115px;">{{ trans('Discount') }}</th>
                                    <th style="width: 115px;">{{ trans('Quantity') }}</th>
                                    <th style="width: 115px;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($key = 1)
                                @foreach($data->details as $item)
                                    <tr>
                                        <td><span class="number">{{$key++}}</span></td>
                                        <td>
                                            <a class="text-decoration-underline" href="{{ route('get.product.update', $item->product_id) }}">{{ $item->product_name }}</a>
                                        </td>
                                        <td>{{ $item->sku }}</td>
                                        <td>{{ implode(", ", json_decode($item->product_attributes, 1)) }}</td>
                                        <td>{{ currency_format($item->price) }}</td>
                                        <td>{{ currency_format($item->discount) }}</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td>
                                            @if($status == 2)
                                                <a href="{{ route("get.order.updateDetail", $item->id) }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form-modal" data-title="{{ trans('Update Order Detail') }}">
                                                    <i class="fas fa-pencil"></i>
                                                </a>
                                                <a href="{{ route("get.order.deleteDetail", [$data->id, $item->id]) }}" class="btn btn-danger text-white"><i class="fas fa-trash"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if(!empty($data->invoice_info))
                    @php($invoice = !empty($data->invoice_info) ? json_decode($data->invoice_info, 1) : null)
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5>{{ trans("Invoice Information") }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="invoice-info-content">
                                <table class="table">
                                    <tr>
                                        <td><label>{{ trans('Invoice Type') }} </label></td>
                                        <td>
                                            <span class="text-info fw-bold">{{ trans(Order::INVOICE_TYPES[$invoice['type']] ?? 'N/A') }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>{{ $invoice['type'] == Order::INVOICE_PERSONAL ? trans('Full Name') : trans('Company Name') }} </label>
                                        </td>
                                        <td><span>{{ $invoice['data']['name'] ?? 'N/A' }}</span></td>
                                    </tr>
                                    <tr>
                                        <td><label>{{ trans('Email') }} </label></td>
                                        <td><span>{{ $invoice['data']['email'] ?? 'N/A' }}</span></td>
                                    </tr>
                                    <tr>
                                        <td><label>{{ trans('Phone') }} </label></td>
                                        <td><span>{{ $invoice['data']['phone'] ?? 'N/A' }}</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>{{ $invoice['type'] == Order::INVOICE_PERSONAL ? trans('Invoice delivery address') : trans('Registered business address') }}: </label>
                                        </td>
                                        <td><span>{{ $invoice['data']['address'] ?? 'N/A' }}</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
{!! getModal(['class' => 'modal-ajax', 'size' => 'modal-lg']) !!}
@push('js')
    {!! JsValidator::formRequest('Modules\Order\Requests\OrderRequest','#order-form') !!}
@endpush