@php use Modules\Base\Models\Status; @endphp@php use Carbon\Carbon; @endphp@extends("Base::backend.master")
@section("content")
    <input type="hidden" id="current-route">
    <div id="post-module" class="container">
        <div class="row page-titles mb-4">
            <div class="col-5 align-self-center">
                <h5 class="title">{{ trans('Post') }}</h5>
            </div>
            <div class="col -7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb fs-7">
                        <li class="breadcrumb-item"><a href="/admin">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('get.post.list') }}">{{ trans('Post') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('Update') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="create-form">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ trans('Create Post') }}: {{ $data->name ?? null }}</h5>
                </div>
                <div class="card-body">
                    @include('Post::_form')
                </div>
            </div>
        </div>
    </div>
@endsection
