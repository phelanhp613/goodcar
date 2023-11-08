<div class="modal fade gallery" id="gallery" tabindex="-1" role="dialog" aria-labelledby="image-gallery" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" id="popup-product-image">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="image-gallery">{{ trans('Image Gallery') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form action="{{ $action }}" method="post" id="gallery-form">
                    @csrf
                    <div id="gallery" class="image-box">
                        <div class="mb-3">
                            <label>{{ trans('Main Image') }}</label>
                            <div class="image-item ratio ratio-1x1">
                                <input type="hidden" value="{{ $images['main'] ?? '' }}" name="images[main]">
                                <img src="{{ $images['main'] ?? '' }}" alt="{{ $images['main'] ?? '' }}" class="object-fit-contain w-100 h-100" width="150" height="150">
                            </div>
                        </div>
                        <div>
                            <label>{{ trans('Sub Image') }}</label>
                            <div class="d-flex gap-4 flex-wrap sub-images">
                                @foreach($images as $key => $item)
                                    @if($key == 'main') @continue @endif
                                    <div class="image-item">
                                        <button type="button" href="javascript:" class="btn btn-outline-danger bg-white btn-remove rounded-circle">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <input type="hidden" value="{{ $item }}" name="images[]">
                                        <div class="ratio ratio-1x1">
                                            <img src="{{ $item }}" alt="{{ $item }}" class="object-fit-contain w-100 h-100" width="150" height="150">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class=" py-3">
                        <div class="col-md-8 input-group">
                            <a href="javascript:" class="btn btn-primary btn-elfinder">{{ trans('Add more') }}</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info waves-effect text-left text-white" id="submit-gallery">{{ trans('Save') }}</button>
                <button type="button" class="btn btn-outline-dark waves-effect text-left" data-bs-dismiss="modal">{{ trans('Close') }}</button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
		$(document).on("click", "#submit-gallery", function () {
			$('#gallery-form').submit();
		});

		$(document).on('click', ".btn-remove", function () {
			$(this).parent().remove();
		})
    </script>
@endpush
