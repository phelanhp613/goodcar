(function ($) {
	"use strict";
	var fn = {
		slickSlider: function (slider, dotsContainer, arrowsContainer) {
			$(slider).slick({
				autoplay: true,
				autoplaySpeed: 6000,
				dots: true,
				arrows: true,
				lazyLoad: 'ondemand',
				appendDots: $(dotsContainer),
				appendArrows: $(arrowsContainer),
				prevArrow: `<a href="javascript:" class="banner-angle-button ms-3 rounded-circle border border-secondary position-absolute top-50 start-0" aria-label="Pre Single">
								<svg fill="#f3e3c3" class="flickity-button-icon" width="14" height="14" viewBox="0 0 100 100">
									<path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow"></path>
								</svg>
							</a>`,

				nextArrow: `<a href="javascript:" class="banner-angle-button me-3 rounded-circle border border-secondary position-absolute top-50 end-0" aria-label="Next Single">
								 <svg fill="#f3e3c3" class="flickity-button-icon" width="14" height="14" viewBox="0 0 100 100">
								    <path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow" transform="translate(100, 100) rotate(180) "></path>
								 </svg>
							</a>`,
			});
		},
		slickOwlCarousel: function (selectors, slidesToShowDefault = 5, slidesToShowLg = 4, slidesToShowMd = 2, slidesToShowSm = 2, slidesToShowXm = 2) {
			slickOwlCarousel(selectors, slidesToShowDefault, slidesToShowLg, slidesToShowMd, slidesToShowSm, slidesToShowXm)
		},
		slickSyncing: function (tabFor, tabNav, slidesToShow, slidesToScroll, breakpoint380slidesToShow, breakpoint380slidesToScroll) {
			slickSyncing(tabFor, tabNav, slidesToShow, slidesToScroll, breakpoint380slidesToShow, breakpoint380slidesToScroll);
		},
		incrementValue: function () {
			incrementValue();
		},
		decrementValue: function () {
			decrementValue();
		},
		backToTop: function () {
			let btnBackToTop = $("#btn-back-to-top");
			window.onscroll = function () {
				if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
					btnBackToTop.show();
				} else {
					btnBackToTop.hide();
				}
			};
			btnBackToTop.on("click", function () {
				document.body.scrollTop = 0;
				document.documentElement.scrollTop = 0;
			});
		},
		dropdownNested: function () {
			$('.dropdown-submenu a.submenu-item').on("click", function (e) {
				$(this).parent('.dropdown-submenu').find('ul').toggle();
				e.stopPropagation();
				e.preventDefault();
			});
		},
	};

	$(document).ready(function () {
		$(document).find('table').addClass("table table-striped w-100");
		$(document).find('.description').removeClass('invisible');
		if ($('.home-banner-slider').length > 0) {
			fn.slickSlider(".home-banner-slider", ".dots-slider", ".arrows-slider");
			$(document).find('.home-banner-slider').removeClass('invisible');
			setTimeout(() => $(document).find('.banner-slider').removeClass('vh-100'), 500)
		}
		if ($('.category-owl-carousel').length > 0) {
			fn.slickOwlCarousel(".category-owl-carousel");
			$(document).find('.category-owl-carousel').removeClass('invisible');
		}
		if ($('.flash-sale-owl-carousel').length > 0) {
			fn.slickOwlCarousel(".flash-sale-owl-carousel", 4, 3);
			$(document).find('.flash-sale-owl-carousel').removeClass('invisible');
		}
		if ($('.product-owl-carousel').length > 0) {
			fn.slickOwlCarousel(".product-owl-carousel", 4);
			$(document).find('.product-owl-carousel').removeClass('invisible');
		}
		fn.slickSyncing('.slick-single', '.slick-nav', 4, 4, 3, 3);
		$(document).find('.slick-single, .slick-nav').removeClass('invisible');
		fn.incrementValue();
		fn.decrementValue();
		fn.backToTop();
		fn.dropdownNested();

		const headerMenuItem = $(document).find('#menu-header').find('.active');

		$.each(headerMenuItem, function (index, item) {
			$(item).parents('.nav-item').find('.parent-menu').addClass('active');
		});

		lazyLoad();
	});
})(jQuery);

