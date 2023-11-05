@php
    $sorts = [
        'best_sellers' => trans('Best sellers'),
        'price_down' => trans('Price down'),
        'price_up' => trans('Price up'),
    ];
    $categories = request()->categories ?? [];
    $currentSort = request()->sort_by ?? 'best_sellers';
@endphp
<div class="form">
    <form action="">
        <div class="row">
            <div class="col-md-3 mb-3">
                <h2 class="h4">{{ trans('Filter') }}</h2>
                <div class="form-group mb-2">
                    <label class="fw-semibold mb-2">{{ trans('Range Price') }}</label>
                    <x-base::range-two-point min-name="min_price" max-name="max_price"/>
                </div>
                <div class="form-group mb-3">
                    <label class="fw-semibold mb-2">{{ trans('Category') }}</label>
                    <div class="ps-2">
                        @if($data->children->count() > 0)
                            @foreach($data->children as $item)
                                <div class="form-group">
                                    <label class="mb-2">
                                        <input type="checkbox" name="categories[]" class="me-2" value="{{  $item->slug }}"  @if(in_array($item->slug, $categories)) checked @endif>
                                        <span>{{ $item->name }}</span>
                                    </label>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="w-100">
                    <input type="hidden" name="sort_by" value="{{ request()->sort_by ?? 'best_sellers' }}">
                    <button type="submit" class="btn btn-primary w-100 rounded-0">{{ trans('Search') }}</button>
                </div>
            </div>
            <div class="col-md-9">
                <div class="dropdown d-flex justify-content-end">
                    <div class="dropdown-toggle border py-1 px-2 needsclick" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fw-semibold">{{ trans('Sort by') }}:</span> {{ $sorts[$currentSort] }}
                    </div>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item @if($currentSort == 'best_sellers') active @endif" href="{{ request()->fullUrlWithQuery(['sort_by' => 'best_sellers']) }}">{{ $sorts['best_sellers'] }}</a>
                        </li>
                        <li>
                            <a class="dropdown-item @if($currentSort == 'price_down') active @endif" href="{{ request()->fullUrlWithQuery(['sort_by' => 'price_down']) }}">{{ $sorts['price_down'] }}</a>
                        </li>
                        <li>
                            <a class="dropdown-item @if($currentSort == 'price_up') active @endif" href="{{ request()->fullUrlWithQuery(['sort_by' => 'price_up']) }}">{{ $sorts['price_up'] }}</a>
                        </li>
                    </ul>
                </div>
                <hr class="mt-0 mb-4">
                @include('Frontend::product._product_listing')
            </div>
        </div>
    </form>
</div>