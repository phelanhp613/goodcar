<div class="upload-file-multiple">
    <div class="d-flex align-items-end">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="me-2" viewBox="0 0 16 16">
            <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
            <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
        </svg>
        <span class="fw-semibold fs-5 upload-file-multiple-title">{{ trans('Send actual photos') }}</span>
    </div>
    <div class="py-3 d-flex">
        <div class="images-uploaded d-flex"></div>
        <label class="input-upload">
            <i class="plus-icon">+</i>
            <input type="file" class="input-upload-file-multiple d-none" />
        </label>
    </div>
    <input type="text" name="{{ $name ?? 'images' }}" class="opacity-0 input-image-required">
</div>
@push('js')
    <script>
		$(document).ready(function () {
			$(".upload-file-multiple").on("change", function (e) {
				if($(document).find('.image-uploaded').length === 5) {
					alert("{{ trans('You can only upload a maximum of 5 photos.') }}")
                } else {
					const acceptType = ['image/png', 'image/jpeg', 'image/jpg', 'image/pdf'];
					const acceptSize = "{{ $acceptSize ?? 500 }}";
					let files = e.target.files;
					let filesLength = files.length;
					for (let i = 0; i < filesLength; i++) {
						const f = files[i];
						if(f.size > parseInt(acceptSize) * 1000) {
							const sizeConvert = (parseInt(acceptSize)/1000 < 1) ? parseInt(acceptSize) + 'Kb' : (parseInt(acceptSize)/1000) + 'Mb';
							alert("{{ trans('Please upload image smaller than') }} " + sizeConvert);
						} else {
							if((acceptType.indexOf(f.type) > -1)) {
								const fileReader = new FileReader();
								fileReader.onload = (function (e) {
									const file = e.target;
									const html = `<div class="image-uploaded position-relative me-3">
                                                <a href="javascript:" class="remove rounded-circle bg-dark text-white">×</a>
                                                <div class="image ratio ratio-4x3">
                                                    <img class="w-100 h-100 object-fit-cover" src="${e.target.result}" title="${file.name}" width="100" height="100" />
                                                </div>
                                                <input type="text" name="{{ $name ?? 'images' }}[${f.name}]" id="file-${i}" value="${e.target.result}" class="opacity-0"/>
                                            </div>`;
									$('.images-uploaded').append(html);
									$(document).find(".input-image-required").remove();
									if($(document).find('.image-uploaded').length === 5) {
										$('.input-upload').hide();
									}
								});
								fileReader.readAsDataURL(f);
                            } else {
								alert("{{ trans('Please upload file with type') . ': PDF, JPG, JPEG, PNG!' }}");
                            }
						}
					}
                }
			});

			$(document).on('click', '.remove', function () {
				$(this).parent(".image-uploaded").remove();
				if($(document).find('.image-uploaded').length < 5) {
					$('.input-upload').show();
				}
				if($(document).find('.image-uploaded').length === 0) {
					$(document).find(".upload-file-multiple").append(`<input type="text" name="{{ $name ?? 'images' }}" class="opacity-0 input-image-required">`);
				}
			});
		});
    </script>
@endpush