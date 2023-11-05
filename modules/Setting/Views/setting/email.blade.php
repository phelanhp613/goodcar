@extends("Base::backend.master")
@php
    use Modules\Setting\Models\MailConfig;
    use Modules\Role\Models\Role;
@endphp

@section("content")
    <div id="setting-module" class="container">
        <div class="row page-titles mb-4">
            <div class="col-md-5 align-self-center">
                <h4 class="title">{{ trans('Email Config') }}</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('get.setting.list') }}">{{ trans('Setting') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ trans('Email Config') }}</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="" method="post" id="role-form">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="MAIL_HOST">{{ trans('Host') }}</label>
                                <input type="text" class="form-control" id="MAIL_HOST" name="{{ MailConfig::MAIL_HOST }}" value="{{ $mail_config[MailConfig::MAIL_HOST] ?? NULL}}">
                            </div>
                            <div class="form-group">
                                <label for="MAIL_PORT">{{ trans('Port') }}</label>
                                <input type="text" class="form-control" id="MAIL_PORT" name="{{ MailConfig::MAIL_PORT }}" value="{{ $mail_config[MailConfig::MAIL_PORT]  ?? NULL }}">
                            </div>
                            <div class="form-group">
                                <label for="PROTOCOL">{{ trans('Protocol') }}</label>
                                <input type="text" class="form-control" id="PROTOCOL" name="{{ MailConfig::PROTOCOL }}" value="{{ $mail_config[MailConfig::PROTOCOL]  ?? NULL }}">
                            </div>
                            <div class="form-group">
                                <label for="MAIL_USERNAME">{{ trans('Username') }}</label>
                                <input type="text" class="form-control" id="MAIL_USERNAME" name="{{ MailConfig::MAIL_USERNAME }}" value="{{ $mail_config[MailConfig::MAIL_USERNAME]  ?? NULL }}">
                            </div>
                            <div class="form-group">
                                <label for="MAIL_PASSWORD">{{ trans('Password') }}</label>
                                <input type="password" class="form-control" id="MAIL_PASSWORD" name="{{ MailConfig::MAIL_PASSWORD }}" value="{{ $mail_config[MailConfig::MAIL_PASSWORD]  ?? NULL }}">
                            </div>
                            <div class="form-group">
                                <label for="MAIL_DRIVER">{{ trans('SMTP Server') }}</label>
                                <input type="text" class="form-control" id="MAIL_DRIVER" name="{{ MailConfig::MAIL_DRIVER }}" value="{{ $mail_config[MailConfig::MAIL_DRIVER]  ?? NULL }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="MAIL_ADDRESS">{{ trans('Email from address') }}</label>
                                <input type="text" class="form-control" id="MAIL_ADDRESS" name="{{ MailConfig::MAIL_ADDRESS }}" value="{{ $mail_config[MailConfig::MAIL_ADDRESS]  ?? NULL }}">
                            </div>
                            <div class="form-group">
                                <label for="MAIL_NAME">{{ trans('Email from name') }}</label>
                                <input type="text" class="form-control" id="MAIL_NAME" name="{{ MailConfig::MAIL_NAME }}" value="{{ $mail_config[MailConfig::MAIL_NAME]  ?? NULL }}">
                            </div>
                            <div class="form-group">
                                <label for="MAIL_LIST">{{ trans('Email receive list') }}</label>
                                <textarea class="form-control" id="MAIL_LIST" name="{{ MailConfig::MAIL_LIST }}" rows="6">{{ $mail_config[MailConfig::MAIL_LIST]  ?? NULL }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mt-5 d-flex justify-content-between">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-info text-white me-2">{{ trans('Save') }}</button>
                            <button type="reset" class="btn btn-outline-dark">{{ trans('Reset') }}
                            </button>
                        </div>
                        @if(Auth::user()->role->id === Role::getAdminRole()->id)
                            <div>
                                <a href="{{ route("get.setting.testSendMail") }}" class="btn btn-primary">{{ trans('Test Send Mail') }}</a>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
