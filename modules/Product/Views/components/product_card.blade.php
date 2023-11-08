@php
    $price = 0;
    $images = json_decode($product->images ?? $product['images']);
    $rootVariant = is_array($product['variants']) ? $product['variants'][0] : $product->rootVariant();
    if (!empty($rootVariant)) {
        $saleOff = 0;
        $discount = $rootVariant->discount ?? $rootVariant['discount'];
        $price = $rootVariant->price ?? $rootVariant['price'];
        if ($discount > 0 && $price > 0) {
            $saleOff = 100 - (int)(($discount/$price) * 100);
        }
        $variants = is_array($product['variants']) ? $product['variants'] : $product->variants->toArray();
        $prices = array_column($variants, 'price');
        $minPrice = min($prices);
        $maxPrice = max($prices);
        $discounts = $prices = array_column($variants, 'discount');
        $minDiscount = min($discounts);
        $maxDiscount = max($discounts);

        if((int)$minDiscount === 0) {
            $minDiscount = $maxDiscount;
            $maxDiscount = 0;
        }
        $priceRange = currency_format($minPrice);
        if((int)$minDiscount > 0){
            $priceRange = currency_format($minDiscount);
            $startPrice = ($maxDiscount > $minDiscount) ? (($minPrice < $minDiscount) ? $minPrice : $minDiscount) : $minDiscount;
            $priceRange = currency_format($startPrice) . ' - ' . currency_format(($maxDiscount > $maxPrice) ? $maxDiscount: $maxPrice);
        } else{
            $priceRange = currency_format($minPrice) . ($minPrice == $maxPrice ? null : ' - ' . currency_format($maxPrice));
        }
    }
@endphp
@if (!empty($rootVariant))
<a href="{{ route('frontend.redirect_to_page', $product->slug ?? $product['slug']) }}" title="{{ $product->name  ?? $product['name'] }}">
    <div class="card card-product position-relative">
        @if(!empty($saleOff))
            <span class="saleoff home-page position-absolute fs-8 fs-md-7 text-center align-middle">-{{ $saleOff }}%</span>
        @endif
        <div class="ratio ratio-16x9">
            <img loading="lazy" src="{{ env('APP_URL') . getMainImage($product->images ?? $product['images']) }}" class="lazy object-fit-contain card-img-top w-100 h-100 mb-2" width="1" height="1" alt="...">
        </div>
        <div class="card-body p-md-2 p-1">
            <div class="card-title">
                <span class="text-truncate text-truncate-2 fs-md-6 fs-7 fw-bold">{{ $product->name  ?? $product['name'] }}</span>
            </div>
            <hr class="m-1">
            <div class="card-price">
                <span class="fw-semibold text-primary border-primary fs-lg-6 fs-md-7 fs-8">
                    {{ $priceRange ?? 0 }}
                </span>
            </div>
        </div>
        <div class="card-footer bg-white border-top-0 p-md-2 p-1">
            <a href="{{ route('frontend.redirect_to_page', $product->slug ?? $product['slug']) }}" class="btn btn-primary py-1 w-100 w-md-auto text-uppercase fs-8 fw-semibold">Đặt hàng ngay</a>
        </div>
    </div>
</a>
@endif