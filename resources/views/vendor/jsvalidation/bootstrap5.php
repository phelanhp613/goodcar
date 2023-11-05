<script>
    jQuery(document).ready(function () {

        $("<?= $validator['selector']; ?>").each(function () {
            $(this).validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',

                errorPlacement: function (error, element) {
                    if (element.hasClass('select2') || element.hasClass('select2-multiple')) {
                        error.insertAfter(element.next());
                    } else if(element.hasClass('quantity-input')) {
						error.insertAfter(element.parents('.input-group'))
	                } else if (element.attr('type') === 'checkbox' || element.attr('type') === 'radio') {
						const parent = element.parents('.form-group');
                        error.insertAfter(parent);
                    } else {
		                error.insertAfter(element);
	                }
                },
                highlight: function (element) {
                    $(element).removeClass('is-valid').addClass('is-invalid'); // add the Bootstrap error class to the control group
                },

                <?php if (isset($validator['ignore']) && is_string($validator['ignore'])): ?>

                ignore: "<?= $validator['ignore']; ?>",
                <?php endif; ?>


                unhighlight: function (element) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                },

                success: function (element) {
                    $(element).removeClass('is-invalid').addClass('is-valid'); // remove the Boostrap error class from the control group
                },

                focusInvalid: true,
                <?php if (Config::get('jsvalidation.focus_on_error')): ?>
                invalidHandler: function (form, validator) {

                    if (!validator.numberOfInvalids())
                        return;

                    $('html, body').animate({
                        scrollTop: $(validator.errorList[0].element).offset().top
                    }, <?= Config::get('jsvalidation.duration_animate') ?>);

                },
                <?php endif; ?>

                rules: <?= json_encode($validator['rules']); ?>
            });
        });
    });
</script>
