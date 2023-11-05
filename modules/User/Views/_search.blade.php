<div class="search-box mb-3">
    <div class="card">
        <div class="card-header bg-white">
            <div class="fw-semibold">{{ trans("Search") }}</div>
        </div>
        <div class="card-body" id="form-search-box">
            <form action="" method="get">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="text-input">{{ trans("Name") }}</label>
                            <input type="text" class="form-control" id="text-input" name="name"
                                   value="{{ $filter['name'] ?? null}}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ trans('Role') }}</label>
                            {!! Form::select('role_id', $prompt + $roles, $filter['role_id'] ?? NULL, ['class' => 'select2 form-control', 'style' => 'width:"100%"']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ trans('Status') }}</label>
                            {!! Form::select('status', $prompt + $statuses, $filter['status'] ?? NULL, ['class' => 'select2 form-control', 'style' => 'width:"100%"']) !!}
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-info text-white me-2">{{ trans("Search") }}</button>
                    <a href="{{ route('get.user.list') }}" class="btn btn-outline-dark">{{ trans("Reset") }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
