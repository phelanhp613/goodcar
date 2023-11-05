@extends('Base::backend.master')
@section('content')
    <div class="admin-authentication">
        <div class="login-register vh-100 d-flex align-items-center justify-content-center" style="background-image:url('{{ asset('images/admin-background-login.jpg') }}');">
            <div class="login-box card">
                <div class="card-body">
                    <div class="container-fluid h-custom">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-md-9 col-lg-6 col-xl-6 my-lg-5 py-lg-5">
                                <img src="{{ asset('images/admin-image-login.webp') }}" class="img-fluid" alt="Sample image">
                            </div>
                            <div class="col-md-8 col-lg-6 col-xl-5 offset-xl-1 my-lg-5 py-lg-5">
                                <h3 class="box-title mb-4">{{ trans('Sign In') }}</h3>
                                @if (session()->has('danger'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session()->get('danger') }}
                                    </div>
                                @endif
                                <form action="" method="post">
                                    @csrf
                                    <div class="form-outline mb-4">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                            <label for="email">{{ trans('Email') }}</label>
                                        </div>
                                    </div>
                                    <div class="form-outline mb-3">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="password" name="password">
                                            <label for="password">{{ trans('Password') }}</label>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('admin.get.forgot_password') }}" class="text-body text-decoration-underline text-primary">{{ trans('Forgot password?') }}</a>
                                    </div>
                                    <div class="text-center text-lg-start mt-4 pt-2">
                                        <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
