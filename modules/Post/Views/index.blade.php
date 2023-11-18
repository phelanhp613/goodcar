@php use Modules\Base\Models\Status; @endphp
@php use Carbon\Carbon; @endphp
@extends("Base::backend.master")
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
                    <li class="breadcrumb-item active">{{ trans('Post') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!--Search box-->
    @include('Post::_search')
    <div class="listing">
        <div class="card">
            <div class="card-body">
                <div class="d-block d-md-flex justify-content-between align-items-center">
                    <div class="sumary">
                        {!! summaryListing($data) !!}
                    </div>
                    <div class="mb-3">
                        @can('post-create')
                            <a href="{{ route("get.post.create") }}" class="btn btn-info text-white">
                                {{ trans("Add New") }}
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tiêu đề bài viết</th>
                            <th>{{ trans('Slug') }}</th>
                            <th>{{ trans('Status') }}</th>
                            <th>{{ trans('Category') }}</th>
                            <th class="action">{{ trans('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($key = ($data->currentpage()-1)*$data->perpage()+1)
                        @foreach($data as $item)
                            <tr>
                                <td><span class="number">{{$key++}}</span></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->slug ?? "--"   }}</td>
                                <td>{{ Status::getStatus($item->status) ?? null }}</td>
                                <td>{{ $item->post_category }}</td>
                                <td class="link-action">
                                    @if(!in_array($item->name, ["Administrator"]))
                                        @can('post-update')
                                        <a href="{{ route("get.post.update", $item->id) }}" class="btn btn-primary">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        @endcan
                                        @can('post-delete')
                                        <a href="{{ route('get.post.delete',$item->id) }}" class="btn btn-danger btn-delete text-white">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                        @endcan
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-5 pagination-style">
                        {{ $data->withQueryString()->render('vendor/pagination/default') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
