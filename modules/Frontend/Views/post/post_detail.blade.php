@extends('Base::frontend.master')@php
    pageSEO(
		(!empty($data->meta_title) ? $data->meta_title : trans('News Detail')),
		(!empty($data->meta_description) ? $data->meta_description : trans('News Detail Page')),
		(!empty($data->meta_keyword) ? $data->meta_keyword : trans('News Detail Page')),
		(!empty($data->image) ? $data->image : null),
		(!empty($data->canonical) ? $data->canonical : request()->url())
	);
@endphp
@php use Modules\Setting\Models\Website; @endphp
@section('content')
    <div class="container mb-5">
        <div class="page-content">
            <div class="container-post">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb fs-md-6 fs-8">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('frontend.redirect_to_page', $data->category->slug) }}">{{ $data->category->name }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $data->title }}</li>
                    </ol>
                </nav>
                <h1 class="fs-3 mb-3">{{ $data->title }}</h1>
                <div class="mb-3">{!! $data->description !!}</div>
				<?php $content = json_decode($data->content ?? []); ?>
                <x-base::post-content :content="$content"/>
            </div>
            @if(!empty($related_posts) && $related_posts->isNotEmpty())
                <div id="news-section" class="mb-3">
                    <div class="title-section title-left mb-3">
                        <h2><span class="pe-2 fw-bold text-uppercase">{{ trans('Related News') }}</span></h2>
                    </div>
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5">
                        @foreach($related_posts as $item)
                            <div class="col mb-5">
                                <div class="card">
                                    <a href="{{ route('frontend.redirect_to_page', $item->slug) }}" class="ratio ratio-16x9 post-image d-block" aria-label="{{ $item->title }}">
                                        <img loading="lazy" src="{{ env('APP_URL') . $item->image }}" class="card-img-top w-100 h-100 mb-2" width="100" height="100" alt="">
                                    </a>
                                    <div class="card-body p-2 card-post">
                                        <div class="d-flex justify-content-between flex-column h-100">
                                            <a href="{{ route('frontend.redirect_to_page', $item->slug) }}" class="card-title fs-6 fw-bold text-truncate text-truncate-2 w-100">
                                                {{ $item->title }}
                                            </a>
                                            <div class="card-description">
                                                <span class="text-truncate text-truncate-3 fs-7">{!! $item->description !!}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        <a class="btn btn-primary shadow rounded-0 px-3" href="{{route('frontend.get.news')}}">
                            {{ trans('See more news') }}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@push('js')
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "NewsArticle",
      "headline": "{{ $data->title ?? '' }}",
      "image": [
        "{{ env('APP_URL') . $data->image ?? '' }}"
       ],
      "datePublished": "{{ formatDate($data->created_at ?? time() , 'Y-m-d\TH:i:sT:00') }}",
      "dateModified": "{{ formatDate($data->updated_at ?? time() , 'Y-m-d\TH:i:sT:00') }}",
      "author": [{
        "@type":"Organization",
        "name": "{{ cache('setting_website')[Website::WEBSITE_NAME]['value'] ?? env('APP_NAME') }}",
        "url": "{{ env('APP_URL') }}"
      }]
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "name": "Home",
        "item": "{{ route('frontend.home') }}"
      },{
        "@type": "ListItem",
        "position": 2,
        "name": "{{ $data->category->name }}",
        "item": "{{ route('frontend.redirect_to_page', $data->category->slug) }}"
      },{
        "@type": "ListItem",
        "position": 3,
        "name": "{{ $data->title }}"
      }]
    }
    </script>
@endpush