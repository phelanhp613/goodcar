<a href="{{ route('frontend.redirect_to_page', $product->slug ?? $product['slug']) }}" title="{{ $product->name  ?? $product['name'] }}">
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
            if((int)$maxDiscount !== 0) {
                $priceRange = currency_format($minDiscount);
                if($maxDiscount > $minDiscount) {
					$startPrice = ($minPrice < $minDiscount) ? $minPrice : $minDiscount;
                    $priceRange = currency_format($startPrice) . ' - ' . currency_format($maxDiscount);
                }
            } else {
                $priceRange = currency_format($minPrice) . ($minPrice == $maxPrice ? null : ' - ' . currency_format($maxPrice));
            }
        }
    @endphp
    <div class="card card-product position-relative">
        @if(!empty($saleOff))
            <span class="saleoff home-page position-absolute fs-8 fs-md-7 text-center align-middle">-{{ $saleOff }}%</span>
        @endif
        <div class="ratio ratio-1x1">
            <img loading="lazy" data-src="{{ env('APP_URL') . getMainImage($product->images ?? $product['images']) }}" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" class="lazy card-img-top w-100 h-100 mb-2" width="1" height="1" alt="...">
        </div>
        <div class="card-body p-md-2 p-1">
            <div class="card-title">
                <span class="text-truncate text-truncate-2 fs-md-6 fs-7 fw-bold">{{ $product->name  ?? $product['name'] }}</span>
            </div>
            <hr class="m-1">
            <div class="card-price">
                <span class="fw-semibold text-primary border-bottom border-primary fs-lg-6 fs-md-7 fs-8">
                    {{ $priceRange }}
                </span>
                @if((int)$maxDiscount !== 0)
                    <span class="d-block text-decoration-line-through fs-md-7 fs-8">{{ currency_format($maxPrice) }}</span>
                @endif
            </div>
        </div>
        <div class="card-footer bg-white border-top-0 p-md-2 p-1">
            <a href="{{ route('frontend.redirect_to_page', $product->slug ?? $product['slug']) }}" class="btn btn-primary py-1 w-100 w-md-auto text-uppercase fs-8 fw-semibold">Đặt hàng ngay</a>
        </div>
    </div>
</a>
