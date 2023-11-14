@extends('Base::frontend.master')@php
    $sorts = [
        'best_sellers' => trans('Best sellers'),
        'price_down' => trans('Price down'),
        'price_up' => trans('Price up'),
    ];
    $requestCategories = request()->categories ?? [];
    $currentSort = request()->sort_by ?? 'best_sellers';
@endphp
@section('content')
    <div class="container mb-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs-md-6 fs-8">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                @if(!empty($keyword))
                <li class="breadcrumb-item active" aria-current="page">
                    <span>{{ trans('Search results for')}}</span> "
                    <span class="fw-semibold text-success">{{$keyword}}</span>"
                </li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">
                        <span>{{ trans('Search') }}</span>
                    </li>
                @endif
            </ol>
        </nav>
        <div class="page-content py-2 row">
            <div class="col-md-3">
                <h2 class="h4">{{ trans('Filter') }}</h2>
                <form action="" method="get">
                    <input type="text" class="form-control mb-3" name="keyword" value="{{ $keyword ?? '' }}">
                    @include('Frontend::product._search_form')
                </form>
            </div>
            <div class="col-md-9">
                <div class="dropdown d-flex justify-content-end">
                    <div class="dropdown-toggle border py-1 px-2 needsclick" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fw-semibold">{{ trans('Sort by') }}:</span> {{ $sorts[$currentSort] }}
                    </div>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item @if($currentSort == 'best_sellers') active @endif" href="{{ request()->fullUrlWithQuery(['sort_by' => 'best_sellers']) }}">{{ $sorts['best_sellers'] }}</a>
                        </li>
                        <li>
                            <a class="dropdown-item @if($currentSort == 'price_down') active @endif" href="{{ request()->fullUrlWithQuery(['sort_by' => 'price_down']) }}">{{ $sorts['price_down'] }}</a>
                        </li>
                        <li>
                            <a class="dropdown-item @if($currentSort == 'price_up') active @endif" href="{{ request()->fullUrlWithQuery(['sort_by' => 'price_up']) }}">{{ $sorts['price_up'] }}</a>
                        </li>
                    </ul>
                </div>
                <hr>
                @if(!$data->isEmpty())
                    <div class="product-list row row-cols-2 row-cols-md-2 row-cols-lg-3">
                        @foreach($data as $variant)
                            <div class="col mb-4">
                                <x-product::product-variant-card :variant="$variant"/>
                            </div>
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
					lazyLoad();
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