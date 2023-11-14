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
                @include('Frontend::product._search_form')
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
                @include('Frontend::product.category._product_listing')
            </div>
        </div>
    </form>
</div>