<h1 class="fs-5">SEO</h1>
<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="meta_title" class="form-label">{{ trans('Meta Title') }}</label>
            <input type="text" name="meta_title" class="form-control meta-title" id="meta_title" value="{{ $data->meta_title ?? "" }}">
        </div>
        <div class="form-group">
            <label for="meta_description" class="form-label">{{ trans('Meta Description') }}</label>
            <textarea name="meta_description" id="meta_description" class="form-control" rows="6">{{ $data->meta_description ?? "" }}</textarea>
        </div>
        <div class="form-group">
            <label for="meta_keyword" class="form-label">{{ trans('Meta Keywords') }}</label>
            <textarea name="meta_keyword" id="meta_keyword" class="form-control" rows="6">{{ $data->meta_keyword ?? "" }}</textarea>
        </div>
        <div class="form-group">
            <label for="canonical" class="form-label">{{ trans('Canonical') }}</label>
            <input type="text" name="canonical" class="form-control" id="canonical" value="{{ $data->canonical ?? "" }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-label">{{ trans('SEO Preview') }}</label>
            <div class="seo-preview p-2 border" id="seo-preview"></div>
        </div>
    </div>
</div>
