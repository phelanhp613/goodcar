@extends('Base::frontend.master')

@section('content')
    <div class="product-detail-page">
        <div class="container mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb fs-md-6 fs-8">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('frontend.redirect_to_page', $data->slug) }}">{{ $data->name }}</a>
                    </li>
                </ol>
            </nav>
            <div class="page-content">
                <div class="product-detail">
                    <h1 class="post-name fs-md-3 fs-5">{{ $data->name }}</h1>
                    <div class="mb-5">
                        <div class="post-content text-content">
                            @if(!empty($data->content))
                                @php($content = json_decode($data->content ?? []))
                                <x-product::product-content :content="$content"/>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection