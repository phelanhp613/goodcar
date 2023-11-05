@php use Modules\Base\Models\Status; @endphp
@php use Carbon\Carbon; @endphp
@extends("Base::backend.master")
@section("content")
    <input type="hidden" id="current-route">
    <div id="role-module" class="container">
        <div class="row page-titles mb-4">
            <div class="col-5 align-self-center">
                <h5 class="title">{{ trans('Role') }}</h5>
            </div>
            <div class="col -7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb fs-7">
                        <li class="breadcrumb-item"><a href="/admin">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('Role') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!--Search box-->
        @include('Role::_search')
        <div class="listing">
            <div class="card">
                <div class="card-body">
                    <div class="d-block d-md-flex justify-content-between align-items-center">
                        <div class="sumary">
                            {!! summaryListing($data) !!}
                        </div>
                        <div class="mb-3">
                            @can('role-create')
                                <a href="{{ route("get.role.create") }}" class="btn btn-info text-white"
                                   data-bs-toggle="modal" data-bs-target="#form-modal" data-title="{{ trans('Create Role') }}">
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
                                <th>{{ trans('Name') }}</th>
                                <th>{{ trans('Status') }}</th>
                                <th>{{ trans('Created At') }}</th>
                                <th>{{ trans('Updated At') }}</th>
                                <th class="action">{{ trans('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($key = ($data->currentpage()-1)*$data->perpage()+1)
                            @foreach($data as $item)
                                <tr>
                                    <td><span class="number">{{$key++}}</span></td>
                                    <td>{{ trans($item->name) }}</td>
                                    <td>{{ Status::getStatus($item->status) ?? null }}</td>
                                    <td>{{ Carbon::parse($item->created_at)->format('d-m-Y H:i:s')}}</td>
                                    <td>{{ Carbon::parse($item->updated_at)->format('d-m-Y H:i:s')}}</td>
                                    <td class="link-action">
                                        @if(!in_array($item->name, ["Administrator"]))
                                            @can('role-update')
                                            <a href="{{ route("get.role.update", $item->id) }}" class="btn btn-primary"
                                               data-bs-toggle="modal" data-bs-target="#form-modal" data-title="{{ trans('Create Role') }}">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                            @endcan
                                            @can('role-delete')
                                            <a href="{{ route('get.role.delete',$item->id) }}" class="btn btn-danger btn-delete text-white">
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
    {!! getModal(['class' => 'modal-ajax']) !!}
@endsection
