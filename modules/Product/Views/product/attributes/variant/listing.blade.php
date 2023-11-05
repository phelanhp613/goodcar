@extends("Base::backend.master")@php(($prompt = ['' => trans('Select')]))
@section("content")
    <div id="product-variant" class="container">
        <div class="row page-titles mb-4">
            <div class="col-5 align-self-center">
                <h5 class="title">{{ trans('Versions') }}</h5>
            </div>
            <div class="col-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb fs-7">
                        <li class="breadcrumb-item"><a href="/admin">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('get.product.list') }}">{{ trans('Product') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('get.product.update', $data->id ?? null) }}">{{ $data->name ?? "" }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ trans('Versions') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="pb-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h5>{{ trans('Versions') }} {{ trans('of') }} {{ $data->name }}</h5>
                </div>
                <div class="card-body">
                    @php($attribute_ids = !empty($data) ? json_decode($data->attribute_ids) : [])
                    <div class="form-group w-100 w-md-50">
                        {{--<label for="tags" id="attribute-select" class="form-label">{{ trans('Config Attribute') }}</label>
                        <select name="attribute_ids[]" id="attribute-select" class="select2-multiple form-control w-100" multiple="multiple">
                            @foreach($attributes as $attribute)
                                <option value="{{ $attribute->id }}" @if(in_array($attribute->id, $attribute_ids)) selected @endif>
                                    {{ $attribute->name . ": " . implode(', ', $attribute->children->pluck('name')->toArray()) }}
                                </option>
                            @endforeach
                        </select>--}}
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#attribute-select">
                            {{ trans('Config Attribute') }}
                        </button>
                        <div>
                            <a href="{{ route('get.product_attribute.list') }}" class="text-info text-decoration-underline">
                                <i class="fas fa-plus text-info fw-bold"></i>
                                <span>{{ trans('Add more product attribute') }}</span>
                            </a>
                        </div>
                    </div>
                    <form action="" method="post" id="config-attribute-form">
                        @csrf
                        <div id="attribute-value" class="row">
                            @include('Product::product.attributes.variant._attributes')
                        </div>
                        <div class="button-group">
                            <button type="submit" class="btn btn-info text-white me-2">{{ trans('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="attribute-select" tabindex="-1" aria-labelledby="attribute-select" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form action="#" id="config-attribute-option-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">{{ trans('Config Attribute') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @foreach($attributes as $attribute)
                                <div class="col-md-6 col-lg-4">
                                    <label>{{ $attribute->name }}</label>
                                    <div class="ps-3">
                                        @foreach($attribute->children as $value)
                                            <label class="d-block">
                                                <input type="checkbox" name="attrs[{{ $attribute->id }}][]" value="{{ $value->id }}">
                                                <span class="fw-normal">{{ $value->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary border" data-bs-dismiss="modal">{{ trans('Close') }}</button>
                        <button type="submit" class="btn btn-info text-white" data-bs-dismiss="modal">{{ trans('Save Change') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
		$(document).ready(function () {
			$(document).on('submit', '#config-attribute-option-form', function (e) {
				e.preventDefault();
				const data = $(this).serialize();
				$.ajax({
					url: "{{ route('post.product_variant.updateAttribute', $data->id) }}",
					method: "POST",
					data: data,
				}).done(function (response) {
					$(document).find('#attribute-value').html($(response).find('#attribute-value').html());
				});
				$(this).parents('form').find(".select2-multiple").select2({
					theme: 'bootstrap-5',
					closeOnSelect: true,
					tags: true
				});
			})
			$(document).on('change', '#attribute-select', function () {
				const attribute_ids = $(this).val();
				/*$.ajax({
					url: "{{ route('post.product_variant.updateAttribute', $data->id) }}",
					method: "POST",
					data: {'attribute_ids': attribute_ids},
				}).done(function (response) {
					$(document).find('#attribute-value').html($(response).find('#attribute-value').html());
				});
				$(this).parents('form').find(".select2-multiple").select2({
					theme: 'bootstrap-5',
					closeOnSelect: true,
					tags: true
				});*/
			});
		});
    </script>
@endpush