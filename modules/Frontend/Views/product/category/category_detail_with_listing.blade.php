@extends('Base::frontend.master')
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
            <h2 class="h4">{{ trans('Filter') }}</h2>
            @include('Frontend::product.category._search_group')
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