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
                        <li class="breadcrumb-item"><a href="{{ route('get.product.list') }}">{{ trans('Product') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ trans('Update') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="pb-4">
            <h4 class="mb-2">
                {{ trans('Update Product') }}: {{ $data->name ?? "" }}
                <a href="{{ route("get.product.view", $data->id) }}" class="btn btn-warning text-white ms-2" target="_blank">
                    <i class="fa-solid fa-eye"></i> {{ trans('View') }}
                </a>
            </h4>
            <div class="mb-3">
                <a class="text-primary fs-5" href="{{ route('frontend.redirect_to_page', $data->slug) }}" target="_blank">
                    <u>{{ $data->name }}</u>
                </a>
            </div>
            @include('Product::product._form')
        </div>
    </div>
@endsection
