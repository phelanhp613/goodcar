@extends('Base::frontend.master')@php
    pageSEO(
		(!empty($data->meta_title) ? $data->meta_title : trans('Page')),
		(!empty($data->meta_description) ? $data->meta_description : trans('Page')),
		(!empty($data->meta_keyword) ? $data->meta_keyword : trans('Page')),
		(!empty($data->canonical) ? $data->canonical : request()->url())
	);
@endphp
@section('content')
    <div class="container mb-5 container-post">
        @if(!empty($data->banner))
            <div>
                <img src="{{ $data->banner }}" class="w-100 h-100" width="200" height="100" alt="">
            </div>
        @endif
        <div class="@if(!(int)($data->show_breadcrumb ?? 0)) d-none @endif">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb fs-md-6 fs-8">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $data->title }}</li>
                </ol>
            </nav>
        </div>
        <div class="page-content">
            <h1 class="fs-2 mb-3 @if(!(int)($data->show_title ?? 0)) d-none @endif">{{ $data->title }}</h1>
            <div class="mb-3">{!! $data->description !!}</div>
			<?php $content = json_decode($data->content ?? []); ?>
            <x-base::page-content :content="$content"/>
        </div>
    </div>
@endsection
@push('js')
    @if(in_array('view', request()->segments()))
        <script>
			$(document).ready(function () {
				$('a').attr('href', 'javascript:');
			});
        </script>
    @endif
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
        "name": "{{ cache('setting_website')[\Modules\Setting\Models\Website::WEBSITE_NAME]['value'] ?? env('APP_NAME') }}",
        "url": "{{ env('APP_URL') }}"
      }]
    }

    </script>
@endpush
