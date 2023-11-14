@extends('Base::frontend.master')
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
                        @if(!empty($variant))
                            <h2 class="">{{ $variant->name }}</h2>
                            <div class="ratio ratio-16x9">
                                <img src="{{ getMainImage($variant->images) }}" class="w-100 h-100 object-fit-contain" alt="">
                            </div>
                            <div class="">
                                <h3>{{ trans('Price') }}</h3>
                                @php($saleOff = 100 - (int)(($variant->discount/($variant->price)) * 100))
                                @if($saleOff > 0)
                                    <div class="py-2 product-price fw-semibold mb-4">
                                        @if($variant->stock > 0)
                                            @if($variant->discount == 0)
                                                <span class="fs-md-3 fs-5 text-success">{{ currency_format($variant->price ?? 0) }}</span>
                                            @else
                                                <div class="d-inline-block">
                                                    <div class="price-discount">
                                                        <span class="price fs-md-3 fs-5 text-success">{{ currency_format($variant->discount ?? 0, ' VNĐ') }}</span>
                                                        <span class="discount text-decoration-line-through fs-md-6 fs-8 text-danger">{{ currency_format($variant->price ?? 0, ' VNĐ') }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <span class="fs-4 text-decoration-underline"><i>{{ trans('Sold out') }}</i></span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div class="table-responsive">
                                <h3>{{ trans('Attribute') }}</h3>
                                @php($productAttributes = [])
                                @if(!empty($variant->attributes))
                                    <table class="table table-bordered">
                                        @foreach($variant->attributes as $key => $attribute)
                                            @php($productAttributes[$attribute->id] = ['name' => $attribute->name, 'value' => $attribute->pivot->value])
                                            <tr>
                                                <td style="width: 200px">
                                                    <label class="fw-semibold">{{ $attribute->name }}</label>
                                                </td>
                                                <td>{{ $attribute->pivot->value }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                @endif
                            </div>
                            <div class="">
                                <h3>{{ trans('Specification') }}</h3>
                                @if(!empty($variant->attributes))
                                    <table class="table table-bordered">
                                        <tr>
                                            <td class="fw-semibold" style="width: 200px">{{ trans('Engine') }}</td>
                                            <td>{{ $variant->engine }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold" style="width: 200px">{{ trans('Power') }}</td>
                                            <td>{{ $variant->power }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold" style="width: 200px">{{ trans('Drive System') }}</td>
                                            <td>{{ $variant->drive_system }}</td>
                                        </tr>
                                    </table>
                                @endif
                            </div>
                            <input type="hidden" name="product_variant_id" value="{{ $variant->id }}">
                            <input type="hidden" name="product_id" value="{{ $variant->product->id }}">
                            <input type="hidden" name="product_attributes" value="{{ json_encode($productAttributes) }}">
                        @endif
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
{{--    <script src="{{ asset('assets/js/frontend_order.js') }}?v={{ env('APP_VERSION', '1') }}"></script>--}}
@endpush