function lazyLoad() {
	$(document).find('.lazy').attr('src', 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==');

	$(document).find('.lazy').each((index, item) => {
		let position = item.getBoundingClientRect();
		if (position.top < 1000) {
			const dataSrc = $(item).attr('data-src');
			if (dataSrc) {
				$(item).attr('src', $(item).attr('data-src'));
				$(item).removeAttr('data-src');
				$(item).removeClass('lazy');
			}
		}

		window.addEventListener("scroll", function () {
			position = item.getBoundingClientRect();
			if (position.top < 1000) {
				const dataSrc = item.getAttribute('data-src');
				if (dataSrc) {
					console.log('lazy-loaded');
					item.setAttribute('src', item.getAttribute('data-src'));
					item.removeAttribute('data-src');
					$(item).removeClass('lazy');
				}
			}
		});
	})
}

function slickOwlCarousel(selectors, slidesToShowDefault = 5, slidesToShowLg = 4, slidesToShowMd = 2, slidesToShowSm = 2, slidesToShowXm = 2) {
	$(selectors).each(function (i, item) {
		const selector = $(item);
		const selectorId = selector.attr('id');
		const arrowsContainer = (selectorId) ? $('.arrows-container-' + selectorId) : $('.arrows-container');

		selector.slick({
			dots: false,
			arrows: true,
			infinite: true,
			speed: 300,
			lazyLoad: 'ondemand',
			slidesToShow: slidesToShowDefault,
			slidesToScroll: slidesToShowDefault,
			// swipeToSlide: true,
			appendArrows: arrowsContainer,
			prevArrow: `<div class="px-3 pre-arrow">
								<a href="javascript:" class="btn btn-outline-primary px-2 py-1" aria-label="Pre Single">
									<svg class="flickity-button-icon" width="16" height="16" viewBox="0 0 100 100">
										<path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow"></path>
									</svg>
								</a>
							</div>`,

			nextArrow: `<div class="px-3 next-arrow">
								<a href="javascript:" class="btn btn-outline-primary px-2 py-1" aria-label="Next Single">
									 <svg class="flickity-button-icon" width="16" height="16" viewBox="0 0 100 100">
									    <path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow" transform="translate(100, 100) rotate(180)"></path>
									 </svg>
								</a>
							</div>`,
			responsive: [
				{
					breakpoint: 991,
					settings: {
						slidesToShow: slidesToShowLg,
						slidesToScroll: slidesToShowLg
					}
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow: slidesToShowMd,
						slidesToScroll: slidesToShowMd
					}
				},
				{
					breakpoint: 576,
					settings: {
						slidesToShow: slidesToShowSm,
						slidesToScroll: slidesToShowSm
					}
				},
				{
					breakpoint: 450,
					settings: {
						slidesToShow: slidesToShowXm,
						slidesToScroll: slidesToShowXm
					}
				},
			]
		});
	});
}

