@php
    use App\Commons\CacheData\CacheDataService;
	use Carbon\Carbon;
	use Modules\Product\Models\FlashSaleConfig;

	$flashSaleConfigCache                       = (new CacheDataService())->get('flash_sale_config') ?? [];
    $expireDate                                 = $flashSaleConfigCache[FlashSaleConfig::FLASH_SALE_EXPIRE_DATE] ?? [];
    $expireDate                                 = strtotime($expireDate) ? $expireDate : Carbon::now()
                                                                                               ->format('d-m-Y');
    $expireDate                                 = Carbon::createFromFormat('d-m-Y', $expireDate)
                                                        ->endOfDay();
    $flashSaleConfig['remaining_date']          = Carbon::now()->diff($expireDate);
    $flashSaleConfig['remaining_date']->total_s = Carbon::now()->diffInSeconds($expireDate);
	$flashSaleConfig['remaining_date']->date    = $expireDate->format('Y-m-d H:i:s');
	$remainingDate = $flashSaleConfig['remaining_date']
@endphp
@push('css')
    <style>
		.count-down-timer {
			display: block !important;
		}

		.timing-box-date {
			margin-bottom: 8px !important;
			font-size: 14px !important;
		}

		.timing-clock {
			justify-content: center !important;
		}

		@media (min-width: 768px) and (max-width: 935px) {
			.product-price-flash-sale {
				display: block !important;
			}
		}
    </style>
