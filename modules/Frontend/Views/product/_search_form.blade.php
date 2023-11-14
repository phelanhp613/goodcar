<div class="form-group mb-2">
    <label class="fw-semibold mb-2">{{ trans('Range Price') }}</label>
    <x-base::range-two-point min-name="min_price" max-name="max_price"/>
</div>
<div class="form-group mb-3">
    <label class="fw-semibold mb-2">{{ trans('Category') }}</label>
    <div class="ps-2">
        @if(!empty(segmentUrl(0) !== 'tim-kiem-san-pham') && $data->children->count() > 0)
            @foreach($data->children as $item)
                <div class="form-group">
                    <label class="mb-2">
                        <input type="checkbox" name="categories[]" class="me-2" value="{{  $item->slug }}" @if(in_array($item->slug, $categories)) checked @endif>
                        <span>{{ $item->name }}</span>
                    </label>
                </div>
            @endforeach
        @else
            @foreach($categories as $item)
                @php($slug = $item->slug ?? $item['slug'] ?? '')
                @if($item['level'] == 0)
                    <div class="form-group">
                        <label class="mb-2">
                            <input type="checkbox" name="categories[]" class="me-2" value="{{ $slug }}" @if(in_array($slug, $requestCategories)) checked @endif>
                            <span>{{ $item->name ?? $item['name'] ?? '' }}</span>
                        </label>
                    </div>
                    @foreach($item['children'] as $item)
                        @php($slug = $item->slug ?? $item['slug'] ?? '')
                        <div class="form-group">
                            <label class="mb-2 ms-4">
                                <input type="checkbox" name="categories[]" class="me-2" value="{{ $slug }}" @if(in_array($slug, $requestCategories)) checked @endif>
                                <span>{{ $item->name ?? $item['name'] ?? '' }}</span>
                            </label>
                        </div>
                    @endforeach
                @endif
            @endforeach
        @endif
    </div>
</div>
<div class="w-100">
    <input type="hidden" name="sort_by" value="{{ request()->sort_by ?? 'best_sellers' }}">
    <button type="submit" class="btn btn-primary w-100 rounded-0">{{ trans('Search') }}</button>
</div>