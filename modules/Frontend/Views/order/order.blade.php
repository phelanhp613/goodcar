@extends('Base::frontend.master')@php
    session('meta_title', 'Basic Frontend');
    session('meta_description', 'Basic Description Frontend')
@endphp
@push('css')
    <style>
		.quantity-input.is-valid {
			border: 1px solid #ced4da;
			padding-right: inherit;
			background-image: inherit;
		}
		.product-item .coating {
			background: rgba(0, 0, 0, .6);
			z-index: 100;
		}
    </style>
@endpush
@section('content')
    <section id="order-section" class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs-md-6 fs-8">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ trans('Order Page') }}</li>
            </ol>
        </nav>
        <div class="py-5">
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    - {!! session()->get('error') !!}
                </div>
            @endif
            <form action="" method="post" id="order-form">
                @csrf
                <div class="row">
                    <div class="col-md-7">
                        @foreach($products as $product)
                            <div class="product-item position-relative">
                                <div class="p-2">
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="ratio ratio-1x1" style="width: 100px;">
                                                <img src="{{ $product['product_image'] ?? ''  }}" class="img-fluid rounded-3 w-100 h-100" width="100" height="100" alt="Book">
                                            </div>
                                            <div class="flex-column ms-4">
                                                <a href="{{ route('frontend.redirect_to_page', $product['product_slug'] ?? '' ) }}" class="fw-semibold lh-1 fs-5">
                                                    {{ $product['product_name'] }}
                                                </a>
                                                <div class="attribute mb-2">
                                                    @php($attributeData = [])
                                                    @foreach(($product['product_attributes'] ?? []) as $attribute => $value)
                                                        <div class="fs-7">{{ $attribute }}: {{ $value }}</div>
                                                        @php($attributeData[] = $attribute . ': ' . $value)
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <div class="col-4 d-flex align-items-center justify-content-end">
                                                <div class="input-group d-block">
                                                    <div class="d-flex flex-row justify-content-center py-3 w-100">
                                                        <button type="button" class="btn btn-quantity-input px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                            -
                                                        </button>
                                                        <input min="1" max="{{ (int)($stockVariants[$product['product_variant_id']] ?? 0) }}" data-price="{{ $product['final_price'] }}" name="products[{{ $product['product_variant_id'] }}][quantity]" value="{{ $product['quantity'] ?? 0 }}" type="number" class="form-control quantity-input w-100" aria-label="quantity"/>
                                                        <button type="button" class="btn btn-quantity-input px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                            +
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 d-md-flex align-items-center justify-content-center">
                                                <div>
                                                    @if($product['discount'] != 0)
                                                        <span class="d-block fw-semibold text-decoration-underline fs-5">{{ currency_format($product['discount'] ?? 0) }}</span>
                                                        <span class="d-block text-decoration-line-through fs-7">{{ currency_format($product['price'] ?? 0) }}</span>
                                                    @else
                                                        <span class="d-block fw-semibold text-decoration-underline fs-5">{{ currency_format($product['price'] ?? 0) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if((int)($stockVariants[$product['product_variant_id']] ?? 0) > 0)
                                    <input type="hidden" name="products[{{ $product['product_variant_id'] }}][product_id]" value="{{ $product['product_id'] }}">
                                    <input type="hidden" name="products[{{ $product['product_variant_id'] }}][product_name]" value="{{ $product['product_name'] }}">
                                    <input type="hidden" name="products[{{ $product['product_variant_id'] }}][product_variant_id]" value="{{ $product['product_variant_id'] }}">
                                    <input type="hidden" name="products[{{ $product['product_variant_id'] }}][product_attributes]" value="{{ json_encode($attributeData) }}">
                                    <input type="hidden" name="products[{{ $product['product_variant_id'] }}][sku]" value="{{ $product['product_variant_sku'] }}">
                                    <input type="hidden" name="products[{{ $product['product_variant_id'] }}][price]" value="{{ $product['price'] }}">
                                    <input type="hidden" name="products[{{ $product['product_variant_id'] }}][discount]" value="{{ $product['discount'] }}">
                                    <input type="hidden" name="products[{{ $product['product_variant_id'] }}][total_price]" value="{{ $product['total_price'] }}">
                                    <input type="hidden" name="products[{{ $product['product_variant_id'] }}][final_price]" value="{{ $product['final_price'] }}">
                                    <input type="hidden" name="products[{{ $product['product_variant_id'] }}][quantity_base]" value="{{ $product['quantity_base'] }}">
                                @else
                                    <div class="coating position-absolute top-0 left-0 w-100 h-100 d-flex align-items-center justify-content-center text-white">
                                        <div class="text-center">
                                            <div>
                                                <i class="text-decoration-underline fs-3">{{ trans('Sold out') }} </i>
                                            </div>
                                            <a href="{{ route('frontend.cart.remove_product', $product['product_variant_id'] ?? '' ) }}"  aria-label="Remove Product" class="text-warning fs-7" title="Remove item">
                                                {{ trans('Remove Product') }}
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <hr>
                        @endforeach
                    </div>
                    <div class="col-md-5">
                        @include('Frontend::order._info_customer_form')
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@push('js')
    <script src="{{ asset('assets/vendor/jsvalidation/jsvalidation.min.js') }}"></script>
    {!! JsValidator::formRequest('Modules\Order\Requests\OrderRequest','#order-form') !!}
    <script src="{{ asset('assets/js/frontend_order.js') }}?v={{ env('APP_VERSION', '1') }}"></script>
@endpush