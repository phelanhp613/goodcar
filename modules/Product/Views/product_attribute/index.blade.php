@extends("Base::backend.master")
@section("content")
    <input type="hidden" id="current-route">
    <div id="role-module" class="container">
        <div class="row page-titles mb-4">
            <div class="col-5 align-self-center">
                <h5 class="title">{{ trans('Product Attribute') }}</h5>
            </div>
            <div class="col -7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb fs-7">
                        <li class="breadcrumb-item"><a href="/admin">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('Product Attribute') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!--Search box-->
        @include('Product::product_attribute._search')
        <div class="listing">
            <div class="card">
                <div class="card-body">
                    <div class="d-block d-md-flex justify-content-between align-items-center">
                        <div class="sumary">
                            {!! summaryListing($data) !!}
                        </div>
                        <div class="mb-3">
                            @can('product-attribute-create')
                                <a href="{{ route("get.product_attribute.create") }}" class="btn btn-info text-white"
                                   data-bs-toggle="modal" data-bs-target="#form-modal" data-title="{{ trans('Create Product Attribute') }}">
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
                                <th>{{ trans('Values') }}</th>
                                <th>{{ trans('Description') }}</th>
                                <th class="action">{{ trans('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($key = ($data->currentpage()-1)*$data->perpage()+1)
                            @foreach($data as $item)
                                <tr>
                                    <td><span class="number">{{$key++}}</span></td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ implode(', ', $item->children->pluck('name')->toArray()) }}</td>
                                    <td>{{ $item->description ?? '' }}</td>
                                    <td class="link-action">
                                        @can('product-attribute-update')
                                        <a href="{{ route("get.product_attribute.update", $item->id) }}" class="btn btn-primary"
                                           data-bs-toggle="modal" data-bs-target="#form-modal" data-title="{{ trans('Update Product Attribute') }}">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        @endcan
                                        @can('product-attribute-delete')
                                        <a href="{{ route('get.product_attribute.delete',$item->id) }}" class="btn btn-danger btn-delete text-white">
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
    {!! getModal(['class' => 'modal-ajax']) !!}
@endsection
