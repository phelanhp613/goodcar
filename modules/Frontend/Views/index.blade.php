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
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">TRƯỚC</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">SAU</span>
    </button>
</div>
<div class="sellbest container py-4">
    <h2 class="mb-4 text-center"> SẢN PHẨM BÁN CHẠY</h2>
    <div class="row">
        @for($i=1; $i<=4; $i++)
        <div class="col-md-3 mb-3">
            <div class="card">
                <img src="{{ asset('images/frontend/icon-creta.png') }}" class="card-img-top w-100" alt="...">
                <div class="card-body">
                    <div class="card-title fw-bold">Hyundai Creta</div>
                    <div class="min-price">Chỉ từ: <span class="text-success">599.000.000</span></div>
                    <div class="sale-program mb-2">Khuyến mãi: ....</div>
                    <a href="#" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>
<div class="sellbest container py-4">
    <h2 class="mb-4 fs-4 border-bottom"> TOYOTA</h2>
    <div class="row">
        @for($i=1; $i<=4; $i++)
        <div class="col-md-3 mb-3">
            <div class="card">
                <img src="{{ asset('images/frontend/icon-creta.png') }}" class="card-img-top w-100" alt="...">
                <div class="card-body">
                    <div class="card-title fw-bold">Hyundai Creta</div>
                    <div class="min-price">Chỉ từ: <span class="text-success">599.000.000</span></div>
                    <div class="sale-program mb-2">Khuyến mãi: ....</div>
                    <a href="#" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>
<div class="sellbest container py-4">
    <h2 class="mb-4 fs-4 border-bottom"> MAZDA</h2>
    <div class="row">
        @for($i=1; $i<=4; $i++)
        <div class="col-md-3 mb-3">
            <div class="card">
                <img src="{{ asset('images/frontend/icon-creta.png') }}" class="card-img-top w-100" alt="...">
                <div class="card-body">
                    <div class="card-title fw-bold">Hyundai Creta</div>
                    <div class="min-price">Chỉ từ: <span class="text-success">599.000.000</span></div>
                    <div class="sale-program mb-2">Khuyến mãi: ....</div>
                    <a href="#" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>
<div class="news container mb-3">
    <h2 class="mb-4 text-center"> BÀI VIẾT</h2>
    <div class="row">
        @for($i=1; $i<=3; $i++)
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="{{ asset('images/frontend/icon-creta.png') }}" class="card-img-top w-100" alt="...">
                <div class="card-body">
                    <div class="card-title fw-bold">Hyundai Creta</div>
                    <div class="min-price">Chỉ từ: <span class="text-success">599.000.000</span></div>
                    <div class="sale-program mb-2">Khuyến mãi: ....</div>
                    <a href="#" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @endfor
    </div>
    <div class="text-center">
        <a href="#" class="btn btn-primary">Xem thêm</a>
    </div>
</div>
</div>
@endsection