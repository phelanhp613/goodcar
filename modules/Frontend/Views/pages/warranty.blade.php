@extends('Base::frontend.master')

@php
    pageSEO(
		(!empty($data->meta_title) ? $data->meta_title : trans('Warranty')),
		(!empty($data->meta_description) ? $data->meta_description : trans('Warranty Page')),
		(!empty($data->meta_keyword) ? $data->meta_keyword : trans('Warranty Page')),
		(!empty($data->canonical) ? $data->canonical : request()->url())
	);
@endphp

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datetimepicker/css/datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/select2-bootstrap5.min.css') }}"/>
    <style>
		iframe {
			max-height: 100% !important;
		}
    </style>
@endpush

@section('content')
    <div class="container mb-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs-md-6 fs-8">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ trans('Register warranty online') }}</li>
            </ol>
        </nav>
    </div>
    <div class="page-content">
        <h2 class="text-center">{{ trans('Register warranty online') }}</h2>
        <div class="container">
            <div class="warranty-container py-3">
                <form action="{{ route('post.warranty.create') }}" id="warranty-form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">Cảm ơn Quý vị đã mua sản phẩm của Basic Galaxy. Vui lòng điền thông tin sản phẩm để hoàn thành đăng ký bảo hành sản phẩm của quý vị.</div>
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    <label for="name" class="fw-semibold">{{ trans('Full Name') }}
                                        <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ trans("Full Name") }}">
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label for="phone" class="fw-semibold">{{ trans('Phone') }}
                                        <span class="text-danger">*</span></label>
                                    <input type="tel" name="phone" id="phone" class="form-control" placeholder="{{ trans("Phone") }}">
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    <label for="email" class="fw-semibold">{{ trans('Email') }}
                                        <span class="fw-normal">(Để nhận và lưu trữ xác nhận bảo hành điện tử)</span></label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="{{ trans("Email") }}">
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    <label for="address" class="fw-semibold">{{ trans('Address') }}
                                        <span class="text-danger">*</span></label>
                                    <input type="text" name="address" id="address" class="form-control" placeholder="{{ trans("Address") }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="product-id" class="fw-semibold">{{ trans('Product') }}</label>
                                    <i>(Nhập mã để tìm kiếm sản phẩm)</i>
                                    <x-base::autocomplete-field name="product_id" id="product-id" action="{{ route('get.product_variant.find') }}" :options="[]" :selected-options="[]" :multiple="false"/>
                                </div>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label for="purchase_date" class="fw-semibold">{{ trans('Purchase date') }}
                                    <span class="text-danger">*</span></label>
                                <input type="text" name="purchase_date" id="purchase_date" class="form-control date" placeholder="{{ trans("DD/MM/YYYY") }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="product-id" class="fw-semibold">
                                    {{ trans('Vui lòng đính kèm hình ảnh sản phẩm Basic và phiếu mua hàng') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <i>{{ trans('(Kích thước tối đa 3Mb, loại file PDF, JPG, JPEG & PNG)') }}</i>
                                <x-base::upload-file-multiple :accept-size="3000"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2 class="fs-5 mb-3">Vui lòng điền vào phần sau để giúp chúng tôi có thể hiểu bạn hơn. Xin cám ơn!</h2>
                            <hr>
                            @foreach($questions as $key => $item)
                                <div class="form-group mb-3">
                                    <label for="consult-product-{{ $key }}" class="fw-semibold mb-1">{{ $item['question'] ?? '' }}</label>
                                    <input type="hidden" name="answers[{{ $key }}][question]" value="{{ $item['question'] ?? '' }}">
                                    @if(!empty($item['answers']))
                                        <div class="px-3">
                                            @foreach($item['answers'] as $answer)
                                                <div class="form-group mb-2">
                                                    <label>
                                                        <input type="checkbox" class="me-2" name="answers[{{ $key }}][answer][]" value="{{ $answer }}">
                                                        <span>{{ $answer }}</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <textarea name="answers[{{ $key }}][answer][]" id="consult-product-{{ $key }}" class="form-control" rows="3"></textarea>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label class="fw-semibold">
                                        <span>{{ trans('Quý vị có muốn nhận thông tin cập nhật mới từ chúng tôi?') }}</span>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="px-2">
                                        <label class="d-flex align-items-start gap-2 mb-2">
                                            <input type="radio" name="accept_info" value="1" class="m-2" checked>
                                            <span>{{ 'Tôi muốn nhận thông tin cập nhật, thông tin sản phẩm và chương trình khuyến mãi' }}</span>
                                        </label>
                                        <label class="d-flex align-items-start gap-2">
                                            <input type="radio" name="accept_info" value="0" class="m-2">
                                            <span>
                                        {{ trans('Tôi không muốn nhận thông tin cập nhật, thông tin sản phẩm, chương trình khuyến mãi hoặc bất kỳ tài liệu tiếp thị trực tiếp nào khác và không đồng ý với việc Basic Galaxy sử dụng và cung cấp dữ liệu cá nhân của tôi cho mục đích tiếp thị trực tiếp.') }}
                                    </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="fw-semibold">
                                    <span>{{ trans('Tại Basic Galaxy, chúng tôi cam kết bảo vệ và tôn trọng sự riêng tư của dữ liệu cá nhân mà quý vị cung cấp cho chúng tôi. Bằng cách nhấp vào nút "Tôi chấp nhận"') }}</span>
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="px-2 mb-2">
                                    <div class="form-group">
                                        <label class="d-flex align-items-start gap-2">
                                            <input type="checkbox" name="accept_privacy" value="1" class="m-2">
                                            <span>{{ 'Tôi chấp nhận Chính sách bảo mật, có thể tìm thấy ở' }}</span>
                                            <a href="{{ route('frontend.redirect_to_page', 'chinh-sach-bao-mat') }}" target="_blank" class="fw-semibold text-decoration-underline"> {{ trans('đây') }}.</a>
                                        </label>
                                    </div>
                                </div>
                                <div class="px-2 mb-2">
                                    <div class="form-group">
                                        <label class="d-flex align-items-start gap-2">
                                            <input type="checkbox" name="accept_warranty" value="1" class="m-2">
                                            <span>{{ trans('Tôi chấp nhận các điều khoản và điều kiện bảo hành đầy đủ, có thể tìm thấy ở') }}</span>
                                            <a href="{{ route('frontend.redirect_to_page', 'chinh-sach-bao-hanh') }}" target="_blank" class="fw-semibold text-decoration-underline"> {{ trans('đây') }}.</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6Lf4eP0mAAAAAKYc1vsoteCaqakN0E5luoanDZxK" data-callback="onRecaptchaSuccess" data-expired-callback="onRecaptchaResponseExpiry" data-error-callback="onRecaptchaError"></div>
                    <span class="text-danger" id="recaptcha-required"></span>
                    <hr>
                    <button class="btn btn-primary py-3 px-4 rounded-0 fw-semibold shadow">{{ trans('Register Warranty') }}</button>
                </form>
            </div>
            <div class="py-3">
                <i><span class="fw-semibold text-decoration-underline">Lưu ý:</span> Quý khách sẽ nhận được tin nhắn xác nhận của chúng tôi trong vòng
                    <span class="fw-semibold">5 phút</span>. Nếu không nhận được tin nhắn, vui lòng kiểm tra lại thông tin số điện thoại của quý khách và thực hiện đăng ký lại.</i>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jsvalidation/jsvalidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datetimepicker/js/datetimepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datetimepicker/js/datetimepicker_main.js') }}"></script>
    {!! JsValidator::formRequest('Modules\Warranty\Requests\WarrantyRequest','#warranty-form') !!}
    <script>
		$(document).ready(function () {
			const uploadFileMultipleTitle = $('.upload-file-multiple-title');
			uploadFileMultipleTitle.html('Tải ảnh lên');
			uploadFileMultipleTitle.removeClass('fs-5');

			$(document).on('submit', '#warranty-form', function (e) {
				e.preventDefault();
				const body = $(document).find('.warranty-container');
				const url = $(this).attr('action');
				const data = $(this).serialize();
				$.ajax({
					url: url,
					data: data,
					method: "POST"
				}).done(function (res) {
					const html = `<div class="text-center pt-4 pb-5">
					                <div class="mb-3">
                                        <img src="{{ asset('/images/icon-success.svg') }}">
                                    </div>
                                    <div class="text-success h4">Yêu cầu của quý khách đã được ghi nhận</div>
                                    <div>Chúng tôi sẽ sớm liên lạc lại với quý khách!</div>
                                    <div>Xin cám ơn!</div>
                                  </div>`;
					body.html(html);
					$(document).find('#btn-back-to-top').click();
				}).fail(function (res) {
					const msg = res?.responseJSON?.errors['g-recaptcha-response'][0] ?? "{{ trans('Something went wrong') . '. ' . trans('Please contact us for assistance') }}";
					console.log(res?.responseJSON?.errors['g-recaptcha-response'][0]);
					console.log(res);
					$(document).find('#recaptcha-required').html(msg);
				});
			});
		});
    </script>
@endpush
