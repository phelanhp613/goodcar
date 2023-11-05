@extends('Base::frontend.master')@php
    pageSEO(
		(!empty($data->meta_title) ? $data->meta_title : trans('Flash Sale')),
		(!empty($data->meta_description) ? $data->meta_description : trans('Flash Sale Page')),
		(!empty($data->meta_keyword) ? $data->meta_keyword : trans('Flash Sale Page')),
		(!empty($data->canonical) ? $data->canonical : request()->url())
	);
@endphp
@push('css')
    <style>
		.timing-box-date {
			font-size: 25px !important;
		}
    </style>
@endpush
@section('content')
    @php($remainingDate = $flashSaleConfig['remaining_date'])
    <div class="flash-sale h-100 w-100 pb-5 @if($remainingDate->total_s < 1) bg-gray @else bg-primary @endif" id="flash-sale" style="min-height: 100vh">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb fs-md-6 fs-8 opacity-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('Flash Sale') }}</li>
                </ol>
            </nav>
            <div class="page-content">
                <div class="title text-center mb-4">
                    <img src="{{ asset($remainingDate->total_s > 0 ? 'images/flash-sale.png' : 'images/flash-sale-none.png') }}" class="w-80 w-md-50 h-auto" alt="" width="100" height="100">
                </div>
                @if($remainingDate->total_s > 0)
                    <div class="flash-sale-timing text-center d-flex justify-content-center mb-3">
                        <x-base::count-down-timer :date="$remainingDate"/>
                    </div>
                    @php($displayNo = 4)
                    @php($cateSlug = request()->slug)
                    <div id="category" class="w-100 d-flex justify-content-center py-4 text-center">
                        <ul class="ps-0 mb-0 d-flex w-100 list-unstyled bg-white nav-category">
                            <li class="w-100 px-2 py-3">
                                <a href="{{ route('frontend.product.flashsale') }}" class="fw-semibold @if(empty($cateSlug)) active @endif">Sản phẩm bán chạy</a>
                            </li>
                            @foreach($categories as $key => $category)
                                @if($key < $displayNo)
                                    <li class="w-100 px-2 py-3 @if($cateSlug == $category->slug) active @endif">
                                        <a href="{{ route('frontend.product.flashsale', ['slug' => $category->slug]) }}" class="fw-semibold @if($cateSlug == $category->slug) active @endif">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        @if($categories->count() > $displayNo)
                        <div class="dropdown px-3 py-3 bg-white">
                            <a class="dropdown-toggle fw-semibold" href="javascript:" data-bs-toggle="dropdown" aria-expanded="false">
                                Xem thêm
                            </a>
                            <ul class="dropdown-menu bg-white">
                                @foreach($categories as $key => $category)
                                    @if($key >= $displayNo)
                                        <li class="w-100 p-2">
                                            <a href="{{ route('frontend.product.flashsale', ['slug' => $category->slug]) }}" class="dropdown-item fw-semibold @if($cateSlug == $category->slug) active @endif">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    <div class="flash-sale-list product-list row row-cols-lg-4 row-cols-md-3 row-cols-2">
                        @foreach($products as $product)
                            <div class="col mb-3">
                                <x-product::product-card-flash-sale :product="$product"/>
                            </div>
                        @endforeach
                    </div>
                    <div class="product-list-pagination text-center">
                        <a href="{{ $products->hasMorePages() ? $products->withQueryString()->nextPageUrl() : 'javascript:' }}" class="btn btn-primary btn-show-more @if(!$products->hasMorePages()) d-none @endif">
                            {{ trans('Show more') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/vendor/jsvalidation/jsvalidation.min.js') }}"></script>
    {!! JsValidator::formRequest('Modules\Contact\Requests\ContactRequest','#contact-form') !!}
    <script>
		$(document).ready(function () {
			$(document).on("click", ".btn-show-more", function (e) {
				e.preventDefault();
				const btnMore = $(this);
				const url = $(this).attr('href');
				$.ajax({
					url: url,
					method: "GET"
				}).done(function (response) {
					$(document).find('.product-list').append($(response).find('.product-list').html());
					$('.lazy').lazy();
					const newBtnMoreHref = $(response).find('.btn-show-more').attr('href');
					if (newBtnMoreHref === 'javascript:') {
						btnMore.hide();
					}
					btnMore.attr('href', $(response).find('.btn-show-more').attr('href'))
				});
			});
		})
    </script>
@endpush
