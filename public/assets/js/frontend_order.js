$(document).ready(function () {
	calTotalPrice();
	$(document).find('#invoice').prop('checked', false);
	$(document).on('change', '#invoice', function (e) {
		if (this.checked) {
			$(document).find('#invoice-info').removeClass('d-none');
		}
		else {
			$(document).find('#invoice-info').addClass('d-none');
		}
	});
	$(document).on('click', '.btn-quantity-input', function () {
		$(this).parents('.input-group').find("span.text-danger").remove();
		const currentInput = $(this).parent().find('.quantity-input');
		if (parseInt(currentInput.val()) > parseInt(currentInput.attr('max'))) {
			$(this).parents('.input-group').append("<span class='text-danger fs-7 pt-1 w-100'>Không đủ số lượng</span>")
			$(document).find('.btn-submit-order-now-group').find('.btn').attr('disabled', true);
		}
		else {
			$(document).find('.quantity-input-product-detail').val(currentInput.val());
			$(document).find('.btn-submit-order-now-group').find('.btn').removeAttr('disabled');
			calTotalPrice();
		}
	});
	$(document).on('change', '.quantity-input', function () {
		if ($(this).val() < 1) {
			$(this).val(1);
		}
		$(this).parents('.input-group').find("span.text-danger").remove();
		console.log(parseInt($(this).val()), parseInt($(this).attr('max')));
		if (parseInt($(this).val()) > parseInt($(this).attr('max'))) {
			$(this).parents('.input-group').append("<span class='text-danger fs-7 pt-1 w-100'>Không đủ số lượng</span>")
			$(document).find('.btn-submit-order-now-group').find('.btn').attr('disabled', true);
		}
		else {
			$(document).find('.quantity-input-product-detail').val($(this).val());
			$(document).find('.btn-submit-order-now-group').find('.btn').removeAttr('disabled');
			calTotalPrice();
		}
	});

	function calTotalPrice() {
		const quantityInputs = $(document).find('.quantity-input');
		let totalPrice = 0;
		$.each(quantityInputs, function (i, item) {
			if(parseInt($(item).attr('max')) > 0) {
				totalPrice = totalPrice + ($(item).val() * $(item).data('price'));
			}
		});
		totalPrice = totalPrice.toLocaleString('it-IT', {style: 'currency', currency: 'VND'});
		$(document).find('#total-price').html(totalPrice.replace('VND', 'đ'));
	}
});