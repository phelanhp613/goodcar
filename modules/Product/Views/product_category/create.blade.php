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
                        <li class="breadcrumb-item"><a href="{{ route("get.product_category.list") }}">{{ trans('Product Category') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('Create') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-white">
                <h4>{{ trans('Create Product Category') }}</h4>
            </div>
            <div class="card-body">
                @include('Product::product_category._form')
            </div>
        </div>
    </div>

@endsection
