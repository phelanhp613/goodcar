@extends('Base::frontend.master')@php
    pageSEO(
		(!empty($data->meta_title) ? $data->meta_title : trans('Product Search')),
		(!empty($data->meta_description) ? $data->meta_description : trans('Product Search Page')),
		(!empty($data->meta_keyword) ? $data->meta_keyword : trans('Product Search Page')),
		(!empty($data->canonical) ? $data->canonical : request()->url())
	);
@endphp
@section('content')
    <div class="container mb-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs-md-6 fs-8">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ trans('Search results for')}} "<span class="fw-semibold text-success">{{$keyword}}</span>"
                </li>
            </ol>
        </nav>
        <div class="page-content py-2">
            @if(!$data->isEmpty())
                <div class="product-list row row-cols-2 row-cols-md-3 row-cols-lg-4">
                    @foreach($data as $product)
                        @foreach($product->variants as $variant)
                            <div class="col mb-4">
                                <x-product::product-variant-card :variant="$variant"/>
                            </div>
                        @endforeach
                    @endforeach
                </div>
                <div class="product-list-pagination text-center">
                    <a href="{{ $data->hasMorePages() ? $data->withQueryString()->nextPageUrl() : 'javascript:' }}" class="btn btn-outline-primary btn-show-more @if(!$data->hasMorePages()) d-none @endif">
                        {{ trans('Show more') }}
                    </a>
                </div>
            @else
                <div class="vh-100 py-5">
                    <i>{{ trans('No products were found matching your search.') }}</i>
                    <a href="{{ route('frontend.home') }}" class="text-decoration-underline text-primary fw-semibold">{{ trans('Back Home') }}</a>
                </div>
            @endif
        </div>
    </div>
@endsection
@push('js')
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