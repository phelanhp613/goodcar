@php use Modules\Role\Models\Role; @endphp
@extends("Base::backend.master")

@section("content")
    <div id="permission-module" class="container">
        <div class="row page-titles mb-4">
            <div class="col-md-5 align-self-center">
                <h5 class="title">{{ trans("Access Control") }}</h5>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb fs-7">
                        <li class="breadcrumb-item"><a href="/admin">{{ trans("Home") }}</a></li>
                        <li class="breadcrumb-item active">{{ trans("Permission") }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="listing">
            <form action="" method="post">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped  table-hover access-control">
                                <thead>
                                <tr>
                                    <th width="50px">#</th>
                                    <th>{{ trans('Name') }}</th>
                                    @foreach($roles as $role)
                                        <th class="text-center">{{ trans($role->name) }}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $key = 1;
									$adminRole = Role::getAdminRole();
                                @endphp
                                @foreach($permissions as $permission)
                                    @if($permission->parent_id === 0)
                                        <tr>
                                            <td>{{ $key++ }}</td>
                                            <td>
                                                <div style="font-weight: 600;">{{ trans($permission->display_name) }}</div>
                                            </td>
                                            @foreach($roles as $role)
                                                <td style="text-align: center;">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"
                                                               name='role_permission[{{$role->id}}][]'
                                                               value="{{ $permission->id }}"
                                                               @if(!empty($permissionRoles[$role->id]) && in_array($permission->id, $permissionRoles[$role->id])) checked @endif
                                                               @if($adminRole->id === $role->id) disabled @endif
                                                               class="custom-control-input checkbox-item select-all"
                                                               id="role-{{ $permission->id }}-{{ $role->id }}">
                                                        <label class="custom-control-label" for="role-{{ $permission->id }}-{{ $role->id }}"></label>
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>
                                        @if(!empty($permission->child))
                                            @foreach($permission->child as $child)
                                                <tr>
                                                    <td>{{ $key++ }}</td>
                                                    <td>
                                                        <div class="ml-2">- {{ trans($child->display_name) }}</div>
                                                    </td>
                                                    @foreach($roles as $role)
                                                        <td style="text-align: center;">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox"
                                                                       name='role_permission[{{$role->id}}][]'
                                                                       value="{{ $child->id }}"
                                                                       @if(!empty($permissionRoles[$role->id]) && in_array($permission->id, $permissionRoles[$role->id])) checked @endif
                                                                       @if($adminRole->id === $role->id) disabled @endif
                                                                       class="custom-control-input checkbox-item role-{{ $permission->id }}-{{ $role->id }}"
                                                                       id="role-{{ $child->id }}-{{ $role->id }}">
                                                                <label class="custom-control-label" for="role-{{ $child->id }}-{{ $role->id }}"></label>
                                                            </div>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="btn-group mt-3">
                            <button type="submit" class="btn btn-info text-white">{{ trans('Save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
