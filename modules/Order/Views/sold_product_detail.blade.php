@extends('Base::backend.master')

@php use Modules\Order\Models\Order; @endphp
@section('content')
    <div id="role-module" class="container">
        <div class="row page-titles mb-4">
            <div class="col-5 align-self-center">
                <h5 class="title">{{ trans('Sold Product Detail') }}</h5>
            </div>
            <div class="col -7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb fs-7">
                        <li class="breadcrumb-item"><a href="/admin">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('get.order.sold_product_list') }}">{{ trans('Sold Product') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('Sold Product Detail') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="detail">
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('post.order.sold_product_detail', $data->id) }}" method="post">
                                <div class="form-group">
                                    <label for="status">{{ trans('Status') }}</label>
                                    <div>
                                        @php($status = $data->order->status)
                                        @if ($status == 0)
                                            <span class="badge bg-danger text-white p-2 fs-6">{{ Order::getStatus($status) }}</span>
                                        @elseif($status == 2)
                                            <span class="badge bg-warning p-2 fs-6">{{ Order::getStatus($status) }}</span>
                                        @elseif($status == 5)
                                            <span class="badge bg-success p-2 fs-6">{{ Order::getStatus($status) }}</span>
                                        @else
                                            <span class="badge bg-info p-2 fs-6">{{ Order::getStatus($status) }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="order">{{ trans('Product') }}</label>
                                    <div class="fw-semibold text-info">
                                        <a href="{{ route('get.product_variant.update', $data->productVariant->id) }}">#{{ $data->productVariant->name }}</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="order">{{ trans('Order') }}</label>
                                    <div class="fw-semibold text-danger">
                                        <a href="{{ route('get.order.update', $data->order->id) }}">#{{ $data->order->code }}</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="chassis_number">{{ trans('Chassis number') }}</label>
                                    <input type="text" name="chassis_number" class="form-control" id="chassis_number" value="{{ $data->chassis_number ?? null }}">
                                </div>
                                <div class="form-group">
                                    <label for="vehicle_engine_number">{{ trans('Vehicle engine number') }}</label>
                                    <input type="text" name="vehicle_engine_number" class="form-control" id="" value="{{ $data->vehicle_engine_number ?? null }}">
                                </div>
                                <div>
                                    <button type="button" class="btn btn-default border" data-bs-dismiss="modal">{{ trans('Close') }}</button>
                                    <button type="submit" class="btn btn-primary">{{ trans('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            @php($variant = $data->productVariant)
                            @if(!empty($variant))
                                <h2 class="">{{ $variant->name }}</h2>
                                <div class="w-md-50 ratio ratio-16x9 mb-3">
                                    <img src="{{ getMainImage($variant->images) }}" class="w-100 h-100 object-fit-contain" alt="">
                                </div>
                                <div class="mb-3">
                                    <h3>{{ trans('Price') }}</h3>
                                    <div class="product-price fw-semibold">
                                        <span class="fs-md-3 fs-5 text-success">{{ currency_format($data->price ?? 0) }}</span>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <h3>{{ trans('Attribute') }}</h3>
                                    @php($productAttributes = [])
                                    @if(!empty($variant->attributes))
                                        <table class="table table-bordered">
                                            @foreach($variant->attributes as $key => $attribute)
                                                @php($productAttributes[$attribute->id] = ['name' => $attribute->name, 'value' => $attribute->pivot->value])
                                                <tr>
                                                    <td style="width: 200px">
                                                        <label class="fw-semibold">{{ $attribute->name }}</label>
                                                    </td>
                                                    <td>{{ $attribute->pivot->value }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @endif
                                </div>
                                <div class="">
                                    <h3>{{ trans('Specification') }}</h3>
                                    @if(!empty($variant->attributes))
                                        <table class="table table-bordered">
                                            <tr>
                                                <td class="fw-semibold" style="width: 200px">{{ trans('Engine') }}</td>
                                                <td>{{ $variant->engine }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold" style="width: 200px">{{ trans('Power') }}</td>
                                                <td>{{ $variant->power }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold" style="width: 200px">{{ trans('Drive System') }}</td>
                                                <td>{{ $variant->drive_system }}</td>
                                            </tr>
                                        </table>
                                    @endif
                                </div>
                                <input type="hidden" name="product_variant_id" value="{{ $variant->id }}">
                                <input type="hidden" name="product_id" value="{{ $variant->product->id }}">
                                <input type="hidden" name="product_attributes" value="{{ json_encode($productAttributes) }}">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header"><h5>{{ trans('Maintenance') }}</h5></div>
                <div class="card-body table-responsive">
                    <table class="table table-striped" id="table-maintenance">
                        <thead>
                        <tr>
                            <th style="width: 200px;">{{ trans('Date') }}</th>
                            <th>{{ trans('Info') }}</th>
                            <th class="text-center" style="width: 200px;">{{ trans('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($maintenances = json_decode($data->maintenance ?? '[]'))
                        @foreach($maintenances as $maintenance)
                            <tr>
                                <td class="date">{{ $maintenance->date }}</td>
                                <td class="info">{{ $maintenance->info }}</td>
                                <th class="text-center">
                                    <button type="button" class="btn btn-primary btn-update-maintenance" data-bs-toggle="modal" data-bs-target="#modal-add-maintenance" >
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger text-white btn-remove-maintenance">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal-add-maintenance" class="btn btn-info text-white" id="btn-add-maintenance">{{ trans('Add') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-add-maintenance" tabindex="-1" aria-labelledby="modal-add-maintenance-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" id="form-add-maintenance">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modal-add-maintenance-label">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="date">{{ trans('Date') }}</label>
                            <input type="hidden" name="maintenance[date]" required id="date-hidden" autocomplete="off" class="form-control date">
                            <input type="text" name="maintenance[date]" required id="date" autocomplete="off" class="form-control date">
                        </div>
                        <div class="form-group">
                            <label for="info">{{ trans('Info') }}</label>
                            <textarea name="maintenance[info]" id="info" required class="form-control" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
		$(document).ready(function () {
			const tableMaintenance = $('#table-maintenance');
			$(document).on('submit', '#form-add-maintenance', function (e) {
				e.preventDefault();
				const data = $(this).serialize();
				$.ajax({
					url: '{{ route('post.order.sold_product_detail', $data->id) }}',
					data: data,
					method: 'post'
				}).done(function (response) {
					window.location.reload();
				});
			});

			$(document).on('click', '#btn-add-maintenance', function () {
				const form = $('#form-add-maintenance');
				form.find('#date').removeAttr('disabled');
				form.find('#date').val("");
				form.find('#info').val("");
			});

			$(document).on('click', '.btn-update-maintenance', function () {
				const date = $(this).parents('tr').find('.date').html();
				const info = $(this).parents('tr').find('.info').html();
				const form = $('#form-add-maintenance');
				form.find('#date').attr('disabled', 'disabled');
				form.find('#date').val(date);
				form.find('#date-hidden').val(date);
				form.find('#info').val(info);
            });

			$(document).on('click', '.btn-remove-maintenance', function () {
				if(confirm('Are you sure?')) {
					const date = $(this).parents('tr').find('.date').html();
					$.ajax({
						url: '{{ route('post.order.sold_product_detail', $data->id) }}',
						data: {
							maintenance_remove: date
						},
						method: 'post'
					}).done(function (response) {
						window.location.reload();
					});
                }
			});
		});
    </script>
@endpush