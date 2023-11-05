@extends("Base::backend.master")
@php use Modules\Setting\Models\Website; @endphp
@push('css')
    <style>
		.ace_editor {
			height: 300px;
			width: 100%;
		}
    </style>
@endpush
@section("content")
    <div id="role-module" class="container">
        <div class="row page-titles mb-4">
            <div class="col-md-5 align-self-center">
                <h4 class="title">{{ trans('Website Config') }}</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('get.setting.list') }}">{{ trans('Setting') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ trans('Zalo Notify Config') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="" method="post" id="role-form">
                    @csrf
                    <div class="input-group mb-3 d-flex justify-content-between">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-info text-white me-2">{{ trans('Save') }}</button>
                            <button type="reset" class="btn btn-outline-dark">{{ trans('Reset') }}
                            </button>
                        </div>
                    </div>
                    <div class="content row">
                        <div class="form-group col-md-6">
                            <label for="app-id">App ID</label>
                            <input type="text" class="form-control" name="app_id" id="app-id" value="{{ $config->app_id ?? '' }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="app-secret-key">App Secret Key</label>
                            <input type="text" class="form-control" name="app_secret_key" id="app-secret-key" value="{{ $config->app_secret_key ?? '' }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="template-id-order">Template ID Order</label>
                            <input type="text" class="form-control" name="template_id_order" id="template-id-order" value="{{ $config->template_id_order ?? '' }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="template-id-warranty">Template ID Warranty</label>
                            <input type="text" class="form-control" name="template_id_warranty" id="template-id-warranty" value="{{ $config->template_id_warranty ?? '' }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="access-token">Access Token</label>
                            <input type="text" class="form-control" name="access_token" id="access-token" value="{{ $config->access_token ?? '' }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="refresh-token">Refresh Token</label>
                            <input type="text" class="form-control" name="refresh_token" id="refresh-token" value="{{ $config->refresh_token ?? '' }}">
                        </div>
                    </div>
                    <div class="input-group mt-5 d-flex justify-content-between">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-info text-white me-2">{{ trans('Save') }}</button>
                            <button type="reset" class="btn btn-outline-dark">{{ trans('Reset') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
