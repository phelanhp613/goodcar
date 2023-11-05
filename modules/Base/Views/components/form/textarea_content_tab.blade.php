@push('css')
    <link href="{{ asset('assets/vendor/nestable/nestable.css') }}" rel="stylesheet">
    <style>
        .dd {
            float: none !important;
        }
		.dd-item {
			position: relative;
			background: white;
		}
		.dd-handle {
			background: white;
            height: 36px;
			width: 36px;
		}
    </style>
@endpush
<div class="section-content">
    <h2 class="form-label fs-6 mb-3">{{ trans('Content tabs') }}</h2>
    <div class="input-group mb-3">
        <input id="tab-name-input" type="text" autocomplete="off" class="form-control" placeholder="{{ trans('Add tab') }}" aria-label="">
        <button type="button" class="btn btn-secondary border-gray" id="btn_add_section" disabled>{{trans('Add tab')}}</button>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="dd w-100 mw-100">
                <ol class="mb-4 dd-list" id="tab-links" role="tablist">
                    @foreach($content as $key => $item)
                        <li class="dd-item tab-item d-flex gap-1 align-items-center mb-3 w-100" data-id="{{ $key }}">
                            <a href="javascript:" role="button" class="btn m-0 d-inline-block dd-handle cursor-pointer border">
                                <i class="fas fa-arrows-up-down-left-right fs-7"></i>
                                <input type="hidden" name="content[sort][]" class="form-control mb-3" placeholder="Label" value="{!! $item->url !!}">
                            </a>
                            <span
                                 class="btn btn-outline-primary rounded-0 position-relative py-2 px-4 w-100 tab-link-{{ $item->url }} @if($key == 0) active @endif"
                                 data-bs-toggle="pill"
                                 data-bs-target="#tab-{{ $item->url }}"
                                 role="tab"
                                 aria-controls="{{ $item->url }}"
                                 aria-selected="true"
                            >
                                <span class="fw-semibold text-truncate text-truncate-1">{!! $item->label !!}</span>
                                <span href="javascript:" class="btn-remove-tab position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><i class="fas fa-times"></i></span>
                            </span>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content" id="tab-content">
                @foreach($content as $key => $item)
                    <div class="tab-pane fade @if($key == 0) show active @endif" id="tab-{{ $item->url }}" role="tabpanel" aria-labelledby="{{ $item->url }}" tabindex="0">
                        <div class="p-3 border">
                            <div class="form-group">
                                <input type="text" name="content[{{$item->url}}][label]" class="form-control mb-3" placeholder="Label" value="{!! $item->label !!}">
                                <input type="hidden" name="content[{{$item->url}}][label_hidden]" value="{{$item->label_hidden}}">
                            </div>
                            <div class="form-group mb-0">
                                <textarea name="content[{{$item->url}}][content]" class="form-control content-box" id="content-{{$item->url}}">
                                    {!! $item->content !!}
                                </textarea>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('assets/vendor/nestable/jquery.nestable.js') }}"></script>
    <script>
		$(document).ready(function () {
			const dd = $('.dd');
			dd.nestable({
                maxDepth: 1
			}).on('change', function () {
                var id = $(this).find('.dd-item').data('id');
				console.log($(this).nestable('serialize'));
            });


			textareaContentComponent("{{ count($content) }}", '{{ route('setting.elfinder.ckeditor4') }}');
			$(document).find('.content-box').each(function (i, item) {
				CKEDITOR.replace(`${$(item).attr('id')}`, {
					filebrowserBrowseUrl: '{{ route('setting.elfinder.ckeditor4') }}',
					height: 400,
					extraAllowedContent: '*(*)',
					allowedContent: true,
					removePlugins: 'iframe',
					toolbar : [
						['Font', 'FontSize', 'Format'], ['TextColor', 'BGColor'], ['Bold', 'Italic', 'Underline', 'Strike'],
						['JustifyLeft', 'JustifyRight', 'JustifyCenter', 'JustifyBlock'], ['NumberedList', 'BulletedList'], ['Outdent', 'Indent', 'Blockquote'], ['Table', 'HorizontalRule', 'SpecialChar'], ['Link', 'Unlink', 'Image'],
						['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord'], ['Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll'], ['Source']
					]
				});
			});

			$(document).on('click', '.btn-remove-tab', function () {
				var title = '{{ trans("Are you sure?") }}';
				var text = '{{ trans("You will not be able to revert this!") }}';
				swal({
					title: title,
					text: text,
					icon: "warning",
					buttons: ['{{ trans('Cancel') }}', '{{ trans('Delete') }}'],
					dangerMode: true,
				}).then((willDelete) => {
					if (willDelete) {
						$($(this).parent().data('bs-target')).remove();
						$(this).parents('.tab-item').remove();
					}
				});
			});
		});
    </script>
@endpush
