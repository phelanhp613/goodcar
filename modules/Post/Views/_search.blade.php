<div class="search-box mb-3">
    <div class="card">
        <div class="card-header bg-white" data-toggle="collapse" data-target="#form-search-box" aria-expanded="false"
             aria-controls="form-search-box">
            <div class="fw-semibold">{{ trans("Search") }}</div>
        </div>
        <div class="card-body collapse show" id="form-search-box">
            <form action="{{ route('get.post.list') }}" method="get">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="text-input"> Tên bài đăng </label>
                            <input type="text" class="form-control" id="text-input" name="name" value="{{ $filter['name'] ?? null}}">
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-info text-white me-2">{{ trans("Search") }}</button>
                    <a href="{{ route('get.post.list') }}" class="btn btn-outline-dark">{{ trans("Reset") }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
