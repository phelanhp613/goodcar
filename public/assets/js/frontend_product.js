(function ($) {
	"use strict";
	var fn = {
		changeVariant: function () {
			$(document).on('change', '.btn-attribute', function () {
				const btnAttributeVal = $(this).val();
				const form = $(this).parents('form');
				const data = form.serialize();
				const url = $(this).parents('.product-attributes').data('url');
				$.ajax({
					url: url,
					data: data,
					method: 'GET'
				}).done(function (response) {
					$(document).find('.product-name').html($(response).find('.product-name').html());
					$(document).find('.product-form').html($(response).find('.product-form').html());
					$(document).find('.product-images').html($(response).find('.product-images').html());
					$(document).find('input[value="' + btnAttributeVal + '"].btn-attribute').parent('label').addClass('btn-primary text-white').removeClass(['btn-outline-primary']);
					slickSyncing('.slick-single', '.slick-nav', 4, 4, 3, 3);
					$(document).find('.description, .slick-single, .slick-nav').removeClass('invisible');
					$(document).find('table').addClass("table table-striped w-100");
					$(document).find('.product-attributes-order-now').html($(response).find('.product-attributes-order-now').html());
					$(document).find('#total-price').html($(response).find('#total-price').html());
					$(document).find('.btn-submit-order-now-group').html($(response).find('.btn-submit-order-now-group').html());
					$(document).find('.product-suggest').html($(response).find('.product-suggest').html());
					if ($('.product-owl-carousel').length > 0) {
						slickOwlCarousel(".product-owl-carousel.invisible", 4);
						$(document).find('.product-owl-carousel').removeClass('invisible');
					}
					incrementValue();
					decrementValue();
					console.log('done');
				});
			});
		},
	}

	$(document).ready(function () {
		fn.changeVariant();
		if ($(document).find('.product-owl-carousel-sidebar').length > 0) {
			slickOwlCarousel(".product-owl-carousel-sidebar.invisible", 2, 1, 1, 1);
			$(document).find('.product-owl-carousel-sidebar').removeClass('invisible');
		}

		$(document).on('submit', '#product-form', function(e) {
			$(this).find('button[type="submit"]').attr('disabled', 'disabled');
		});
	});
})(jQuery);