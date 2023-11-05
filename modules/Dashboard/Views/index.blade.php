@extends("Base::backend.master")
@push('css')
    <style>
        body {
            background-image: url("{{ asset('images/admin-background.jpg') }}");
	        background-repeat: no-repeat;
	        background-size: cover;
            height: 100vh;
        }
    </style>
@endpush
@section("content")
    <div class="container">
        <div class="d-flex justify-content-center w-100 p-5">
            <div class="welcome-box text-center p-5 border border-3 rounded-4 border-primary text-info">
                <h1>Hello, <span class="text-success">{{ auth()->user()->name }}</span></h1>
                <h2>Wellcome to Administration System!</h2>
            </div>
        </div>
    </div>
@endsection
