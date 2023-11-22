@extends('Base::frontend.master')

@section('content') 
    <div class="container">
        <h1 class="text-center py-4">TIN TỨC</h1>
        <div class="row mb-5">
            @foreach ($posts as $item)
                <div class="col-md-4">
                    <a class="text-decoration-none" href="{{ route('frontend.redirect_to_page', $item->slug) }}">                    
                        <div class="card h-100">
                            <div class="ratio ratio-16x9">
                                <img src="{{ $item->images }}" class="card-img-top object-fit-cover w-100" alt="...">
                            </div>
                            <div class="card-body">
                                <div class="card-title fw-bold">{{ $item->name }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
   
@endsection