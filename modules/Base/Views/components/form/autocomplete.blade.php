<div class="autocomplete-select form-group mb-3" data-action="{{ $action }}" data-id="{{ $id }}">
    {!! Form::select($name, $options, $selectedOptions,[
	                'id' => $id,
    	            'class' => ($multiple ? 'select2-multiple' : 'select2') . ' form-control',
	                'style' => 'width:"100%"',
	                'multiple' => $multiple,
	            ]) !!}
</div>
@push('js')
    <script class="autocomplete-script">
		$(document).ready(function () {
			autocompleteHandle("{{ trans('Something went wrong.') }}");
			function autocompleteHandle(failError) {
				const selector = $(document).find(`.autocomplete-select`);
				$.each(selector, function (i, item) {
					const id = $(item).data('id');
					const action = $(item).data('action');
					$(item).find('select').select2({
						theme: 'bootstrap-5',
                        placeholder: "{{ trans('Select') }}",
						multiple: "{{ $multiple }}",
						ajax: {
							url: action,
							cache: true,
							data: function (params) {
								return {key: params.term};
							},
							processResults: function (data, params) {
								const parent = $(document).find(`#${id}`).parent('.form-group');
								let html = [];
								if (data.status === 200) {
									parent.find('.error').remove();
									$.each(data.data.data, function (i, item) {
										let sku = (item.sku ? ' | ' + item.sku : '');
										let name = item.name ?? item.title ?? '';
										if(item.product && item.product.has_variant === 0) {
											name = item.product.name ?? item.product.title ?? '';
											sku = (item.product.sku ? ' | ' + item.product.sku : '');
                                        }
										html.push({
											id: item.id,
											text: name + sku
										})
									});
								} else {
									parent.append(`<div class="error text-danger">${failError}</div>`)
								}
								return {
									results: html
								};
							}
						}
					});
				})
			}
		});
    </script>
@endpush
