<div id="category-section" class="container mb-3">
    <?php $productCategoryIDs = cache('home_page_config')['HOME_PRODUCT_CATEGORY_IDS'] ?? [] ?>
    @foreach($productCategoryIDs as $id)
		<?php $product_category = $product_categories->where('id', $id)->first() ?>
        @if(!empty($products[$product_category->id]))
            <div class="category">
                <div class="title-section title-left mb-3">
                    <h2>
                        <span class="pe-2 fw-bold text-uppercase"> {{ !empty($product_category->home_name) ? $product_category->home_name : $product_category->name }}</span>
                    </h2>
                </div>
                <div class="row">
						<?php $item = 1 ?>
                    @foreach($products[$product_category->id] as $product)
                        @php
                            if ($item > 10) {
								break;
                            }
                            $item++;
                        @endphp
                        <div class="col-6 col-md-4 col-lg-3 mb-4">
                            <x-product::product-card :product="$product"/>
                        </div>
                    @endforeach
                </div>
                <div class="text-center py-2 mb-3">
                    <a href="{{ route('frontend.redirect_to_page', $product_category->slug) }}" class="btn btn-primary rounded-0">{{ trans('See all products') }}</a>
                </div>
            </div>
        @endif
    @endforeach
</div>