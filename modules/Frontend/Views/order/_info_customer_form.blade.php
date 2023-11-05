<div class="card shadow-2-strong mb-5 mb-lg-0" style="border-radius: 16px;">
    <div class="card-body p-4">
        <div class="form-outline mb-3">
            <label class="name fw-semibold" for="name">
                {{ trans('Name') }} <span class="text-danger">*</span>
            </label>
            <input type="text" id="name" name="name" class="form-control" placeholder="{{ trans('Your Name') }}"/>
        </div>
        <div class="form-outline mb-3">
            <label class="form-label fw-semibold" for="phone">
                {{ trans('Phone') }} <span class="text-danger">*</span>
            </label>
            <input type="tel" id="phone" name="phone" class="form-control" placeholder="{{ trans('Your Phone Number') }}"/>
        </div>
        <div class="form-outline mb-3">
            <label class="form-label fw-semibold" for="email">
                {{ trans('Email') }} <span class="text-danger">*</span>
            </label>
            <input type="email" id="email" name="email" class="form-control" placeholder="{{ trans('Email để nhận Xác nhận đơn hàng') }}"/>
        </div>
        <div class="form-outline mb-3">
            <label class="form-label fw-semibold" for="address">
                {{ trans('Delivery address') }} <span class="text-danger">*</span>
            </label>
            <textarea name="address" id="address" class="form-control" rows="2"></textarea>
        </div>
        <hr class="my-4">
        <div class="form-outline mb-3">
            <label class="form-label fw-semibold" for="payment-method">
                {{ trans('Payment Method') }} <span class="text-danger">*</span>
            </label>
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
                <h2 class="fs-5 mb-2 text-info text-center">{{ trans("Invoice Information") }}</h2>
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
            <label class="form-label fw-semibold" for="note">{{ trans('Note') }}</label>
            <textarea name="note" id="note" class="form-control" rows="3"></textarea>
            <i class="small fw-light">Ghi chú thời gian giao hàng thuận tiện, địa chỉ email để nhận hóa đơn điện tử, vv...</i>
        </div>
        <hr class="my-4">
        <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
            <div class="mb-2">{{ trans('Total') }}:</div>
            <div class="mb-2" id="total-price">0</div>
        </div>
        <button type="submit" class="btn btn-primary fw-semibold w-100 mb-3">
            {{ trans('Checkout') }}
        </button>
        <div class="py-2 fs-7">
            <div>
                <span class="fw-semibold">BASIC</span> – 10 năm Uy tín cung cấp Sản phẩm và Giải pháp vệ sinh văn minh toàn quốc.
            </div>
            <div>Khi quý khách <i class="fw-semibold">“Xác nhận đặt hàng”</i> có nghĩa là quý khách đã đồng ý với
                <a href="{{ route('frontend.redirect_to_page', 'chinh-sach-va-quy-dinh-chung') }}" class="fw-semibold text-decoration-underline">các chính sách</a> và đồng ý tiếp nhận các cuộc gọi, tin nhắn tư vấn, thông báo, xác nhận đơn hàng của Basic.</div>
        </div>
    </div>
</div>
