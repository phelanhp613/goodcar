@php use Modules\Order\Models\Order; @endphp@extends("Base::backend.master")
@section("content")
    @php($status = $data->status ?? 0)
    <div id="role-module" class="container">
        <div class="row page-titles mb-4">
            <div class="col-5 align-self-center">
                <h5 class="title">{{ trans('Order') }}</h5>
            </div>
            <div class="col -7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb fs-7">
                        <li class="breadcrumb-item"><a href="/admin">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('get.order.list') }}">{{ trans('Order') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ trans('Detail') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between">
                        <h5>{{ $title ?? trans('Detail') }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" id="order-form">
                            @csrf
                            <div class="form-group">
                                <label for="code">{{ trans('Order code') }}</label>
                                <input type="text" class="form-control" name="code" id="code" value="{{ $data->code ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="name">{{ trans('Name') }}</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $data->name ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">{{ trans('Phone') }}</label>
                                <input type="tel" class="form-control" name="phone" id="phone" value="{{ $data->phone ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{ trans('Email') }}</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ $data->email ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="address">{{ trans('Delivery address') }}</label>
                                <textarea name="address" class="form-control" id="address" rows="3">{{ $data->address ?? '' }}</textarea>
                            </div>
                            <div class="form-outline mb-3">
                                <label class="form-label fw-semibold" for="status">{{ trans('Status') }}
                                    <span class="text-danger">*</span></label>
                                {!! Form::select('status', Order::getStatuses(), $data->status ?? 2,
                                    ['class' => 'select2 form-control w-100', 'id' => 'status']) !!}
                            </div>
                            <div class="form-outline mb-3">
                                <label class="form-label fw-semibold" for="payment-method">{{ trans('Payment Method') }}
                                    <span class="text-danger">*</span>
                                </label>
                                {!! Form::select('payment_method', ['bank_100' => trans('Bank transfer 100%'), 'bank_20' => trans('Bank transfer 20%')], $data->payment_method ?? 'bank_100',
                                    ['class' => 'select2 form-control w-100', 'id' => 'payment-method']) !!}
                            </div>
                            <div class="form-group">
                                <label for="note">{{ trans('Note') }}</label>
                                <textarea name="note" class="form-control" id="note" rows="4">{{ $data->note ?? '' }}</textarea>
                            </div>
                            <div class="button-group">
                                <button type="submit" class="btn btn-info text-white me-2">{{ trans('Save') }}</button>
                                <button type="reset" class="btn btn-outline-dark">{{ trans('Reset') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>
                                    @if ($status == 0)
                                        <span class="badge bg-danger text-white">{{ Order::getStatus($status) }}</span>
                                    @elseif($status == 2)
                                        <span class="badge bg-warning">{{ Order::getStatus($status) }}</span>
                                    @elseif($status == 5)
                                        <span class="badge bg-success">{{ Order::getStatus($status) }}</span>
                                    @else
                                        <span class="badge bg-info">{{ Order::getStatus($status) }}</span>
                                    @endif
                                </h4>
                                <div>
                                    <h3 class="fw-semibold">
                                        {{ trans('Final Price') }}:
                                        <span class="text-success me-2">{{ currency_format($data->total_price ?? 0) }}</span>
                                    </h3>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-block d-md-flex justify-content-end w-100">
                                    @if($status == 2)
                                        <a href="{{ route("get.order.accept", $data->id) }}" class="btn btn-success fw-semibold text-white me-2">{{ trans('Accept') }}</a>
                                        <a href="{{ route("get.order.abort", $data->id) }}" class="btn btn-danger fw-semibold text-white">{{ trans('Abort') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5>{{ trans("Order Detail") }}</h5>
                    </div>
                    <div class="card-body">
                        @foreach($data->details as $item)
                            @php($variant = $item->productVariant)
                            @if(!empty($variant))
                                <h2 class="">{{ $variant->name }}</h2>
                                <div class="w-md-50 ratio ratio-16x9">
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{!! getModal(['class' => 'modal-ajax', 'size' => 'modal-lg']) !!}
@push('js')
    {!! JsValidator::formRequest('Modules\Order\Requests\OrderRequest','#order-form') !!}
@endpush