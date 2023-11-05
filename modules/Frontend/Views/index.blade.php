@extends('Base::frontend.master')
@php
    use Modules\Setting\Models\Website;
	$meta_title = cache('setting_website')[Website::META_TITLE]['value'] ?? getSetting(Website::META_TITLE) ?? NULL;
	$meta_description = cache('setting_website')[Website::META_DESCRIPTION]['value'] ?? getSetting(Website::META_DESCRIPTION) ?? NULL;
	$meta_keyword = cache('setting_website')[Website::META_KEYWORD]['value'] ?? getSetting(Website::META_KEYWORD) ?? NULL;
	$canonical = cache('setting_website')[Website::CANONICAL]['value'] ?? getSetting(Website::CANONICAL) ?? NULL;
    pageSEO(
        (!empty($meta_title) ? $meta_title : trans('Showroom Basic')),
        (!empty($meta_description) ? $meta_description : trans('Basic Home Page')),
        (!empty($meta_keyword) ? $meta_keyword : trans('Basic Home Page')),
        asset('/images/meta_image.png'),
        (!empty($canonical) ? $canonical : request()->url())
    );
@endphp
@section('content')
    <div class="home-content-page">
        @include('Frontend::home._banner')
        <div id="category-slide-section" class="container pt-3 home-owl-carousel">
            <div class="title-section mb-3">
                <h2><span class="px-2 fw-bold text-uppercase">{{ trans('Product Category') }}</span></h2>
            </div>
            <div class="category-owl-carousel invisible" id="category-owl-carousel-homepage">
                @foreach($product_categories as $item)
                    <div class="p-1">
                        <a href="{{ route('frontend.redirect_to_page', $item->slug) }}">
                            <div class="card">
                                <div class="ratio ratio-1x1">
                                    <img data-lazy="{{ env('APP_URL') . $item->image }}" alt="{{ env('APP_URL') . $item->image }}" class="card-img-top w-100 h-100" width="100" height="100">
                                </div>
                                <div class="card-footer bg-primary text-center">
                                    <span class="mb-0 text-white fs-8 fs-md-7 text-uppercase text-truncate text-truncate-1">{{ $item->name }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="arrows-container-category-owl-carousel-homepage d-flex justify-content-center"></div>
        </div>
        @include('Frontend::home._flash_sale')
        @include('Frontend::home._category_section')
        @if(!empty($homeFeaturedVideo))
            <div id="video-outstanding-section" class="container py-3">
                <div class="title-section mb-3">
                    <h2><span class="px-2 fw-bold text-uppercase">{{ trans('Featured Video') }}</span></h2>
                </div>
                <div class="row pt-3">
                    <div class="col-md-6 mb-3">
                        <a href="{{ $homeFeaturedVideo['main']['url'] ?? '' }}">
                            <img loading="lazy" class="lazy w-100 h-auto mb-2" width="100" height="100" data-src="{{ $homeFeaturedVideo['main']['image'] ?? '' }}" alt="">
                            <h3 class="fs-md-5 fs-6 fw-bold">{{ $homeFeaturedVideo['main']['label'] ?? '' }}</h3>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            @foreach($homeFeaturedVideo as $key => $video)
                                @continue($key == 'main')
                                <div class="col-6 mb-3">
                                    <a href="{{ $video['url'] ?? '' }}">
                                        <img loading="lazy" class="lazy w-100 h-auto mb-2" width="100" height="100" data-src="{{ $video['image'] ?? '' }}" alt="">
                                        <h3 class="fs-md-6 fs-7 fw-bold">{{ $video['label'] ?? '' }}</h3>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if(!empty($brandBannerImage))
            <div id="brand-section" class="container mb-3">
                <div class="title-section title-left mb-3">
                    <h2><span class="pe-2 fw-bold text-uppercase">{{ trans('Partners - Customers') }}</span></h2>
                </div>
                <div>
                    <a href="javascript:" aria-label="About Us">
                        <img loading="lazy" data-src="{{ $brandBannerImage }}" class="lazy w-100 h-auto mb-2" width="100" height="100" alt="{{ $brandBannerImage }}">
                    </a>
                </div>
            </div>
        @endif
        <div id="news-section" class="container mb-3">
            <div class="title-section title-left mb-3">
                <h2><a href="{{ route('frontend.get.news') }}"><span class="pe-2 fw-bold text-uppercase">{{ trans('News') }}</span></a></h2>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5">
                @foreach($posts as $item)
                    <div class="col mb-3">
                        <div class="card">
                            <a href="{{ route('frontend.redirect_to_page', $item->slug) }}" class="ratio ratio-16x9 post-image d-block" aria-label="{{ $item->title }}">
                                <img loading="lazy" data-src="{{ env('APP_URL') . $item->image }}" class="lazy card-img-top w-100 h-100 mb-2" width="100" height="100" alt="{{ $item->title }}">
                            </a>
                            <div class="card-body p-2 card-post">
                                <div class="d-flex justify-content-between flex-column h-100">
                                    <a href="{{ route('frontend.redirect_to_page', $item->slug) }}" class="card-title fs-7 fs-md-6 fw-semibold text-truncate text-truncate-2">
                                        {{ $item->title }}
                                    </a>
                                    <div class="card-description">
                                        <span class="text-truncate text-truncate-3 fs-8 fs-md-7">{!! $item->description !!}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center py-2 mb-3">
                <a href="{{ route('frontend.get.news') }}" class="btn btn-primary rounded-0">{{ trans('See More') }}</a>
            </div>
        </div>
    </div>
@endsection