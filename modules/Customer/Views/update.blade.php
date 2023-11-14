@extends("Base::backend.master")
@php use Modules\Order\Models\Order; @endphp
@section("content")
    <input type="hidden" id="current-route">
    <div id="customer-module" class="container">
        <div class="row page-titles mb-4">
            <div class="col-5 align-self-center">
                <h5 class="title">{{ trans('Customer') }}</h5>
            </div>
            <div class="col -7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb fs-7">
                        <li class="breadcrumb-item"><a href="/admin">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('get.customer.list') }}">{{ trans('Customer') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('Update') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="update-form">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ trans('Update Customer') }}: {{ $data->name ?? null }}</h5>
                </div>
                <div class="card-body">
                    @include('Customer::_form')
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>{{ trans('Orders') }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="width: 50px">#</th>
                                <th>{{ trans('Code') }}</th>
                                <th>{{ trans('Name') }}</th>
                                <th>{{ trans('Phone') }}</th>
                                <th style="width: 300px;">{{ trans('Delivery address') }}</th>
                                <th>{{ trans('Total Price') }}</th>
                                <th>{{ trans('Voucher Price') }}</th>
                                <th>{{ trans('Invoice') }}</th>
                                <th>{{ trans('OTP') }}</th>
                                <th class="text-center" style="width: 100px">{{ trans('Status') }}</th>
                                <th style="width: 180px">{{ trans('Created At') }}</th>
                                <th class="action" style="width: 150px">{{ trans('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($key = ($orders->currentpage()-1)*$orders->perpage()+1)
                            @foreach($orders as $item)
                                <tr>
                                    <td><span class="number">{{$key++}}</span></td>
                                    <td class="fw-semibold text-danger">#{{ $item->code }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td class="fw-bold text-primary">{{ currency_format($item->total_price) }}</td>
                                    <td class="fw-bold text-primary">{{ currency_format($item->voucher_price) }}</td>
                                    <td>
                                        @php($invoice = !empty($item->invoice_info) ? json_decode($item->invoice_info, 1) : null)
                                        <!-- Button trigger modal -->
                                        @if(!empty($invoice['type']))
                                            <a href="#invoice-info-modal" role="button" data-bs-toggle="modal" class="invoice-info-btn">
                                                <span class="badge @if($invoice['type'] == Order::INVOICE_PERSONAL) bg-info @else bg-success @endif w-100">
                                                {{ trans(Order::INVOICE_TYPES[$invoice['type']] ?? 'None') }}
                                            </span>
                                            </a>
                                            <div class="d-none">
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
                                        @else
                                            <span class="badge bg-gray w-100">{{ trans('None') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->otp_code }}</td>
                                    <td>
                                        @php($status = $item->status)
                                        @if ($status == 0)
                                            <span class="badge bg-danger text-white w-100">{{ Order::getStatus($status) }}</span>
                                        @elseif($status == 1)
                                            <span class="badge bg-success w-100">{{ Order::getStatus($status) }}</span>
                                        @elseif($status == 2)
                                            <span class="badge bg-warning w-100">{{ Order::getStatus($status) }}</span>
                                        @else
                                            <span class="badge bg-gray w-100">{{ Order::getStatus($status) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ formatDate($item->created_at,'d-m-Y H:i') }}</td>
                                    <td class="text-center">
                                        @can('order-update')
                                            <a href="{{ route("get.order.update", $item->id) }}" class="btn btn-primary">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                        @endcan
                                        @can('order-delete')
                                            <a href="{{ route('get.order.delete',$item->id) }}" class="btn btn-danger btn-delete text-white">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-5 pagination-style">
                            {{ $orders->withQueryString()->render('vendor/pagination/default') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
