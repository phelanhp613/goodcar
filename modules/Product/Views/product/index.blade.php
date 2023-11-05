@extends("Base::backend.master")
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datetimepicker/css/datetimepicker.min.css') }}">
@endpush
@section("content")
    <input type="hidden" id="current-route">
    <div id="role-module" class="container">
        <div class="row page-titles mb-4">
            <div class="col-5 align-self-center">
                <h5 class="title">{{ trans('Product') }}</h5>
            </div>
            <div class="col-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb fs-7">
                        <li class="breadcrumb-item"><a href="/admin">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('Product') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!--Search box-->
        @include('Product::product._search')
        <div class="listing">
            <div class="card">
                <div class="card-body">
                    <div class="d-block d-md-flex justify-content-between align-items-center">
                        <div class="sumary">
                            {!! summaryListing($data) !!}
                        </div>
                        <div class="mb-3">
                            @can('product-create')
                                <a href="{{ route("get.product.create") }}" class="btn btn-info text-white">
                                    {{ trans("Add New") }}
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>
                                    <span>{{ trans('Name') }}</span>
                                    <x-base::sort-icon route="get.product.list" column="name" direction="{{ (!empty(request()->column_asc) && request()->column_asc == 'name') ? 'asc' : 'desc'  }}"/>
                                </th>
                                <th>{{ trans('Slug') }}</th>
                                <th>
                                    <span>{{ trans('SKU') }}</span>
                                    <x-base::sort-icon route="get.product.list" column="sku" direction="{{ (!empty(request()->column_asc) && request()->column_asc == 'sku') ? 'asc' : 'desc'  }}"/>
                                </th>
                                <th>{{ trans('Category') }}</th>
                                <th>{{ trans('Product Type') }}</th>
                                <th class="text-center">{{ trans('Featured') }}</th>
                                <th style="width: 200px;">{{ trans('Updated At') }}</th>
                                <th class="action">{{ trans('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($key = ($data->currentpage()-1)*$data->perpage()+1)
                            @foreach($data as $item)
                                <tr>
                                    <td><span class="number">{{$key++}}</span></td>
                                    <td>
                                        <a class="text-primary" href="{{ route('frontend.redirect_to_page', $item->slug) }}" target="_blank">
                                            <u>{{ $item->name }}</u>
                                        </a>
                                    </td>
                                    <td>{{ $item->slug ?? "--"  }}</td>
                                    <td>{{ $item->sku }}</td>
                                    <td>{{ $item->category->name ?? "--"  }}</td>
                                    <td>{{ (!$item->has_variant) ? trans('Simple Product') : trans('Group Product')  }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('post.product.update_featured') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <input type="checkbox" name="featured" data-id="{{ $item->id }}" class="featured" @if($item->featured == 1) checked @endif aria-label="Featured">
                                        </form>
                                    </td>
                                    <td>{{ formatDate($item->updated_at,'d-m-Y H:i:s') }}</td>
                                    <td class="link-action">
                                        <a href="{{ route("get.product.view", $item->id) }}" class="btn btn-warning text-white" target="_blank">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        @can('product-update')
                                            <a href="{{ route("get.product.update", $item->id) }}" class="btn btn-primary">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                        @endcan
                                        @can('product-delete')
                                            <a href="{{ route('get.product.delete',$item->id) }}" class="btn btn-danger btn-delete text-white">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-5 pagination-style">
                            {{ $data->withQueryString()->render('vendor/pagination/default') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! getModal(['class' => 'modal-ajax modal-lg modal-dialog-scrollable']) !!}
@endsection
@push('js')
    <script src="{{ asset('assets/vendor/datetimepicker/js/datetimepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datetimepicker/js/datetimepicker_main.js') }}"></script>
    <script>
		$(document).ready(function () {
			$('.featured').on('change', function () {
				$(this).parent('form').submit();
			});
		});
    </script>
@endpush