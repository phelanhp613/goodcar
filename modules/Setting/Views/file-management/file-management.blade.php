@extends("Base::backend.master")

@section('content')
    <div class="container">
        <div class="row page-titles mb-4">
            <div class="col-md-5 align-self-center">
                <h4 class="title">{{ trans('File Management') }}</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('File Management') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div id="elfinder" style="height: 75vh"></div>
    </div>
@endsection
