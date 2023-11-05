@extends("Base::backend.master")
@section("content")
    <input type="hidden" id="current-route">
    <div id="role-module" class="container">
        <div class="row page-titles mb-4">
            <div class="col-5 align-self-center">
                <h5 class="title">{{ trans('Order') }}</h5>
            </div>
            <div class="col -7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb fs-7">
                        <li class="breadcrumb-item"><a href="/admin">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('Order') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!--Search box-->
        @include('Order::_search')
        @php use Modules\Order\Models\Order; @endphp
        <div class="listing">
            <div class="card">
                <div class="card-body">
                    <div class="d-block d-md-flex justify-content-between align-items-center">
                        <div class="sumary">
                            {!! summaryListing($data) !!}
                        </div>
                    </div>
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
                            @php($key = ($data->currentpage()-1)*$data->perpage()+1)
                            @foreach($data as $item)
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
                            {{ $data->withQueryString()->render('vendor/pagination/default') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="invoice-info-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ trans('Invoice Information') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('Close') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
		$(document).ready(function () {
			$(document).on('click', '.invoice-info-btn', function () {
				$(document).find('#invoice-info-modal').find('.modal-body').html($(this).parent('td').find('.invoice-info-content').html());
			})
		})
    </script>
@endpush