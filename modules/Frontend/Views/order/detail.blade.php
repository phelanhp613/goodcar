@extends('Base::frontend.master')@php
    use Modules\Setting\Models\PaymentConfig;
    use Modules\Order\Models\Order;
@endphp
@section('content')
    <section id="order-section" class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs-md-6 fs-8">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('frontend.get.orderSearch') }}">{{ trans('Tra cứu đơn hàng') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ trans('Order Detail') }}</li>
            </ol>
        </nav>
        <div class="mb-5">
            <h1 class="fs-2">Chi tiết đơn hàng</h1>
            <div class="card">
                <div class="card-body">
                    @if(!empty($data))
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="fs-4 border-bottom border-1 pb-2">Thông tin khách hàng</h2>
                                <div class="text-danger fw-semibold">Đơn hàng: #{{ $data->code }}</div>
                                <div>Tên khách hàng: {{ $data->name }}</div>
                                <div>Số điện thoại: {{ $data->phone }}</div>
                                <div>Email: {{ $data->email }}</div>
                                <div>Địa chỉ: {{ $data->address }}</div>
                                <div>Trạng thái đơn hàng:
                                    <span>
                                        @php($status = $data->status)
                                        @if ($status == 0)
                                            <span class="badge bg-danger text-white">{{ Order::getStatus($status) }}</span>
                                        @elseif($status == 2)
                                            <span class="badge bg-warning">{{ Order::getStatus($status) }}</span>
                                        @elseif($status == 5)
                                            <span class="badge bg-success">{{ Order::getStatus($status) }}</span>
                                        @else
                                            <span class="badge bg-info">{{ Order::getStatus($status) }}</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="fs-4 border-bottom border-1 pb-2 mb-3">Chi tiết đơn hàng</h2>
                                <div class="mb-3">
                                    @foreach($data->details as $detail)
                                        @php($product = $detail->productVariant->product)
                                        <div class="d-flex">
                                            <div class="ratio ratio-1x1" style="width: 100px;">
                                                <img src="{{ getMainImage(($product->has_variant) ? $detail->productVariant->images : $product->images)  }}" class="img-fluid rounded-3 w-100 h-auto" width="100" height="100" alt="Book">
                                            </div>
                                            <div class="flex-column ms-4">
                                                <a href="{{ route('frontend.redirect_to_page', $detail->productVariant->slug ?? '' ) }}" class="fw-semibold lh-1 fs-5">
                                                    {{$product->has_variant ? $detail->productVariant->name : $product->name }}
                                                </a>
                                                <div>
                                                    @if($product->has_variant)
                                                        <div class="attribute mb-1">
                                                            @foreach(($detail->productVariant->attributePivots ?? []) as $attribute)
                                                                <div class="fs-7">{{ $attribute->attribute->name }}: {{ $attribute->value }}</div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="quantity fw-semibold mb-1">
                                                    <span>{{ trans('Quantity') }}: {{ $detail->quantity }}</span>
                                                </div>
                                                <div class="total_price fw-semibold d-flex align-items-end">
                                                    <span>{{ trans('Total Price') }}: {{ currency_format($detail->total_price) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                                <div>
                                    @if(!empty($data->voucher_code))
                                        <div class="voucher-price-info">
                                            <div class="d-flex justify-content-between w-100 w-md-80 m-auto">
                                                <span class="fw-semibold">Tổng tiền:</span>
                                                <span class="fw-bold">{{ currency_format($data->total_price) }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between w-100 w-md-80 m-auto">
                                                <span class="fw-semibold">Voucher:</span>
                                                <span class="fw-bold voucher-value text-success">-{{ currency_format($data->voucher_price) }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between w-100 w-md-80 m-auto">
                                            <span class="fw-semibold">Tổng tiền phải trả:</span>
                                            <span class="fw-bold final-price">{{ currency_format($data->total_price - $data->voucher_price) }}</span>
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-between w-100 w-md-80 m-auto">
                                            <span class="fw-semibold">Tổng tiền phải trả:</span>
                                            <span class="fw-bold final-price">{{ currency_format($data->total_price) }}</span>
                                        </div>
                                    @endif
                                    <div class="d-flex justify-content-between w-100 w-md-80 m-auto">
                                        <span class="fw-semibold">Phương thức thanh toán:</span>
                                        <span class="fw-bold">{{ trans(PaymentConfig::PAYMENT_METHOD[$data->payment_method]) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between w-100 w-md-80 m-auto">
                                        <span class="fw-semibold">Ghi chú:</span>
                                        <span class="fw-bold">{{ $data->note }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
    </section>
@endsection