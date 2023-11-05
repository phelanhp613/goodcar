@extends('Base::frontend.master')

@php
    pageSEO(
		(!empty($data->meta_title) ? $data->meta_title : trans('Consult')),
		(!empty($data->meta_description) ? $data->meta_description : trans('Consult Page')),
		(!empty($data->meta_keyword) ? $data->meta_keyword : trans('Consult Page')),
		(!empty($data->canonical) ? $data->canonical : request()->url())
	);
@endphp
@section('content')
    <div class="container mb-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs-md-6 fs-8">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ trans('Consult') }}</li>
            </ol>
        </nav>
    </div>
    <div class="page-content">
        <h2 class="text-center">{{ trans('Hãy để lại thông tin tư vấn cho chúng tôi') }}</h2>
        <div class="container py-3">
            <div class="border rounded-3 p-4 mx-auto" style="max-width: 800px" id="consult-form">
                <form action="{{ route('post.consult.create') }}" method="post" id="consult-form-submit">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="consult-name" class="fw-semibold mb-1">{{ trans('Full name') }}</label>
                                <input type="text" name="name" id="consult-name" class="form-control" placeholder="{{ trans('Full name') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="consult-phone" class="fw-semibold mb-1">{{ trans('Phone') }}</label>
                                <input type="tel" name="phone" id="consult-phone" class="form-control" placeholder="{{ trans('Phone') }}">
                            </div>
                        </div>
                    </div>
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
                    <div>
                        <label class="fw-semibold">
                            <span>{{ trans('Tại Basic Galaxy, chúng tôi cam kết bảo vệ và tôn trọng sự riêng tư của dữ liệu cá nhân mà quý vị cung cấp cho chúng tôi. Bằng cách nhấp vào nút "Tôi chấp nhận"') }}</span>
                            <span class="text-danger">*</span>
                        </label>
                        <div class="px-2 mb-2">
                            <div class="form-group">
                                <label class="d-flex align-items-start gap-2">
                                    <input type="checkbox" name="accept_privacy" value="1" class="m-2">
                                    <span>{{ 'Tôi chấp nhận Chính sách bảo mật, có thể tìm thấy ở' }}
                                        <a href="{{ route('frontend.redirect_to_page', 'chinh-sach-bao-mat') }}" target="_blank" class="fw-semibold text-decoration-underline"> {{ trans('đây') }}.</a>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="text-center py-3">
                        <input type="hidden" name="product_id" value="{{ $productSlug }}">
                        <button type="submit" class="btn btn-primary me-2 w-100 rounded-0">{{ trans('Send') }}</button>
                    </div>
                </form>
            </div>
        </div>
        @if(!empty($consultants))
            <div class="bg-primary py-5">
                <div class="container text-white">
                    <div class="text-center py-3 mb-3">
                        <h2 class="mb-3">{{ trans('Our consultants') }}</h2>
                        <hr class="w-30 m-auto border-top border-3 border-white opacity-100">
                    </div>
                    <div class="row">
                        @foreach($consultants as $consultant)
                            <div class="col-md-4">
                                <div class="card border-0 bg-transparent p-3 h-100">
                                    <div class="card-image p-3">
                                        <div class="ratio ratio-1x1">
                                            <img loading="lazy" alt="{{ $consultant['name'] ?? '' }}" class="object-fit-cover border border-white rounded w-100 h-100 lazy" width="1" height="1" data-src="{{ $consultant['avatar'] ?? '' }}" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==">
                                        </div>
                                    </div>
                                    <div class="card-body text-center pt-0 h-100 d-flex justify-content-between flex-column">
                                        <h5 class="mb-3 fs-md-5 fs-6">{{ $consultant['name'] ?? '' }}</h5>
                                        <div class="description mb-3">
                                            {{ $consultant['description'] ?? '' }}
                                        </div>
                                        <div class="button-group">
                                            <a class="btn bg-secondary text-primary me-2" target="_blank" href="https://zalo.me/{{ $consultant['phone'] ?? '' }}">
                                                <svg role="img" aria-hidden="true" focusable="false" width="30" height="30" data-prefix="far" data-icon="comments" class="svg-inline--fa fa-comments" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                                    <path fill="currentColor" d="M208 0C322.9 0 416 78.8 416 176C416 273.2 322.9 352 208 352C189.3 352 171.2 349.7 153.9 345.8C123.3 364.8 79.13 384 24.95 384C14.97 384 5.93 378.1 2.018 368.9C-1.896 359.7-.0074 349.1 6.739 341.9C7.26 341.5 29.38 317.4 45.73 285.9C17.18 255.8 0 217.6 0 176C0 78.8 93.13 0 208 0zM164.6 298.1C179.2 302.3 193.8 304 208 304C296.2 304 368 246.6 368 176C368 105.4 296.2 48 208 48C119.8 48 48 105.4 48 176C48 211.2 65.71 237.2 80.57 252.9L104.1 277.8L88.31 308.1C84.74 314.1 80.73 321.9 76.55 328.5C94.26 323.4 111.7 315.5 128.7 304.1L145.4 294.6L164.6 298.1zM441.6 128.2C552 132.4 640 209.5 640 304C640 345.6 622.8 383.8 594.3 413.9C610.6 445.4 632.7 469.5 633.3 469.9C640 477.1 641.9 487.7 637.1 496.9C634.1 506.1 625 512 615 512C560.9 512 516.7 492.8 486.1 473.8C468.8 477.7 450.7 480 432 480C350 480 279.1 439.8 245.2 381.5C262.5 379.2 279.1 375.3 294.9 369.9C322.9 407.1 373.9 432 432 432C446.2 432 460.8 430.3 475.4 426.1L494.6 422.6L511.3 432.1C528.3 443.5 545.7 451.4 563.5 456.5C559.3 449.9 555.3 442.1 551.7 436.1L535.9 405.8L559.4 380.9C574.3 365.3 592 339.2 592 304C592 237.7 528.7 183.1 447.1 176.6L448 176C448 159.5 445.8 143.5 441.6 128.2H441.6z"></path>
                                                </svg>
                                                <span class="fw-semibold ps-2">{{ $consultant['phone'] ?? 'Hãy trao đổi' }}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/vendor/jsvalidation/jsvalidation.min.js') }}"></script>
    {!! JsValidator::formRequest('Modules\Consult\Requests\ConsultRequest','#consult-form-submit') !!}
    <script>
		$(document).ready(function () {
			$(document).on('submit', '#consult-form-submit', function (e) {
				e.preventDefault();
				const body = $(document).find('#consult-form');
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
                                    <div>Tư vấn viên sẽ sớm liên lạc lại với quý khách!</div>
                                    <div>Xin cám ơn!</div>
                                  </div>
                                  <div class="small text-end"><i>Sẽ tự động quay lại trang trước sau <span id="second-countdown"></span> giây.</i></div>`;
					body.html(html);

					let seconds = 6;

					function countDown() {
						if (seconds > 0) {
							seconds--;
							$(document).find('#second-countdown').html(seconds);
							setTimeout(() => countDown(), 1000);
						} else {
							window.location.href = '{{ $previousUrl }}';
						}
					}

					countDown();
				});
			});
		})
    </script>
@endpush
