@if(!empty($variant->product))
    @php
        $price = 0;
        if (!empty($variant)) {
            $saleOff = 0;
            $discount = $variant->discount ?? $variant['discount'];
            $price = $variant->price ?? $variant['price'];
            if ($discount > 0 && $price > 0) {
                $saleOff = 100 - (int)(($discount/$price) * 100);
            }
            $product = $variant->product;
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
    <a href="{{ route('frontend.redirect_to_page', ($variant->product->has_variant)  ? $variant->slug : $variant->product->slug) }}" title="{{ ($product->has_variant)  ? $variant->name : $product->name }}">
        <div class="card card-product position-relative">
            @if(!empty($saleOff))
                <span class="saleoff home-page position-absolute fs-8 fs-md-7 text-center align-middle">-{{ $saleOff }}%</span>
            @endif
            <div class="ratio ratio-1x1">
                <img loading="lazy" data-src="{{ env('APP_URL') . getMainImage((($product->has_variant)  ? $variant->images : $product->images) ?? '[]') }}" class="lazy card-img-top w-100 h-100 mb-2" width="100" height="100" alt="...">
            </div>
            <div class="card-body p-md-2 p-1">
                <div class="card-title">
                    <span class="text-truncate text-truncate-2 fs-md-6 fs-7 fw-bold">{{ ($product->has_variant)  ? $variant->name : $product->name }}</span>
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
                <button class="btn btn-primary py-1 w-100 w-md-auto text-uppercase fs-8 fw-semibold">{{ trans('Order now') }}</button>
            </div>
        </div>
    </a>
@endif
