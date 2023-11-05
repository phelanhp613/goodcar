@php use Modules\Setting\Models\PaymentConfig; @endphp@extends('Base::frontend.master')
@section('content')
    <div class="container">
        <div class="py-5 d-flex justify-content-center align-items-center my-5">
            <div class="card bg-white border-top border-5 border-primary border-start-0 border-end-0 border-bottom-0 shadow p-5">
                <div class="mb-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="75" height="75" class="text-warning" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-center">
                        <h1 class="text-warning">{{ trans('Confirm Order') }}!</h1>
                        <div class="fs-7 fs-md-5 mb-4">{{ trans('Complete the final step to confirm your order') }}</div>
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
                                <h2 class="fs-4 border-bottom border-1 pb-2 mb-3">Voucher</h2>
                                <div class="voucher form-group mb-4">
                                    <div class="input-group mb-3" id="voucher-group">
                                        <input type="text" name="voucher_code" class="form-control" value="" id="voucher-code" placeholder="Nhập mã voucher" aria-label="Voucher">
                                        <button class="btn btn-primary input-group-text" id="voucher-code-btn">{{ trans('Áp dụng') }}</button>
                                    </div>
                                    <div class="text-danger voucher-expired d-none">{{ trans('This voucher has expired') }}</div>
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
                                    <div class="voucher-price-info d-none">
                                        <div class="d-flex justify-content-between w-100 w-md-80 m-auto">
                                            <span class="fw-semibold">Tổng tiền:</span>
                                            <span class="fw-bold">{{ currency_format($data->total_price) }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between w-100 w-md-80 m-auto">
                                            <span class="fw-semibold">Voucher:</span>
                                            <span class="fw-bold voucher-value text-success"></span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between w-100 w-md-80 m-auto">
                                        <span class="fw-semibold">Tổng tiền phải trả:</span>
                                        <span class="fw-bold final-price">{{ currency_format($data->total_price) }}</span>
                                    </div>
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
                                @if($data->payment_method === 'bank')
                                    <div>
                                        <div class="mb-2">
                                            <div>Để hoàn tất đơn hàng, Quý khách vui lòng điền
                                                <span class="fw-semibold">Mã Đơn Hàng</span> của Quý khách trong phần nội dung thanh toán.
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
                                                <div>- Nội dung:
                                                    <span class="fw-semibold">#{{ $data->code }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="fs-5">Nhận hàng – Kiểm tra – Thanh toán</div>
                                @endif
                            </div>
                        </div>
                        <div class="py-2">
                            <label class="fw-semibold">
                                <span>{{ trans('Tại Basic Galaxy, chúng tôi cam kết bảo vệ và tôn trọng sự riêng tư của dữ liệu cá nhân mà quý vị cung cấp cho chúng tôi. Bằng cách nhấp vào nút "Tôi chấp nhận"') }}</span>
                                <span class="text-danger">*</span>
                            </label>
                            <div class="px-2 mb-2">
                                <div class="form-group">
                                    <label class="d-flex align-items-start gap-2">
                                        <input type="checkbox" id="accept-privacy" value="1" class="m-2">
                                        <span>{{ 'Tôi chấp nhận Chính sách bảo mật, có thể tìm thấy ở' }}
                                            <a href="{{ route('frontend.redirect_to_page', 'chinh-sach-bao-mat') }}" target="_blank" class="fw-semibold text-decoration-underline"> {{ trans('đây') }}.</a>
                                        </span>
                                    </label>
                                    <div class="text-danger accept-privacy-error d-none">
                                        {{ trans('Required') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center py-4">
                            <form action="{{ route('frontend.post.order.confirm', $data->code) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="otp_code" class="fw-semibold">{{ trans('Vui lòng nhập mã OTP gửi đến sđt của bạn để xác nhận đơn hàng') }}</label>
                                    <input type="text" name="otp_code" id="otp_code" class="form-control">
                                    <div class="text-danger otp_code-error d-none">
                                        {{ trans('Required') }}
                                    </div>
                                </div>
                                <div id="countdown-resend-sms" class="mb-3">
                                    <small>{{ trans('You can request sms resend after') }}
                                        <span class="fw-semibold second">15</span> {{ trans('second') }}
                                    </small>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <input type="hidden" name="voucher_code" id="voucher_code">
                                    <input type="hidden" name="voucher_price" id="voucher_price">
                                    <button type="submit" class="btn btn-success text-white rounded-0 me-2" id="complete-order-btn">
                                        {{ trans('Confirm Order') }}
                                    </button>
                                    <a href="{{ route('frontend.order.abort', $data->code) }}" class="btn btn-danger text-white rounded-0" id="abort-order-btn">{{ trans('Abort Order') }}</a>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
		$(document).ready(function () {
			makeTimer();

			function makeTimer() {
				const resendContainer = $(document).find('#countdown-resend-sms');
				let waitingSecond = 14;

				setInterval(() => {
					if (waitingSecond > 0) {
						resendContainer.find('.second').html(waitingSecond);
						waitingSecond = waitingSecond - 1;
					}
				}, 1000);

				setTimeout(() => {
					resendContainer.html(`<small><u class="fw-semibold"><a href="{{ route('frontend.order.resendSMS', $data->code) }}">{{ trans('Resend SMS') }}</a></u></small>`);
				}, (waitingSecond + 1) * 1000);
			}

			$(document).on('click', '#abort-order-btn', function (e) {
				e.preventDefault();
				if (confirm("{{ trans('Are you sure to cancel this order?') }}")) {
					window.location.href = $(this).attr('href');
				}
			});

			$(document).on('click', '#voucher-code-btn', function () {
				const voucherCode = $(document).find('#voucher-code').val();
				if (voucherCode !== '' && voucherCode !== null && voucherCode !== undefined) {
					$.ajax({
						url: "{{ route('get.voucher.info') }}?code=" + voucherCode,
						method: 'GET'
					}).done(function (response) {
						if (response.status) {
							$(document).find('.voucher-expired').addClass('d-none');
							const currentPrice = "{{$data->total_price}}";
							let value = response.data.value.toLocaleString('it-IT', {
								style: 'currency',
								currency: 'VND'
							}).replace('VND', '');

							let valuePrice;
							if (response.data.type === 'price') {
								valuePrice = response.data.value;
								value += 'đ';
							} else {
								valuePrice = currentPrice * response.data.value / 100;
								value += '%';
							}
							const finalPrice = currentPrice - valuePrice;
							$(document).find('#voucher_code').val(voucherCode);
							$(document).find('#voucher_price').val(valuePrice);
							$(document).find('.voucher-price-info').removeClass('d-none');
							$(document).find('.voucher-value').html('-' + value);
							$(document).find('.final-price').html(finalPrice.toLocaleString('it-IT', {
								style: 'currency',
								currency: 'VND'
							}).replace('VND', 'đ'));
						} else {
							$(document).find('.voucher-expired').removeClass('d-none');
						}
					});
				}
			});

			$(document).on('click', '#complete-order-btn', function (e) {
				if (!$('#accept-privacy').is(":checked")) {
					e.preventDefault();
					$(".accept-privacy-error").removeClass('d-none');
				} else {
					$(".accept-privacy-error").addClass('d-none');
				}

				if ($('#otp_code').val() === null || $('#otp_code').val() === "" || $('#otp_code').val() === undefined) {
					e.preventDefault();
					$(".otp_code-error").removeClass('d-none');
				} else {
					$(".otp_code-error").addClass('d-none');
				}
			});
		})
    </script>
@endpush