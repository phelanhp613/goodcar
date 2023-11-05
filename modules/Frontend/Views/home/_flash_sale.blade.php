@php($remainingDate = $flashSaleConfig['remaining_date'])
@if($remainingDate->total_s > 0 && $flashSaleProducts->count() > 0)
    <div class="container py-5">
        <div class="title-section mb-3">
            <h2><span class="px-2 fw-bold text-uppercase">{{ trans('Giá tốt hàng ngày') }}</span></h2>
        </div>
        <div class="py-3 px-4 flash-sale shadow-lg bg-primary" id="flash-sale">
            <div class="title row mb-2">
                <div class="col-md-6 mb-3">
                    <div class="d-flex">
                        <img src="{{ asset('images/lightning.svg') }}" alt="lightning" width="40" height="40">
                        <h1 class="fs-lg-4 fs-5 text-uppercase fw-bold text-white mb-0 p-1">
                            Flash Sale </h1>
                    </div>
                </div>
                <div class="col-md-6 flash-sale-timing">
                    <x-base::count-down-timer :date="$remainingDate"/>
                    <div class="text-end d-none d-md-block">
                        <a href="{{ route('frontend.product.flashsale') }}" class="text-decoration-underline text-white fs-7 fs-md-6">{{ trans('See all products') }}</a>
                    </div>
                </div>
            </div>
            <div class="home-owl-carousel">
                <div class="flash-sale-list flash-sale-owl-carousel invisible" id="flash-sale-list">
                    @foreach($flashSaleProducts as $product)
                        <div class="p-1">
                            <x-product::product-card-flash-sale :product="$product" :isSlider="true"/>
                        </div>
                    @endforeach
                </div>
                <div class="arrows-container-flash-sale-list d-flex justify-content-center"></div>
            </div>
            <div class="text-end d-block d-md-none">
                <a href="{{ route('frontend.product.flashsale') }}" class="text-decoration-underline text-white fs-7 fs-md-6">{{ trans('See all products') }}</a>
            </div>
        </div>
    </div>
@endif