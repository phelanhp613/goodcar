<div id="banner-section" class="banner-slider bg-primary w-100 vh-100">
    <div class="home-banner-slider invisible">
		<?php
		    $fullwidth = false;

            foreach(($banners ?? []) as $banner) {
	            $fullwidth = $banner['fullwidth'] ? true : $fullwidth;
            }
		?>
        @foreach($banners as $banner)
            @if(empty($banner['type']))
                <div class="d-block d-md-flex h-100 justify-content-center align-items-center">
                    <a href="{{ $banner['url'] }}">
                        <picture>
                            <source media="(max-width: 574px)" srcset="{{ env('APP_URL') . $banner['image_mb'] ?? env('APP_URL') . $banner['image_pc']}} 1x"/>
                            <source media="(min-width: 575px)" srcset="{{ env('APP_URL') . $banner['image_pc'] }}"/>
                            <img data-lazy="{{ env('APP_URL') . $banner['image_pc'] }}" class="banner-img @if($fullwidth) banner-full @else pb-3 @endif" width="500" height="300" @if($banner['order'] !== 0) loading="lazy" @endif alt="{{ $banner['image_pc'] }}"/>
                        </picture>
                    </a>
                </div>
            @else
                @php($partItems = json_decode($banner['content'] ?? '[]', 1))
                @continue(empty($partItems))
                @include('Frontend::home._banner_custom')
            @endif
        @endforeach
    </div>
    <div class="arrows-slider justify-content-between px-4"></div>
    <div class="dots-slider"></div>
</div>

@push('js')
    <script>
        const bannerCustom = $(document).find('.banner-custom');

		$.each(bannerCustom, function (index, item) {
            const partItem = $(item).find('.part-item-list');
			if(partItem.data('image-pc') !== '') {
				partItem.attr('style', `background: url(${partItem.data('image-pc')}) no-repeat center center; background-size: contain`)
			}
			if(screen.width <= 1100) {
				if(partItem.data('image-mb') !== '') {
					partItem.attr('style', `background: url(${partItem.data('image-mb')}) no-repeat center center; background-size: contain`)
				}
            }
		})
    </script>
@endpush