@extends("Base::backend.master")@php use Modules\Setting\Models\Website; @endphp
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
                        <li class="breadcrumb-item active">{{ trans('Website Config') }}</li>
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
                    <div class="content">
                        <div class="site-info">
                            <h1 class="fs-4 mb-3">{{ trans('Website Information') }}</h1>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="mb-2" for="WEBSITE_NAME">{{ trans('Site Name') }}</label>
                                    <input type="text" class="form-control" id="WEBSITE_NAME" name="{{ Website::WEBSITE_NAME }}" value="{{ $website_config[Website::WEBSITE_NAME] ?? null}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="mb-2" for="WEBSITE_NAME">{{ trans('Slogan') }}</label>
                                    <input type="text" class="form-control" id="WEBSITE_NAME" name="{{ Website::SLOGAN }}" value="{{ $website_config[Website::SLOGAN] ?? null}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="mb-2" for="LOGO">{{ trans('Logo Home') }}</label>
                                    <x-base::image-input id="LOGO" name="{{ Website::LOGO }}" value="{{$website_config[Website::LOGO] ?? '' }}"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="mb-2" for="FAVICON">{{ trans('Favicon') }}</label>
                                    <x-base::image-input id="FAVICON" name="{{ Website::FAVICON }}" value="{{$website_config[Website::FAVICON] ?? '' }}"/>
                                </div>
                            </div>
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
