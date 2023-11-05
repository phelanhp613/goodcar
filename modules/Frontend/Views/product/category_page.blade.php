@php use Modules\Setting\Models\Website; @endphp@extends('Base::frontend.master')@php
    pageSEO(
		(!empty($data->meta_title) ? $data->meta_title : trans('Product Category')),
		(!empty($data->meta_description) ? $data->meta_description : trans('Product Category Page')),
		(!empty($data->meta_keyword) ? $data->meta_keyword : trans('Product Category Page')),
		(!empty($data->image) ? env('APP_URL') . $data->image : null),
		(!empty($data->canonical) ? $data->canonical : request()->url())
	);
@endphp
@section('content')
    <div class="container mb-5">
        @if(!empty($data->banner))
            <div class="page-banner text-center py-md-4 py-2">
                <img src="{{ $data->banner }}" class="w-100 h-auto" alt="" width="200" height="100">
            </div>
        @endif
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs-md-6 fs-8">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                @if(!empty($data->parent))
                    <li class="breadcrumb-item">
                        <a href="{{ route('frontend.redirect_to_page', $data->parent->slug) }}">{{ $data->parent->name }}</a>
                    </li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $data->name }}</li>
            </ol>
        </nav>
        <div class="page-title text-center py-md-4 py-2">
            <h2 class="fs-4 fs-md-3 fw-bold">{{ $data->name }}</h2>
        </div>
        <div class="page-content">
            <div class="category-list row row-cols-2 row-cols-md-3 row-cols-lg-5">
                @foreach($data->children as $item)
                    <div class="col mb-4">
                        <a href="{{ route('frontend.redirect_to_page', $item->slug) }}">
                            <div class="card">
                                <div class="ratio ratio-1x1">
                                    <img loading="lazy" data-src="{{ env('APP_URL') . $item->image }}" alt="" class="lazy card-img-top w-100 h-100" width="100" height="100">
                                </div>
                                <div class="card-footer bg-primary text-center">
                                    <h5 class="mb-0 text-white fs-8 fs-md-7 text-uppercase text-truncate text-truncate-1">{{ $item->name }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <hr class="mt-0">
            @include('Frontend::product._search_group')
            <div class="py-4">
                <hr class="mt-0">
            </div>
            <div class="container-post text-content">
                @if(!empty($data->content))
						<?php $content = json_decode($data->content ?? []); ?>
                    <x-base::post-content :content="$content"/>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "NewsArticle",
  "headline": "{{ $data->name ?? '' }}",
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
      },
      @if(!empty($data->parent))
            {
              "@type": "ListItem",
              "position": 2,
              "name": "{{ $data->parent->name ?? ''}}",
        "item": "{{ route('frontend.redirect_to_page', $data->parent->slug ?? '') }}"
      },


        @endif
        {
            "@type": "ListItem",
            "position":  {{ (!empty($data->parent)) ? 3 : 2 }},
        "name": "{{ $data->name ?? ''}}"
      }]
    }


    </script>
@endpush