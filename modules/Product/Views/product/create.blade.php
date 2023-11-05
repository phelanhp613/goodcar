@extends("Base::backend.master")
@section("content")
    <input type="hidden" id="current-route">
    <div id="product-module" class="container">
        <div class="row page-titles mb-4">
            <div class="col-5 align-self-center">
                <h5 class="title">{{ trans('Product') }}</h5>
            </div>
            <div class="col-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb fs-7">
                        <li class="breadcrumb-item"><a href="/admin">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('get.product.list') }}">{{ trans('Product') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('Create') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="pb-4">
            <h4>{{ trans('Create Product') }}</h4>
            @include('Product::product._form')
        </div>
    </div>
@endsection
