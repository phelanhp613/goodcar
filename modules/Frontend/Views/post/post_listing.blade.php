@extends('Base::frontend.master')@php
	pageSEO(
		(!empty($data->meta_title) ? $data->meta_title : trans('News')),
		(!empty($data->meta_description) ? $data->meta_description : trans('News Page')),
		(!empty($data->meta_keyword) ? $data->meta_keyword : trans('News Page')),
		(!empty($data->image) ? $data->image : null),
		(!empty($data->canonical) ? $data->canonical : request()->url())
	);
@endphp
@section('content')
    <div class="container mb-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs-md-6 fs-8">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                @if(!empty($data))
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('frontend.get.news') }}">{{ trans('News') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $data->name }}</li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('News') }}</li>
                @endif
            </ol>
        </nav>
        <div class="page-title text-center mb-5">
            @if(!empty($data))
                <h1 class="h2"><span class="border-3 border-primary border-bottom py-2">{{ $data->name }}</span></h1>
            @else
                <h1 class="h2"><span class="border-3 border-primary border-bottom py-2">{{ trans('News') }}</span></h1>
            @endif
        </div>
        <div class="page-content">
            @if(!empty($main_posts))
                <div class="main-post row mb-3">
                    @php($first_post = $main_posts->first())
                    <div class="col-md-6">
                        <div class="post-image mb-3">
                            <a href="{{ route('frontend.redirect_to_page', $first_post->slug) }}">
                                <div class="ratio ratio-16x9 post-image">
                                    <img class="w-100 h-100" src="{{ $first_post->image ?? '' }}" alt="{{ $first_post->title ?? '' }}" width="100" height="100">
                                </div>
                            </a>
                        </div>
                        <div class="mb-3">
                            <a href="{{ route('frontend.redirect_to_page', $first_post->slug) }}" class="fs-5 text-truncate text-truncate-1 fw-semibold">
                                {{$first_post->title ?? ''}}
                            </a>
                            <div class="text-truncate text-truncate-2">{!! $first_post->description ?? '' !!}</div>
                        </div>
                    </div>
                    <hr class="d-block d-md-none">
                    <div class="col-md-6">
                        @foreach($main_posts as $key => $item)
                            @if($key != 0)
                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <a href="{{ route('frontend.redirect_to_page', $item->slug) }}">
                                            <div class="ratio ratio-16x9 post-image">
                                                <img class="w-100 h-100" src="{{ $item->image ?? '' }}" alt="{{ $item->title ?? '' }}" width="100" height="100">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-8">
                                        <a href="{{ route('frontend.redirect_to_page', $item->slug) }}" class="fs-5 text-truncate text-truncate-1 fw-semibold">
                                            {{$item->title ?? ''}}
                                        </a>
                                        <div class="text-truncate text-truncate-2">{!! $item->description ?? '' !!}</div>
                                    </div>
                                </div>
                                <hr>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
            @if($post_list->count() > 0)
                <div class="post-list">
                    <div class="title-section title-left mb-3">
                        <h2><span class="pe-2 fw-bold text-uppercase">{{ trans('New news') }}</span></h2>
                    </div>
                    @foreach($post_list as $item)
                        <div class="row">
                            <div class="col-md-3">
                                <a href="{{ route('frontend.redirect_to_page', $item->slug) }}">
                                    <div class="ratio ratio-16x9 post-image">
                                        <img class="w-100 h-100" src="{{$item->image ?? '' }}" alt="{{ $item->title ?? '' }}" width="100" height="100">
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-9">
                                <a href="{{ route('frontend.redirect_to_page', $item->slug) }}" class="fs-5 text-truncate text-truncate-2 fw-semibold">
                                    {{ $item->title ?? '' }}
                                </a>
                                <div class="text-truncate text-truncate-3">{!! $item->description ?? '' !!}</div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
                {{ $post_list->withQueryString()->render('vendor/pagination/default') }}
            @endif
        </div>
    </div>
@endsection
