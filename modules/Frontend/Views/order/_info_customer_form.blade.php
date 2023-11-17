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
                <option value="bank_100">{{ trans('Bank transfer 100%') }}</option>
                <option value="bank_20">{{ trans('Bank transfer 20%') }}</option>
            </select>
        </div>
        <div class="form-outline mb-3">
            <label class="form-label fw-semibold" for="note">{{ trans('Note') }}</label>
            <textarea name="note" id="note" class="form-control" rows="3"></textarea>
            <i class="small fw-light">Ghi chú thời gian giao hàng thuận tiện, địa chỉ email để nhận hóa đơn điện tử, vv...</i>
        </div>
        <hr class="my-4">
        <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
            <div class="mb-2">{{ trans('Total') }}:</div>
            @php($finalPrice = currency_format(($variant->discount ?? 0) == 0 ? ($variant->price ?? 0) : ($variant->discount ?? 0), " VNĐ"))
            <div class="mb-2" id="total-price">{{ $finalPrice }}</div>
        </div>
        <button type="submit" class="btn btn-primary fw-semibold w-100 mb-3">
            {{ trans('Checkout') }}
        </button>
    </div>
</div>
