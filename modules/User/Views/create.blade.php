@extends("Base::backend.master")

@section("content")
    <div class="user-module container">
        <div class="row page-titles mb-4">
            <div class="col-md-5 align-self-center">
                <h4 class="title">{{ trans('User') }}</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('get.user.list') }}">{{ trans('User') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('Create') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-white">
                <h4 class="card-title">{{ trans('Create User') }}</h4>
            </div>
            <div class="card-body">
                @include('User::_form')
            </div>
        </div>
    </div>
@endsection
