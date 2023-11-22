@if(segmentUrl(0) == 'tim-kiem-san-pham')
    <div class="form-group mb-3">
        <label class="fw-semibold mb-2">Thương hiệu</label>
        <div class="ps-2">
            @foreach($categories as $item)
                @if ($item['type']=='Thương hiệu')
                    @php($slug = $item->slug ?? $item['slug'] ?? '')
                    @if($item['level'] == 0)
                        <div class="form-group">
                            <label class="mb-2">
                                <input type="checkbox" name="categories[brand][]" class="me-2" value="{{ $slug }}" @if(in_array($slug, $requestCategories['brand'] ?? [])) checked @endif>
                                <span>{{ $item->name ?? $item['name'] ?? '' }}</span>
                            </label>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    </div>
@endif
@if(segmentUrl(0) == 'tim-kiem-san-pham')
    <div class="form-group mb-3">
        <label class="fw-semibold mb-2">Kiểu dáng</label>
        <div class="ps-2">
            @foreach($categories as $item)
                @if ($item['type']=='Kiểu dáng')
                    @php($slug = $item->slug ?? $item['slug'] ?? '')
                    @if($item['level'] == 0)
                        <div class="form-group">
                            <label class="mb-2">
                                <input type="checkbox" name="categories[kieudang][]" class="me-2" value="{{ $slug }}" @if(in_array($slug, $requestCategories['kieudang'] ?? [])) checked @endif>
                                <span>{{ $item->name ?? $item['name'] ?? '' }}</span>
                            </label>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    </div>
@endif
@if(segmentUrl(0) == 'tim-kiem-san-pham')
    <div class="form-group mb-3">
        <label class="fw-semibold mb-2">Số chỗ ngồi</label>
        <div class="ps-2">
            @foreach($categories as $item)
                @if ($item['type']=='Số chỗ ngồi')
                    @php($slug = $item->slug ?? $item['slug'] ?? '')
                    @if($item['level'] == 0)
                        <div class="form-group">
                            <label class="mb-2">
                                <input type="checkbox" name="categories[sochongoi][]" class="me-2" value="{{ $slug }}" @if(in_array($slug, $requestCategories['sochongoi'] ?? [])) checked @endif>
                                <span>{{ $item->name ?? $item['name'] ?? '' }}</span>
                            </label>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    </div>
@endif
<div class="w-100">
    <input type="hidden" name="sort_by" value="{{ request()->sort_by ?? 'best_sellers' }}">
    <button type="submit" class="btn btn-primary w-100 rounded-0 mb-2">{{ trans('Search') }}</button>
    <a href="{{ route('frontend.product.search')}}" class="btn btn-default border w-100 rounded-0">{{ trans('Refresh') }}</a>
</div>