@endpush
<form action="{{ route('frontend.cart.add_product', $data->slug) }}" method="get" id="product-form" class="product-form">
    <div class="product-info">
        <div class="rating align-items-center fs-md-7 fs-8">
            <div class="d-flex align-items-center">
                @php($rateAvg = $data->ratings->avg('rate'))
                <div class="rate text-primary fw-semibold me-1">{{ number_format((float)$rateAvg ?? 5, 2, '.', '') }}</div>
                <div class="stars me-1 text-warning mb-2">
                    @for($i=1; $i<=5; $i++)
                        <span class="@if($i <= (int)$rateAvg) text-warning @else text-secondary @endif star fs-3">★</span>
                    @endfor
                </div>
            </div>
            <div class="d-flex align-items-center">
                <div class="me-1">({{ count($data->ratings) }} {{ trans('Evaluate') }})</div>
                <div> - {{ $variant_selected->quantity_sold ?? 0 }}  {{ trans('Sold') }}</div>
            </div>
        </div>
        <hr>
        <div class="row flex-column-reverse flex-md-column product-attributes" data-url="{{ route('frontend.redirect_to_page', $data->slug) }}">
            <div class="col-12 variant w-100">
                @php($attribute_pivots_names = !empty($variant_selected->attributePivots) ? $variant_selected->attributePivots->pluck('value')->toArray() : [])
                @foreach($product_attributes ?? [] as $product_attribute)
                    <div class="form-group mb-4 attribute-group">
                        <label class="text-primary fs-6 fs-md-5 fw-semibold mb-3 text-capitalize">
                            {{ str_replace($data->name . ' - ', '', $product_attribute->name) }}
                        </label>
                        <div class="row g-2 row-cols-auto fs-7 fs-md-6">
                            @foreach($product_attribute->children as $key => $child)
                                @if(in_array($child->name, $attribute_pivots_names))
                                    <div class="col">
                                        <div class="attribute-input-group">
                                            <label class="btn btn-primary fs-7 fs-md-6">
                                                <span>{{ $child->name }}</span>
                                                <input type="radio" name="attr[{{ $child->parent_id }}]" value="{{ $child->id }}" class="btn-attribute btn-check" checked/>
                                            </label>
                                        </div>
                                    </div>
                                @else
                                    <div class="col">
                                        <div class="attribute-input-group">
                                            <label class="btn btn-outline-primary fs-7 fs-md-6">
                                                <span>{{ $child->name }}</span>
                                                <input type="radio" name="attr[{{ $child->parent_id }}]" value="{{ $child->id }}" class="btn-attribute btn-check"/>
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
            @php($saleOff = 100 - (int)(($variant_selected->discount/$variant_selected->price) * 100))
            @if($saleOff >= 50 && $saleOff < 100)
                <div class="col-12 fw-semibold mb-4">
                    <div class="product-price product-price-flash-sale d-flex justify-content-between p-2 bg-highlight-flash-sale text-white rounded-3">
                        <div>
                            @if($variant_selected->stock > 0)
                                <div class="d-inline-block">
                                    <div class="price-discount">
                                        <div class="price fs-md-3 fs-5">{{ currency_format($variant_selected->discount ?? 0) }}</div>
                                        <div class="discount text-decoration-line-through fs-md-6 fs-8">{{ currency_format($variant_selected->price ?? 0) }}</div>
                                    </div>
                                </div>
                            @else
                                <span class="fs-4 text-decoration-underline"><i>{{ trans('Sold out') }}</i></span>
                            @endif
                        </div>
                        <div class="flash-sale-timing">
                            <x-base::count-down-timer :date="$remainingDate"/>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12 py-2 product-price fw-semibold mb-4 w-100">
                    @if($variant_selected->stock > 0)
                        @if($variant_selected->discount == 0)
                            <span class="fs-md-3 fs-5">{{ currency_format($variant_selected->price ?? 0) }}</span>
                        @else
                            <div class="d-inline-block">
                                <div class="price-discount">
                                    <span class="discount text-decoration-line-through fs-md-6 fs-8">{{ currency_format($variant_selected->price ?? 0) }}</span>
                                    <span class="price fs-md-3 fs-5">{{ currency_format($variant_selected->discount ?? 0) }}</span>
                                </div>
                            </div>
                            <span class="saleoff fs-8 fs-md-7 text-center align-middle">-{{ $saleOff }}%</span>
                        @endif
                    @else
                        <span class="fs-4 text-decoration-underline"><i>{{ trans('Sold out') }}</i></span>
                    @endif
                </div>
            @endif
        </div>
        @if(!empty($data->promotion))
            <div class="promotion border fs-7 fs-md-6 p-3 mb-4 rounded-2 shadow">
                <h2 class="fs-5 text-danger">{{ trans('Promotion') }}:</h2>
                {!! $data->promotion !!}
            </div>
        @endif
        @if(!empty($data->description))
            <div class="description border p-3 rounded-2 shadow-sm fs-7 invisible">
                <h2 class="fs-5 text-primary">{{ trans('Description') }}:</h2>
                {!! $data->description !!}
            </div>
        @endif
    </div>
    <div class="row g-2 mt-3 mt-md-5">
        @if(!empty($variant_selected)  && (int)$variant_selected->stock > 0)
            <div class="col-12 mb-3">
                <div class="input-group w-auto">
                    <input type="button" value="-" class="button-minus btn-quantity-input border icon-shape mx-1" data-field="quantity">
                    <input type="number" name="quantity" min="1" value="1" max="{{ $variant_selected->stock }}" data-price="0" class="quantity-field quantity-input border-0 text-center w-25" aria-label="Quantity">
                    <input type="button" value="+" class="button-plus btn-quantity-input border icon-shape mx-1" data-field="quantity">
                </div>
            </div>
        @endif
        <div class="col-6">
            <button @if(empty($variant_selected) || (int)$variant_selected->stock == 0) disabled @endif type="button" class="btn btn-primary shadow-sm rounded-0 w-100 btn-order-now" data-bs-toggle="modal" data-bs-target="#product-order-modal">
                <span class="text-truncate text-truncate-1">{{ trans('Order Now') }}</span>
            </button>
        </div>
        <div class="col-6">
            <button @if(empty($variant_selected) || (int)$variant_selected->stock == 0) disabled @endif class="btn btn-outline-primary btn-submit shadow-sm rounded-0 w-100" type="submit">
                <span class="text-truncate text-truncate-1">{{ trans('Add to cart') }}</span>
            </button>
        </div>
    </div>
</form>