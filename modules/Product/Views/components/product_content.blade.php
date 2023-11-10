{{--<div class="bg-primary position-fixed product-tab-nav shadow-sm w-100" id="product-tab-nav">
    <div class="container text-center">
        <div class="navbar-nav row row-cols-{{ count($content) }} g-0">
            @foreach($content as $key => $item)
                <div class="py-3 col nav-link">
                    <a href="#{{$item->url}}" class="fw-semibold btn-nav cursor-pointer text-center post-nav-btn">
                        <span class="text-secondary hover">{{$item->label}}</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>--}}

<div class="content mb-5">
    @if(!empty($content))
        <div class="body-content mb-4">
            @foreach($content as $key => $item)
                <div id="{{$item->url}}" class="content-section fs-7 fs-md-6">
                    <?php
                        $itemContent = str_replace('src=', 'class="lazy" data-src=', $item->content);
		                $itemContent = str_replace('<iframe', '<div class="ratio ratio-16x9"><iframe', $itemContent);
		                $itemContent = str_replace('</iframe>', '</iframe></div>', $itemContent);
                    ?>
                    {!! $itemContent !!}
                </div>
            @endforeach
        </div>
    @endif
</div>

@push('js')
    <script>
		$(document).ready(function () {
			let productTabNav = $("#product-tab-nav");
			let btnBackToTop = $("#btn-back-to-top");
			window.onscroll = function () {
				if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
					productTabNav.show();
				}
				else {
					productTabNav.hide();
				}
				if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
					btnBackToTop.show();
				}
				else {
					btnBackToTop.hide();
				}
			};

			$(document).on('click', '.post-nav-btn', function (e) {
				setTimeout(() => scrollTo(href), 1000);
				const href =  $(this).attr('href');
			});

            function scrollTo(href) {
	            $('html,body').animate({
		            scrollTop: $(href).offset().top - 115
	            }, 300);
            }

			/*let btnShow = $(".btn-show-more");
			let showMore = $(".show-more");
			let bodyContent = $(".body-content");

			btnShow.on("click", function () {
				if ($(".body-content").hasClass("hide-content")) {
					btnShow.text('{{ trans("Show less") }}');
					bodyContent.removeClass("hide-content");
					showMore.addClass("no-before");
				}
				else {
					btnShow.text('{{ trans("Show more") }}');
					bodyContent.addClass("hide-content");
					showMore.removeClass("no-before");
				}
			});*/

            @if(in_array('view', request()->segments()))
                $.each($('a'), function (i, item) {
                    let href = $(item).attr('href');
                    if(href.indexOf('#') === -1){
                        $(item).attr('href','javascript:')
                    }

                    if($(item).attr("data-bs-target") === '#view-cart') {
                        $(item).attr("data-bs-target", 'view-cart')
                    }
                });
            @endif
		});
    </script>
@endpush