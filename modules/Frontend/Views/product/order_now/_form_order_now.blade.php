<div class="modal fade product-order-modal" id="product-order-modal" tabindex="-1" aria-labelledby="product-order-modal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="fs-5">{{ trans('Order Now') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-info-order-now">
                            <form action="javascript:" method="get" class="product-form-order-now">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="ratio ratio-1x1 mb-3">
                                            <img class="object-fit-cover w-100 h-100 lazy"
                                                 data-src="{{ getMainImage(!$data->has_variant ? $data->images : ($variant_selected->images ?? $data->rootVariant()->images)) }}"
                                                 alt="{{ getMainImage($variant_selected->images ?? $data->rootVariant()->images) }}"
                                                 width="100" height="100" lazy="loading">
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <span class="fw-semibold">{{ $data->name }}</span>
                                    </div>
                                </div>
                                <div class="product-attributes-order-now" data-url="{{ route('frontend.redirect_to_page', $data->slug) }}">
                                    <hr>
                                    <div class="product-price fw-semibold py-1 w-100">
                                        @if(!empty($variant_selected) && $variant_selected->stock > 0)
                                            @if($variant_selected->discount == 0 || $variant_selected->price == 0)
                                                <span class="fs-md-3 fs-5">{{ currency_format($variant_selected->price ?? $variant_selected->price ?? 0) }}</span>
                                            @else
                                                <div class="d-inline-block">
                                                    <div class="price-discount">
                                                        <span class="discount text-decoration-line-through fs-md-6 fs-8">{{ currency_format($variant_selected->price ?? 0) }}</span>
                                                        <span class="price fs-md-3 fs-5">{{ currency_format($variant_selected->discount ?? 0) }}</span>
                                                    </div>
                                                </div>
                                                <span class="saleoff fs-8 fs-md-7 text-center align-middle">-{{ 100 - (int)(($variant_selected->discount/$variant_selected->price) * 100) }}%</span>
                                            @endif
                                        @else
                                            <span class="fs-4 text-decoration-underline"><i>{{ trans('Sold out') }}</i></span>
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="variant w-100">
                                        @php($attribute_pivots_names = !empty($variant_selected->attributePivots) ? $variant_selected->attributePivots->pluck('value')->toArray() : [])
                                        @foreach($product_attributes ?? [] as $product_attribute)
                                            <div class="form-group mb-4 attribute-group">
                                                <label class="text-primary fs-6 fw-semibold mb-3 text-capitalize">
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
                                    <div class="row g-2">
                                        @if(!empty($variant_selected)  && (int)$variant_selected->stock > 0)
                                            <div class="col-12 mb-3">
                                                <div class="input-group w-auto">
                                                    <input type="button" value="-" class="button-minus btn-quantity-input border icon-shape mx-1" data-field="quantity">
                                                    <input type="number" name="quantity" min="1" max="{{ $variant_selected->stock }}" data-price="{{ ($variant_selected->discount == 0 || $variant_selected->price == 0) ? ($variant_selected->price ?? 0) : ($variant_selected->discount ?? 0) }}" value="1" class="quantity-field quantity-input quantity-input-product-detail border-0 text-center w-25" aria-label="Quantity">
                                                    <input type="button" value="+" class="button-plus btn-quantity-input border icon-shape mx-1" data-field="quantity">
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('frontend.post.order') }}" method="post" id="product-form-order-now" class="product-form-order-now">
                            @csrf
                            <div class="card shadow-2-strong mb-5 mb-lg-0" style="border-radius: 16px;">
                                <div class="card-body p-4">
                                    <div class="form-outline mb-3">
                                        <label class="name fw-semibold" for="name">{{ trans('Name') }}
                                            <span class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="{{ trans('Your Name') }}"/>
                                    </div>
                                    <div class="form-outline mb-3">
                                        <label class="form-label fw-semibold" for="phone">{{ trans('Phone') }}
                                            <span class="text-danger">*</span></label>
                                        <input type="tel" id="phone" name="phone" class="form-control" placeholder="{{ trans('Your Phone Number') }}"/>
                                    </div>
                                    <div class="form-outline mb-3">
                                        <label class="email fw-semibold" for="email">{{ trans('Email') }}
                                            <span class="text-danger">*</span></label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="{{ trans('Email để nhận Xác nhận đơn hàng') }}"/>
                                    </div>
                                    <div class="form-outline mb-3">
                                        <label class="form-label fw-semibold" for="address">{{ trans('Delivery address') }}
                                            <span class="text-danger">*</span></label>
                                        <textarea name="address" id="address" class="form-control" rows="2"></textarea>
                                    </div>
                                    <hr class="my-4">
                                    <div class="form-outline mb-3">
                                        <label class="form-label fw-semibold" for="payment-method">{{ trans('Payment Method') }}
                                            <span class="text-danger">*</span></label>
                                        <select name="payment_method" class="form-control" id="payment-method">
                                            <option value="cod">{{ trans('Cash On Delivery (COD)') }}</option>
                                            <option value="bank">{{ trans('Bank transfer') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-outline mb-3">
                                        <label class="form-label fw-semibold" for="invoice">
                                            <input type="hidden" name="invoice[status]" value="0">
                                            <input type="checkbox" name="invoice[status]" id="invoice" value="1">
                                            {{ trans('Xuất hóa đơn') }}
                                        </label>
                                        <div class="d-none" id="invoice-info">
                                            <h2 class="fs-5 mb-2 text-primary text-center">{{ trans("Invoice Information") }}</h2>
                                            <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <label class="nav-link active rounded-0 border text-center" style="min-width: 135px" id="business-tab-link" data-bs-toggle="pill" data-bs-target="#business-tab-content" role="tab" aria-controls="business-tab-content" aria-selected="true">
                                                        <span>{{ trans('Business') }}</span>
                                                        <input type="radio" name="invoice[type]" class="d-none" value="business" checked>
                                                    </label>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <label class="nav-link rounded-0 border text-center" style="min-width: 135px" id="personal-tab-link" data-bs-toggle="pill" data-bs-target="#personal-tab-content" role="tab" aria-controls="personal-tab-content" aria-selected="false">
                                                        {{ trans('Personal') }}
                                                        <input type="radio" name="invoice[type]" class="d-none" value="personal">
                                                    </label>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="invoice-tabs">
                                                <div class="tab-pane fade show active" id="business-tab-content" role="tabpanel" aria-labelledby="business-tab-link" tabindex="0">
                                                    <div class="form-outline mb-3">
                                                        <label class="form-label fw-semibold" for="invoice-business-name">{{ trans('Company Name') }}
                                                            <span class="text-danger">*</span></label>
                                                        <textarea name="invoice[business][name]" id="invoice-business-name" class="form-control" rows="2"></textarea>
                                                    </div>
                                                    <div class="form-outline mb-3">
                                                        <label class="form-label fw-semibold" for="invoice-business-tax-code">{{ trans('Tax code') }}
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text" id="invoice-business-tax-code" name="invoice[business][tax_code]" class="form-control" placeholder="{{ trans('Tax code') }}"/>
                                                    </div>
                                                    <div class="form-outline mb-3">
                                                        <label class="form-label fw-semibold" for="invoice-business-email">{{ trans('Email') }}
                                                            <span class="text-danger">*</span></label>
                                                        <input type="email" id="invoice-business-email" name="invoice[business][email]" class="form-control" placeholder="{{ trans('Email') }}"/>
                                                    </div>
                                                    <div class="form-outline mb-3">
                                                        <label class="form-label fw-semibold" for="invoice-business-phone">{{ trans('Phone Number') }}
                                                            <span class="text-danger">*</span></label>
                                                        <input type="tel" id="invoice-business-phone" name="invoice[business][phone]" class="form-control" placeholder="{{ trans('Phone Number') }}"/>
                                                    </div>
                                                    <div class="form-outline mb-3">
                                                        <label class="form-label fw-semibold" for="invoice-business-address">{{ trans('Registered business address') }}
                                                            <span class="text-danger">*</span></label>
                                                        <textarea name="invoice[business][address]" id="invoice-business-address" class="form-control" rows="2"></textarea>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="personal-tab-content" role="tabpanel" aria-labelledby="personal-tab-link" tabindex="0">
                                                    <div class="form-outline mb-3">
                                                        <label class="form-label fw-semibold" for="invoice-personal-name">{{ trans('Full Name') }}
                                                            <span class="text-danger">*</span></label>
                                                        <textarea name="invoice[personal][name]" id="invoice-personal-name" class="form-control" rows="2"></textarea>
                                                    </div>
                                                    <div class="form-outline mb-3">
                                                        <label class="form-label fw-semibold" for="invoice-personal-email">{{ trans('Email') }}
                                                            <span class="text-danger">*</span></label>
                                                        <input type="email" id="invoice-personal-email" name="invoice[personal][email]" class="form-control" placeholder="{{ trans('Email') }}"/>
                                                    </div>
                                                    <div class="form-outline mb-3">
                                                        <label class="form-label fw-semibold" for="invoice-personal-phone">{{ trans('Phone Number') }}
                                                            <span class="text-danger">*</span></label>
                                                        <input type="tel" id="invoice-personal-phone" name="invoice[personal][phone]" class="form-control" placeholder="{{ trans('Phone Number') }}"/>
                                                    </div>
                                                    <div class="form-outline mb-3">
                                                        <label class="form-label fw-semibold" for="invoice-personal-address">{{ trans('Invoice delivery address') }}
                                                            <span class="text-danger">*</span></label>
                                                        <textarea name="invoice[personal][address]" id="invoice-personal-address" class="form-control" rows="2"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="form-outline mb-3">
                                        <label class="form-label fw-semibold" for="address">{{ trans('Note') }}</label>
                                        <textarea name="note" id="note" class="form-control" rows="3"></textarea>
                                        <i class="small fw-light">Ghi chú thời gian giao hàng thuận tiện, địa chỉ email để nhận hóa đơn điện tử, vv...</i>
                                    </div>
                                    <hr class="my-4">
                                    <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
                                        <div class="mb-2">{{ trans('Total') }}:</div>
                                        <div class="mb-2" id="total-price">
                                            @if(!empty($variant_selected) && $variant_selected->stock > 0)
                                                @if($variant_selected->discount == 0 || $variant_selected->price == 0)
                                                    {{ currency_format($variant_selected->price ?? 0) }}
                                                @else
                                                    {{ currency_format($variant_selected->discount ?? 0) }}
                                                @endif
                                            @else
                                                <span class="fs-4 text-decoration-underline"><i>{{ trans('Sold out') }}</i></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="btn-submit-order-now-group mb-3">
                                        <input type="hidden" name="quantity" value="1" class="quantity-input-product-detail">
                                        <input type="hidden" name="product_variant_id" value="{{ $variant_selected->id }}">
                                        <button type="submit" class="btn btn-primary fw-semibold w-100" @disabled(!(!empty($variant_selected) && $variant_selected->stock > 0))>
                                            {{ trans('Checkout') }}
                                        </button>
                                    </div>
                                    <div class="py-2 fs-7">
                                        <div>
                                            <span class="fw-semibold">BASIC</span> – 10 năm Uy tín cung cấp Sản phẩm và Giải pháp vệ sinh văn minh toàn quốc.
                                        </div>
                                        <div>Khi quý khách <i class="fw-semibold">“Xác nhận đặt hàng”</i> có nghĩa là quý khách đã đồng ý với
                                            <a href="{{ route('frontend.redirect_to_page', 'chinh-sach-va-quy-dinh-chung') }}" class="fw-semibold text-decoration-underline">các chính sách</a> và đồng ý tiếp nhận các cuộc gọi, tin nhắn tư vấn, thông báo, xác nhận đơn hàng của Basic.</div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    {!! JsValidator::formRequest('Modules\Order\Requests\OrderRequest','#product-form-order-now') !!}
    <script src="{{ asset('assets/js/frontend_order.js') }}?v={{ env('APP_VERSION', '1') }}" type="text/javascript"></script>
@endpush