@extends("Base::backend.master")

@section("content")
    <div id="role-module">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="title">{{ trans('Stripe Config') }}</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('get.setting.list') }}">{{ trans('Setting') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ trans('Stripe Config') }}</li>
                    </ol>
                </div>
            </div>
        </div>

        <div id="head-page" class="mb-3 d-flex justify-content-end group-btn">
            <a href="{{ route('get.setting.list') }}" class="btn btn-info text-white">{{ trans('Go Back') }}</a>
        </div>
    </div>

    <div id="user" class="card">
        <div class="card-body">
            <form action="" method="post" id="role-form">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="STRIPE_PUBLISHABLE_KEY">{{ trans('Publishable Key') }}</label>
                            <input type="text" class="form-control" id="STRIPE_PUBLISHABLE_KEY"
                                   name="{{ \Modules\Setting\Models\StripeConfig::STRIPE_PUBLISHABLE_KEY }}"
                                   value="{{ $stripe_config[\Modules\Setting\Models\StripeConfig::STRIPE_PUBLISHABLE_KEY] ?? NULL}}">
                        </div>
                        <div class="form-group">
                            <label for="STRIPE_SECRET_KEY">{{ trans('Secret Key') }}</label>
                            <input type="text" class="form-control" id="STRIPE_SECRET_KEY"
                                   name="{{ \Modules\Setting\Models\StripeConfig::STRIPE_SECRET_KEY }}"
                                   value="{{ $stripe_config[\Modules\Setting\Models\StripeConfig::STRIPE_SECRET_KEY]  ?? NULL }}">
                        </div>
                    </div>
                    <div class="input-group mt-5 d-flex justify-content-between">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-info text-white me-2">{{ trans('Save') }}</button>
                            <button type="reset" class="btn btn-default">{{ trans('Reset') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