function slickSyncing(tabFor, tabNav, slidesToShow, slidesToScroll, breakpoint380slidesToShow, breakpoint380slidesToScroll) {
	$(tabFor).slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		infinite: false,
		adaptiveHeight: true,
		arrows: true,
		appendArrows: $('.slick-single-arrows'),
		prevArrow: `<a href="javascript:" class="position-absolute top-50 start-0" aria-label="Pre Single">
						<svg class="flickity-button-icon" width="16" height="16" viewBox="0 0 100 100"><path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow"></path></svg>
					</a>`,

		nextArrow: `<a href="javascript:" class="position-absolute top-50 end-0" aria-label="Next Single">
						 <svg class="flickity-button-icon" width="16" height="16" viewBox="0 0 100 100">
						    <path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow" transform="translate(100, 100) rotate(180) "></path>
						 </svg>
					</a>`,
	});
	$(tabNav).slick({
		slidesToShow: slidesToShow,
		slidesToScroll: slidesToScroll,
		infinite: false,
		responsive: [
			{
				breakpoint: 380,
				settings: {
					slidesToShow: breakpoint380slidesToShow,
					slidesToScroll: breakpoint380slidesToScroll
				}
			}
		],
		arrows: true,
		appendArrows: $('.slick-nav-arrows'),
		prevArrow: `<a href="javascript:" class="position-absolute top-50 start-0" aria-label="Pre Single">
						<svg class="flickity-button-icon" width="14" height="14" viewBox="0 0 100 100">
							<path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow"></path>
						</svg>
					</a>`,

		nextArrow: `<a href="javascript:" class="position-absolute top-50 end-0" aria-label="Next Single">
						 <svg class="flickity-button-icon" width="14" height="14" viewBox="0 0 100 100">
						    <path d="M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z" class="arrow" transform="translate(100, 100) rotate(180) "></path>
						 </svg>
					</a>`,
	});
	$(tabNav).on('click', '.slick-slide', function (event) {
		event.preventDefault();
		$(".slick-slide").removeClass('active');
		$(this).addClass('active');
		$(tabFor).slick('slickGoTo', $(this).data('slick-index'));
	});
}

function incrementValue() {
	$('.input-group').on('click', '.button-plus', function (e) {
		e.preventDefault();
		let fieldName = $(e.target).data('field');
		let parent = $(e.target).closest('div');
		let currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

		if (!isNaN(currentVal)) {
			parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
		} else {
			parent.find('input[name=' + fieldName + ']').val(1);
		}
	});
}

function decrementValue() {
	$('.input-group').on('click', '.button-minus', function (e) {
		e.preventDefault();
		let fieldName = $(e.target).data('field');
		let parent = $(e.target).closest('div');
		let currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

		if (!isNaN(currentVal) && currentVal > 1) {
			parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
		} else {
			parent.find('input[name=' + fieldName + ']').val(1);
		}
	});
}

function handleRangeTwoPoint(min, max) {
	let maxDefault = max;

	const calcLeftPosition = value => {
		return (value / maxDefault) * 100;
	};

	const handleRangeMin = (input) => {
		let value = parseInt(input.val().replaceAll('.', '').replaceAll('đ', ''));
		let maxValue = parseInt(parent.find('.range-max').val());
		if (value > maxValue) {
			value = min;
		}
		min = value;
		parent.find('#range-thumb-min').css('left', calcLeftPosition(value) + '%');
		parent.find('.range-line').css({
			'left': calcLeftPosition(value) + '%',
			'right': (100 - calcLeftPosition(maxValue)) + '%'
		});
		parent.find('.range-min').val(value);
		parent.find('.range-min-display').val(currencyFormat(value));
	};

	const handleRangeMax = (input) => {
		let value = parseInt(input.val().replaceAll('.', '').replaceAll('đ', ''));
		const minValue = parseInt(parent.find('.range-min').val());
		if (value < minValue) {
			value = min;
		}
		max = value;
		parent.find('#range-thumb-max').css('left', calcLeftPosition(value) + '%');
		parent.find('.range-line').css({
			'left': calcLeftPosition(minValue) + '%',
			'right': (100 - calcLeftPosition(value)) + '%'
		});
		parent.find('.range-max').val(value);
		parent.find('.range-max-display').val(currencyFormat(value));
	};

	const parent = $('#range-two-point');

	parent.find('.range-min').on('input', function () {
		handleRangeMin($(this));
	});

	parent.find('.range-max').on('input', function () {
		handleRangeMax($(this));
	});

	parent.find('.range-min-display').on('change', function () {
		handleRangeMin($(this));
	});

	parent.find('.range-max-display').on('change', function () {
		handleRangeMax($(this));
	});
}

function currencyFormat(number) {
	number = number.toLocaleString('it-IT', {
		style: 'currency',
		currency: 'VND'
	});

	return number.replace('VND', 'đ');
}