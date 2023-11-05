@if($products->count())
    <div class="product-list">
        <div class="row">
            @foreach($products as $product)
                <div class="col-6 col-lg-4 mb-4">
                    <x-product::product-card :product="$product"/>
                </div>
            @endforeach
        </div>
    </div>
    <div class="product-list-pagination text-center">
        <a href="{{ $products->hasMorePages() ? $products->withQueryString()->nextPageUrl() : 'javascript:' }}"
           class="btn btn-outline-primary btn-show-more @if(!$products->hasMorePages()) d-none @endif">
            {{ trans('Show more') }}
        </a>
    </div>
@endif
@push('js')
    <script>
		$(document).ready(function () {
			$(document).on("click", ".btn-show-more", function (e) {
				e.preventDefault();
				const btnMore = $(this);
				const url = $(this).attr('href');
				$.ajax({
					url: url,
					method: "GET"
				}).done(function (response) {
					$(document).find('.product-list').append($(response).find('.product-list').html());
					$('.lazy').lazy();
					const newBtnMoreHref = $(response).find('.btn-show-more').attr('href');
					if (newBtnMoreHref === 'javascript:') {
						btnMore.hide();
					}
					btnMore.attr('href', $(response).find('.btn-show-more').attr('href'))
				});
			});
		})
    </script>
@endpush