@extends('Base::frontend.master')@php
    use App\Commons\CacheData\CacheDataService;
	use Modules\Setting\Models\Website;

    $image = getMainImage($variant_selected->images ?? $data->rootVariant()->images);
    pageSEO(
		(!empty($data->meta_title) ? $data->meta_title : trans('Product Detail')),
		(!empty($data->meta_description) ? $data->meta_description : trans('Product Page')),
		(!empty($data->meta_keyword) ? $data->meta_keyword : trans('Product Page')),
		(!empty($image) ? env('APP_URL') . $image : null),
		(!empty($data->canonical) ? $data->canonical : request()->url())
	);
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
                        <div class="row mb-5">
                            <div class="col-md-8">
                                <div class="product-images w-100 w-md-80 m-auto">
                                    <div class="slide-image px-2 px-md-5 position-relative">
                                        <div class="slick-single invisible">
                                            @if($data->has_variant)
                                                <div class="ratio ratio-1x1">
                                                    <img class="object-fit-cover w-100 h-100" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-lazy="{{ getMainImage($variant_selected->images ?? $data->rootVariant()->images) }}" alt="{{ getMainImage($variant_selected->images ?? $data->rootVariant()->images) }}" width="100" height="100">
                                                </div>
                                            @endif
                                            @foreach(json_decode($data->images) as $key => $val)
                                                @continue($key == 'main')
                                                <div class="ratio ratio-1x1">
                                                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-lazy="{{ $val }}" alt="{{ $val }}" class="object-fit-cover h-100 w-100" width="100" height="100" loading="lazy">
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="slick-single-arrows"></div>
                                    </div>
                                    <div class="slide-image p-md-4 p-0 position-relative">
                                        <div class="slick-nav p-2 invisible">
                                            @if($data->has_variant)
                                                <div class="active cursor-pointer ratio ratio-1x1">
                                                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-lazy="{{ getMainImage($variant_selected->images ?? $data->rootVariant()->images) }}" alt="{{ getMainImage($variant_selected->images ?? $data->rootVariant()->images) }}" width="100" height="100" class="object-fit-cover w-100 h-100">
                                                </div>
                                            @endif
                                            @foreach(json_decode($data->images) as $key => $val)
                                                @continue($key == 'main')
                                                <div class="cursor-pointer ratio ratio-1x1">
                                                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-lazy="{{ $val }}" alt="{{ $val }}" width="100" height="100" class="object-fit-cover w-100 h-100" @if($key > 3) loading="lazy" @endif>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="slick-nav-arrows"></div>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-block d-md-none">
                                    <div class="mb-3">
                                        @include('Frontend::product._form_product_detail')
                                        <div class="py-2">
                                            <a href="{{ route('frontend.get.consult', ['product_slug' => $data->slug]) }}" class="btn btn-success w-100 text-white rounded-0 shadow-sm">
                                                <span class="fw-semibold d-block">{{ trans('Consult') }}</span>
                                                <span class="fs-7 d-block">({{ trans('We will contact you later') }})</span>
                                            </a>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="product-suggest d-md-none d-block mb-5">
                                    @if($variant_selected->suggest_products->isNotEmpty())
                                        <div class="section-title">
                                            <h2 class="fs-4">{{ trans('Usually buy with') }}</h2>
                                        </div>
                                        <div class="product-owl-carousel invisible" id="product-suggest-mobile">
                                            @foreach($variant_selected->suggest_products as $suggest_product)
                                                @if(!empty($suggest_product->product))
                                                    <div class="p-1">
                                                        <x-product::product-variant-card :variant="$suggest_product"/>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="arrows-container-product-suggest-mobile d-flex justify-content-center"></div>
                                        <hr>
                                    @endif
                                </div>
                                <div class="product-content text-content">
                                    @if(!empty($data->content))
											<?php $content = json_decode($data->content ?? []); ?>
                                        <x-product::product-content :content="$content"/>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 sticky-place position-relative">
                                <div class="form-product-detail">
                                    <div class="d-none d-md-block">
                                        @include('Frontend::product._form_product_detail')
                                        <div class="py-2">
                                            <a href="{{ route('frontend.get.consult', ['product_slug' => $data->slug]) }}" class="btn btn-success w-100 text-white rounded-0 shadow-sm">
                                                <span class="fw-semibold d-block">{{ trans('Consult') }}</span>
                                                <span class="fs-7 d-block">({{ trans('We will contact you later') }})</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-suggest d-none d-md-block mb-5">
                                    @if($variant_selected->suggest_products->isNotEmpty())
                                        <hr>
                                        <div class="section-title">
                                            <h2 class="fs-4">{{ trans('Usually buy with') }}</h2>
                                        </div>
                                        <div class="product-owl-carousel-sidebar invisible" id="product-suggest">
                                            @foreach($variant_selected->suggest_products as $suggest_product)
                                                @if(!empty($suggest_product->product))
                                                    <div class="p-1">
                                                        <x-product::product-variant-card :variant="$suggest_product"/>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="arrows-container-product-suggest d-flex justify-content-center"></div>
                                    @endif
                                </div>
                                <div class="product-banner sticky-element d-none d-md-block">
                                    @php($cacheService = new CacheDataService())
                                    <a href="{{ ($cacheService->get('setting_website')[Website::PRODUCT_BANNER_LINK]['value']) ?? getSetting(Website::PRODUCT_BANNER_LINK) }}" aria-label="Product banner link">
                                        <img src="{{ ($cacheService->get('setting_website')[Website::PRODUCT_BANNER]['value']) ?? getSetting(Website::PRODUCT_BANNER) }}" width="100" height="100" class="w-100 h-auto" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="rating-box mb-4">
                        <x-rating::rating :model="['product' => $data]"/>
                    </div>
                    <div class="comment mb-4">
                        <x-comment::comment :data="$comments" :model="['name' => 'product_id', 'id' => $data->id]"/>
                    </div>
                    @if($related_products->isNotEmpty())
                        <div class="product-related mb-3">
                            <div class="section-title">
                                <h2 class="fs-4">{{ trans('Related Product') }}</h2>
                            </div>
                            <div class="product-owl-carousel invisible" id="product-related">
                                @foreach($related_products as $related_product)
                                    <div class="p-1">
                                        <x-product::product-card :product="$related_product"/>
                                    </div>
                                @endforeach
                            </div>
                            <div class="arrows-container-product-related d-flex justify-content-center"></div>
                        </div>
                    @endif
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
        @if(!empty($variant_selected))
            @include('Frontend::product.order_now._form_order_now')
            <button type="button" class="btn-order-mobile btn btn-sm btn-info border border-info p-0 position-fixed shadow rounded-5 d-block d-md-none" data-bs-toggle="modal" data-bs-target="#product-order-modal">
                <span class="fw-semibold border boder-white rounded-5 w-100 d-inline-block py-1 text-white">{{ trans('Order Now') }}</span>
            </button>
        @endif
    </div>
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
    @php($ratingCount = $data->ratings->count())
    @php($ratingsAvg = number_format((float)$data->ratings->avg('rate') ?? 5, 2, '.', ''))
    @php($author_rating = $data->ratings->whereIn("rate", [4, 5])->first())
    <script type="application/ld+json" id="product-structure">
        {
          "@context": "https://schema.org/",
          "@type": "Product",
          "name": "{{ $variant_selected->name ?? '' }}",
          "image": "{{ getMainImage($variant_selected->images ?? $data->rootVariant()->images) }}",
          "description": "{{ $data->meta_description ?? '' }}",
          "review": {
            "@type": "Review",
            "reviewRating": {
              "@type": "Rating",
              "ratingValue": "{{ $author_rating->rate ?? 5 }}",
              "bestRating": 5
            },
            "author": {
              "@type":"Person",
              "name": "{{ $author_rating->name ?? 'Person' }}"
            }
          },
          "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "{{ $ratingsAvg > 0 ? $ratingsAvg : 5 }}",
            "reviewCount": "{{ $ratingCount > 0 ? $ratingCount : 1 }}"
          },
          "offers": {
            "@type": "Offer",
            "availability": "https://schema.org/InStock",
            "price": "{{ ($variant_selected->discount > 0) ? $variant_selected->discount : $variant_selected->price }}",
            "priceCurrency": "VND"
          }
       }

    </script>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "name": "Home",
                    "item": "{{ route('frontend.home') }}"
                },{
                    "@type": "ListItem",
                    "position": 2,
                    "name": "{{ $data->category->name ?? '' }}",
                    "item": "{{ route('frontend.redirect_to_page', $data->category->slug ?? '') }}"
                },{
                    "@type": "ListItem",
                    "position": 3,
                    "name": "{{ $data->name ?? ''}}"
                }
            ]
        }

    </script>
@endpush
