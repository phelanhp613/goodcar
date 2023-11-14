@if(!empty($variant->product))
    @php
        $product = $variant->product;
        $price = 0;
        if (!empty($variant)) {
            $saleOff = 0;
            $discount = $variant->discount ?? $variant['discount'];
            $price = $variant->price ?? $variant['price'];
            if ($discount > 0 && $price > 0) {
                $saleOff = 100 - (int)(($discount/$price) * 100);
				$price = $discount;
            }
        }
    @endphp
    <a class="text-decoration-none d-block h-100" href="{{ route('frontend.redirect_to_page', ($variant->product->has_variant)  ? $variant->slug : $variant->product->slug) }}" title="{{ ($product->has_variant)  ? $variant->name : $product->name }}">
        <div class="card card-product position-relative h-100">
            <div class="ratio ratio-1x1">
                <img loading="lazy" data-src="{{ env('APP_URL') . getMainImage((($product->has_variant)  ? $variant->images : $product->images) ?? '[]') }}" class="lazy object-fit-contain card-img-top w-100 h-100 mb-2" width="100" height="100" alt="...">
            </div>
            <div class="card-body p-md-2 p-1">
                <div class="card-title mb-0">
                    <span class="text-truncate text-truncate-2 fw-bold">{{ ($product->has_variant)  ? $variant->name : $product->name }}</span>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 p-md-2 p-1">
                <div class="card-price mb-3">
                    <span class="fw-semibold text-success">
                        {{ currency_format($price, ' VNĐ') }}
                    </span>
                </div>
                <button class="btn btn-primary py-1 w-100 w-md-auto text-uppercase fs-8 fw-semibold">{{ trans('Order now') }}</button>
            </div>
        </div>
    </a>
@endif
