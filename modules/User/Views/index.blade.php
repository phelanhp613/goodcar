@extends("Base::backend.master")
@php
    use Modules\Role\Models\Role;
    use Carbon\Carbon;

    $prompt = ['' => trans('All')];
    $auth = auth('admin')->user();
    $adminRoleId = Role::getAdminRole()->id;
    $authIsAdmin = $auth->role_id == $adminRoleId;
@endphp
@section("content")
    <div id="user-module" class="user-module container">
        <div class="row page-titles mb-4">
            <div class="col-md-5 align-self-center">
                <h4 class="title">{{ trans('User') }}</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('User') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!--Search box-->
        @include('User::_search')
        <div class="listing">
            <div class="card">
                <div class="card-body">
                    <div class="d-block d-md-flex justify-content-between align-items-center">
                        <div class="sumary">
                            {!! summaryListing($data) !!}
                        </div>
                        <div class="mb-3">
                            <a href="{{ route("get.user.create") }}" class="btn btn-info text-white">
                                <i class="fa fa-plus"></i>&nbsp; {{ trans("Add New") }}
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('Name') }}</th>
                                <th>{{ trans('Username') }}</th>
                                <th>{{ trans('Phone') }}</th>
                                <th>{{ trans('Email') }}</th>
                                <th>{{ trans('Role') }}</th>
                                <th>{{ trans('Status') }}</th>
                                <th>{{ trans('Created At') }}</th>
                                <th class="action">{{ trans('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($key = ($data->currentpage()-1)*$data->perpage()+1)
                            @foreach($data as $item)
                                <tr>
                                    <td>{{$key++}}</td>
                                    <td>{{ trans($item->name) }}</td>
                                    <td>{{ trans($item->username) }}</td>
                                    <td>{{ trans($item->phone) }}</td>
                                    <td>{{ trans($item->email) }}</td>
                                    <td>{{ $roles[$item->role_id] ?? 'N/A' }}</td>
                                    <td><x-base::status status="{{ $item->status }}" /></td>
                                    <td>{{ Carbon::parse($item->created_at)->format('d-m-Y H:i:s')}}</td>
                                    <td class="link-action">
                                        @if($authIsAdmin || $auth->id === $item->id)
                                            <a href="{{ route('get.user.update',$item->id) }}" class="btn btn-primary">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                        @endif
                                        @if($auth->id !== $item->id && ($item->role_id !== $adminRoleId || $authIsAdmin))
                                            <a href="{{ route('get.user.delete',$item->id) }}"
                                               class="btn btn-danger btn-delete text-white"><i class="fa-solid fa-trash"></i></a>
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
