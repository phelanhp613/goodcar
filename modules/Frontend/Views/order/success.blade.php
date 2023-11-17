@php use Modules\Setting\Models\PaymentConfig; @endphp@extends('Base::frontend.master')
@section('content')
    <div class="container">
        <div class="py-5 d-flex justify-content-center align-items-center my-5">
            <div class="card bg-white border-top border-5 border-primary border-start-0 border-end-0 border-bottom-0 shadow p-5">
                <div class="mb-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="75" height="75" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-center">
                        <h1 class="text-success">{{ trans('Thank you') }}!</h1>
                        <div class="fs-7 fs-md-5 mb-4">{{ trans('Your order has been successfully placed, please wait for our staff to contact you') }}</div>
                    </div>
                    @if(!empty($data))
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="fs-4 border-bottom border-1 pb-2">Thông tin khách hàng</h2>
                                <div class="text-danger fw-semibold">Đơn hàng: #{{ $data->code }}</div>
                                <div>Tên khách hàng: {{ $data->name }}</div>
                                <div>Số điện thoại: {{ $data->phone }}</div>
                                <div>Email: {{ $data->email }}</div>
                                <div>Địa chỉ: {{ $data->address }}</div>
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
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div class="mb-2">
                                        <div>Để hoàn tất đơn hàng, Quý khách vui lòng điền
                                            <span class="fw-semibold text-danger">Mã Đơn Hàng - #{{ $data->code }}</span> của Quý khách trong phần nội dung thanh toán.
                                        </div>
                                        <div>Chúng tôi sẽ thực hiện giao hàng khi nhận được thông tin chuyển khoản thành công từ Quý khách!</div>
                                        <div>Trân trọng cảm ơn!</div>
                                    </div>
                                    <h2 class="fs-4">Thông tin chuyển khoản ngân hàng</h2>
                                    @if( empty($paymentConfig['BANK_ACCOUNT_NAME']) || empty($paymentConfig['BANK_NAME']) || empty($paymentConfig['BANK_ACCOUNT_NUMBER']))
                                        <a href="{{ route('frontend.redirect_to_page', 'lien-he') }}" class="text-decoration-underline fw-semibold">{{ trans('Vui lòng liên hệ với chúng tôi') }}</a>
                                    @else
                                        <div class="ps-3">
                                            <div class="fs-5 fw-semibold">{{ $paymentConfig['BANK_ACCOUNT_NAME'] ?? '' }}</div>
                                            <div>- Ngân hàng:
                                                <span class="fw-semibold">{{ $paymentConfig['BANK_NAME'] ?? '' }}</span>
                                            </div>
                                            <div>- Số tài khoản:
                                                <span class="fw-semibold">{{ $paymentConfig['BANK_ACCOUNT_NUMBER'] ?? '' }}</span>
                                            </div>
                                            <div>- Số tiền chuyển khoản:
                                                @php($bankTransfer = (($data->payment_method == 'bank_20') ? 20 : 100))
                                                <span class="fw-semibold">{{ currency_format($data->total_price * $bankTransfer / 100, 'đ') }}</span>
                                            </div>
                                            <div>- Nội dung:
                                                <span class="fw-semibold">#{{ $data->code }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection