@extends('Base::frontend.master')@php
    $image = getMainImage($variant_selected->images ?? $data->rootVariant()->images);
@endphp
@push('css')
    <style>
		* {
			scroll-margin-top: 115px;
		}

		.variant .btn {
			min-width: 100px;
		}

		/* Increase decrease button */
		.icon-shape {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			text-align: center;
			vertical-align: middle;
			width: 2rem;
			height: 2rem;
		}
    </style>
@endpush
@section('content')
    <div class="product-detail-page">
        <div class="container mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb fs-md-6 fs-8">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('frontend.redirect_to_page', $data->category->slug) }}">{{ $data->category->name }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $data->name }}</li>
                </ol>
            </nav>
            @if(!empty($variant_selected))
                <div class="page-content">
                    <div class="product-detail">
                        <h1 class="product-name fs-md-3 fs-5">{{ ($data->has_variant) ? ($variant_selected->name ?? $data->rootVariant()->name) : $data->name }}</h1>
                        <hr>
                        <div class="mb-5">
                            <div class="product-images w-100">
                                <div class="slide-image px-2 px-md-5 position-relative">
                                    <div class="slick-single invisible">
                                        @if($data->has_variant)
                                            <div class="ratio ratio-16x9">
                                                <img class="object-fit-contain w-100 h-100" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-lazy="{{ getMainImage($variant_selected->images ?? $data->rootVariant()->images) }}" alt="{{ getMainImage($variant_selected->images ?? $data->rootVariant()->images) }}" width="100" height="100">
                                            </div>
                                        @endif
                                        @foreach(json_decode($variant_selected->images) as $key => $val)
                                            @continue($key == 'main')
                                            <div class="ratio ratio-16x9">
                                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-lazy="{{ $val }}" alt="{{ $val }}" class="object-fit-contain h-100 w-100" width="100" height="100" loading="lazy">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="slick-single-arrows"></div>
                                </div>
                                <div class="slide-image p-md-4 p-0 position-relative">
                                    <div class="slick-nav p-2 invisible">
                                        @if($data->has_variant)
                                            <div class="active cursor-pointer ratio ratio-16x9">
                                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-lazy="{{ getMainImage($variant_selected->images ?? $data->rootVariant()->images) }}" alt="{{ getMainImage($variant_selected->images ?? $data->rootVariant()->images) }}" width="100" height="100" class="object-fit-contain w-100 h-100">
                                            </div>
                                        @endif
                                        @foreach(json_decode($variant_selected->images) as $key => $val)
                                            @continue($key == 'main')
                                            <div class="cursor-pointer ratio ratio-16x9">
                                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-lazy="{{ $val }}" alt="{{ $val }}" width="100" height="100" class="object-fit-contain w-100 h-100" @if($key > 3) loading="lazy" @endif>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="slick-nav-arrows"></div>
                                </div>
                            </div>
                            <hr>
                            @include('Frontend::product._form_product_detail')
                            <div class="product-content text-content">
                                @if(!empty($data->content))
                                    @php($content = json_decode($data->content ?? []))
                                    <x-product::product-content :content="$content"/>
                                @endif
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            @else
                <div class="text-center d-flex justify-content-center align-items-center" style="height: 60vh">
                    <div>
                        <h1 class="fw-normal mb-4"><i>{{ trans('Your product will be coming soon!') }}</i></h1>
                        <a href="{{ route('frontend.home') }}" class="btn btn-primary fw-semibold">{{ trans('Back Home') }}</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @if(!empty($variant_selected))
        <div class="position-fixed btn-order-fixed">
            <a href="{{ route('frontend.get.order', ['variant_id' => $variant_selected->id]) }}" class="btn btn-danger py-3 text-white fw-semibold">{{ trans('Order now') }} {{ $variant_selected->name }}</a>
        </div>
    @endif
@endsection

@push('js')
    @if(in_array('view', request()->segments()))
        <script>
			$(document).ready(function () {
				$('button').attr('type', 'button');
			});
        </script>
    @endif
    <script src="{{ asset('assets/js/frontend_product.js') }}?v={{ env('APP_VERSION', '1') }}" type="text/javascript"></script>
@endpush
