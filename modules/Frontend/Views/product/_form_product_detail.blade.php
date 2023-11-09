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
<form action="" class="product-form">
    <div class="product-info">
        <div class="d-flex flex-column-reverse flex-md-column product-attributes" data-url="{{ route('frontend.redirect_to_page', $data->slug) }}">
            <div class="variant row">
                @php($attribute_pivots_names = !empty($variant_selected->attributePivots) ? $variant_selected->attributePivots->pluck('value')->toArray() : [])
                @foreach($product_attributes ?? [] as $product_attribute)
                    <div class="col-3">
                        <div class="form-group mb-4 attribute-group">
                            <label class="text-primary fs-6 fs-md-5 fw-semibold mb-3 text-capitalize">
                                {{ str_replace($data->name . ' - ', '', $product_attribute->name) }}
                            </label>
                            <div class="row g-2 row-cols-auto fs-7 fs-md-6">
                                @foreach($product_attribute->selectedChildren as $key => $child)
                                    @if(in_array($child->name, $attribute_pivots_names))
                                        <div class="col">
                                            <div class="attribute-input-group">
                                                <label class="btn btn-primary fs-7 fs-md-6">
                                                    <span>{{ $child->name }}</span>
                                                    <input type="radio" name="attr[{{ $child->parent_id }}]" value="{{ $child->key }}" class="btn-attribute btn-check" checked/>
                                                </label>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col">
                                            <div class="attribute-input-group">
                                                <label class="btn btn-outline-primary fs-7 fs-md-6">
                                                    <span>{{ $child->name }}</span>
                                                    <input type="radio" name="attr[{{ $child->parent_id }}]" value="{{ $child->key }}" class="btn-attribute btn-check"/>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <hr>
                    </div>
                @endforeach
            </div>
            @php($saleOff = 100 - (int)(($variant_selected->discount/($variant_selected->price)) * 100))
            @if($saleOff >= 50 && $saleOff < 100)
                <div class="fw-semibold mb-4">
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
                    </div>
                </div>
            @else
                <div class="py-2 product-price fw-semibold mb-4">
                    @if($variant_selected->stock > 0)
                        @if($variant_selected->discount == 0)
                            <span class="fs-md-3 fs-5 text-success">{{ currency_format($variant_selected->price ?? 0) }}</span>
                        @else
                            <div class="d-inline-block">
                                <div class="price-discount">
                                    <div class="discount text-decoration-line-through fs-md-6 fs-8 text-danger">{{ currency_format($variant_selected->price ?? 0) }}</div>
                                    <div class="price fs-md-3 fs-5 text-success">{{ currency_format($variant_selected->discount ?? 0) }}</div>
                                </div>
                            </div>
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
</form>