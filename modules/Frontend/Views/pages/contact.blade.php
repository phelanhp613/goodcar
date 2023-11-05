@extends('Base::frontend.master')
@php
    pageSEO(
		(!empty($data->meta_title) ? $data->meta_title : trans('Contact')),
		(!empty($data->meta_description) ? $data->meta_description : trans('Contact Page')),
		(!empty($data->meta_keyword) ? $data->meta_keyword : trans('Contact Page')),
		(!empty($data->canonical) ? $data->canonical : request()->url())
	);
@endphp
@section('content')
    <div class="container mb-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs-md-6 fs-8">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ trans('Contact Us') }}</li>
            </ol>
        </nav>
        <div class="page-content d-flex w-100 justify-content-center py-3 py-md-5">
            <div>
                <h1 class="mb-4 text-center">Contact us</h1>
                <div class="border shadow p-2 p-md-5" style="width: 800px;">
                    <form action="" method="post" id="contact-form">
                        @csrf
                        @if(session()->has('send-success'))
                            <div class="alert alert-success" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-success bi bi-check-circle me-2" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                </svg>
                                <span>{{ session()->get('send-success') }}</span>
                            </div>
                        @endif
                        <div class="form-group mb-4">
                            <input type="text" name="name" class="form-control" placeholder="{{ trans('Name') }}" aria-label="{{ trans('Name') }}">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <input type="tel" name="phone" class="form-control" placeholder="{{ trans('Phone Number') }}" aria-label="{{ trans('Phone Number') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="{{ trans('E-mail') }}" aria-label="{{ trans('E-mail') }}">
                                </div></div>
                        </div>
                        <div class="form-group mb-4">
                            <textarea name="content" class="form-control rounded-0" rows="6" aria-label="{{ trans('Message') }}"></textarea>
                        </div>
                        <button class="btn btn-primary rounded-0 btn-block text-white w-md-30 w-100" type="submit">{{ trans('Send') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/vendor/jsvalidation/jsvalidation.min.js') }}"></script>
    {!! JsValidator::formRequest('Modules\Contact\Requests\ContactRequest','#contact-form') !!}
@endpush
