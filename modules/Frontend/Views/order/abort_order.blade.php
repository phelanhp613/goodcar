@extends('Base::frontend.master')
@section('content')
    <div class="container">
        <div class="py-5 d-flex justify-content-center align-items-center my-5">
            <div class="card bg-white border-top border-5 border-primary border-start-0 border-end-0 border-bottom-0 shadow p-5">
                <div class="mb-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="75" height="75" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-center">
                        <h1 class="text-success">{{ trans('Order canceled successfully') }}!</h1>
                        <div class="fs-7 fs-md-5 mb-4">{{ trans('Now, you can come back to buy other producs') }}!</div>
                    </div>
                    <div class="text-center py-3">
                        <a href="{{ route('frontend.home') }}" class="btn btn-primary rounded-0">{{ trans('Back Home') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection