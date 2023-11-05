@php use Modules\Setting\Models\PaymentConfig; @endphp@extends("Base::backend.master")

@section("content")
    <div id="role-module" class="container">
        <div class="row page-titles mb-4">
            <div class="col-md-5 align-self-center">
                <h4 class="title">{{ trans('Payment Config') }}</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('get.setting.list') }}">{{ trans('Setting') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ trans('Payment Config') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div id="setting">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="fs-5">{{ 'Bank Information' }}</h1>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">{{ trans('Bank name') }}</label>
                                    <input type="text" id="name" name="{{ PaymentConfig::BANK_NAME }}" value="{{ $config[PaymentConfig::BANK_NAME] ?? '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="name">{{ trans('Bank account name') }}</label>
                                    <input type="text" id="account_name" name="{{ PaymentConfig::BANK_ACCOUNT_NAME }}" value="{{ $config[PaymentConfig::BANK_ACCOUNT_NAME] ?? '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="name">{{ trans('Bank account number') }}</label>
                                    <input type="text" id="account_number" name="{{ PaymentConfig::BANK_ACCOUNT_NUMBER }}" value="{{ $config[PaymentConfig::BANK_ACCOUNT_NUMBER] ?? '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info text-white me-2">{{ trans('Save') }}</button>
                                    <button type="reset" class="btn btn-outline-dark">{{ trans('Reset') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
