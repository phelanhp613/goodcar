@php
    $price = 0;
    $rootVariant = $product->rootVariant();
    if (!empty($rootVariant)) {
        $saleOff = 0;
        $discount = $rootVariant->discount;
        $price = $rootVariant->price;
        if ($discount > 0 && $price > 0) {
            $saleOff = 100 - (int)(($discount/$price) * 100);
        }
        $variants = $product->variants->toArray();
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

		$image = getMainImage($product->has_variant ? $rootVariant->images : $product->images);
    }
@endphp
@if (!empty($rootVariant))
    <a href="{{ route('frontend.redirect_to_page', $product->slug) }}" class="h-100 d-block" title="{{ $product->name }}">
        <div class="card position-relative border-0 h-100">
            <div class="saleoff-flashsale fw-semibold fs-md-6 fs-7">-{{ $saleOff }}%</div>
            <div class="card-image ratio ratio-1x1 border-bottom">
                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" @if($isSlider) data-lazy="{{ $image }}" @else data-src="{{ $image }}" @endif alt="{{ $product->name }}" class="w-100 h-auto object-fit-cover lazy" width="1" height="1">
            </div>
            <div class="card-body d-flex flex-column p-md-2 p-1">
                <div class="card-title">
                    <span class="text-truncate text-truncate-2 fs-md-6 fs-7 fw-bold">{{ $product->has_variant ? $rootVariant->name : $product->name }}</span>
                </div>
                <div class="card-description rounded-2 text-white p-2 mt-auto">
                    <div class="card-price mb-2 mb-md-0">
                        <span class="fw-semibold fs-lg-6 fs-md-7 fs-8 border-white border-bottom me-1">{{ $priceRange }}</span>
                        <span class="d-block text-decoration-line-through fs-md-7 fs-8">{{ currency_format($maxPrice) }}</span>
                    </div>
                    <div class="card-remaining fs-md-6 fs-8">
                        <span>{{ trans('Remaining') }}: </span>
                        <span class="fw-semibold">{{ $product->flash_sale_quantity ?? 0 }} </span>
                        <span>{{ trans('product') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </a>
@endif