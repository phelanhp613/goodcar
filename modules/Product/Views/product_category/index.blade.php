@extends("Base::backend.master")
@section("content")
    <input type="hidden" id="current-route">
    <div id="role-module" class="container">
        <div class="row page-titles mb-4">
            <div class="col-5 align-self-center">
                <h5 class="title">{{ trans('Product Category') }}</h5>
            </div>
            <div class="col-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb fs-7">
                        <li class="breadcrumb-item"><a href="/admin">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('Product Category') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!--Search box-->
        @include('Product::product_category._search')
        <div class="listing">
            <div class="card">
                <div class="card-body">
                    <div class="d-block d-md-flex justify-content-between align-items-center">
                        <div class="sumary">
                            {!! summaryListing($data) !!}
                        </div>
                        <div class="mb-3">
                            @can('product-category-create')
                                <a href="{{ route("get.product_category.create") }}" class="btn btn-info text-white">
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
                                <th>{{ trans('Name') }}</th>
                                <th>{{ trans('Image') }}</th>
                                <th>{{ trans('Slug') }}</th>
                                <th>{{ trans('Parent') }}</th>
                                <th>{{ trans('Type') }}</th>
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
                                    <th><img src="{{ env('APP_URL') . $item->image }}" alt="" width="100"></th>
                                    <td>{{ $item->slug ?? "" }}</td>
                                    <td>{{ $item->parent->name ?? '--'  }}</td>
                                    <td>{{ $item->type == 'brand' ? trans('Brand') : '--' }}</td>
                                    <td class="link-action">
                                        <a href="{{ route("get.product_category.view", $item->id) }}" class="btn btn-warning text-white" target="_blank">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        @can('product-category-update')
                                            <a href="{{ route("get.product_category.update", $item->id) }}" class="btn btn-primary">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                        @endcan
                                        @can('product-category-delete')
                                            <a href="{{ route('get.product_category.delete',$item->id) }}" class="btn btn-danger btn-delete text-white">
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
@endsection
