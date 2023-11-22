@extends('Base::frontend.master')

@section('content')
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/frontend/slide1.png') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item active">
                <img src="{{ asset('images/frontend/slider2.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item active">
                <img src="{{ asset('images/frontend/slider3.png') }}" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">TRƯỚC</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">SAU</span>
        </button>
    </div>
    <div class="sellbest container py-4">
        <h2 class="mb-4 text-center"> SẢN PHẨM NỔI BẬC</h2>
        <div class="row">
            @foreach ($productFeatured as $item)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="ratio ratio-16x9">
                                <img src="{{ getMainImage($item->images) }}" class="card-img-top object-fit-contain w-100" alt="...">
                            </div>
                            <div class="card-body">
                                <div class="card-title fw-bold">{{ $item->name }}</div>
                                <div class="min-price">Chỉ từ:
                                    <span class="text-success">{{ currency_format(($variant_selected->price ?? 0) - ($variant_selected->discount ?? 0)) }}</span>
                                </div>
                                <a href="{{ route('frontend.redirect_to_page', $item->slug) }}" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
    <div class="news container mb-3">
        <h2 class="mb-4 text-center"> BÀI VIẾT</h2>
        <div class="row mb-5">
            @foreach ($posts as $item)
                <div class="col-md-4 mb-3">
                    <a class="text-decoration-none" href="{{ route('frontend.redirect_to_page', $item->slug) }}">                    
                        <div class="card h-100">
                            <div class="ratio ratio-16x9">
                                <img src="{{ $item->images }}" class="card-img-top object-fit-cover w-100" alt="...">
                            </div>
                            <div class="card-body">
                                <div class="card-title fw-bold">{{ $item->name }}</div>
                                <div class="">{{ $item->description }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="text-center">
            <a href="#" class="btn btn-primary">Xem thêm</a>
        </div>
    </div>
@endsection