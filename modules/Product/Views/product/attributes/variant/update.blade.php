@extends("Base::backend.master")@php(($prompt = ['' => trans('Select')]))
@section("content")
    <div id="product-variant" class="container">
        <div class="row page-titles mb-4">
            <div class="col-5 align-self-center">
                <h5 class="title">{{ trans('Product Variant') }}</h5>
            </div>
            <div class="col-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb fs-7">
                        <li class="breadcrumb-item"><a href="/admin">{{ trans('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('get.product.list') }}">{{ trans('Product') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('get.product.update', $data->product->id ?? NULL) }}">{{ $data->product->name ?? "" }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('get.product_variant.list', $data->product->id ?? NULL) }}">{{ trans('Versions') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $data->name ?? "" }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="pb-4">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h5>{{ $data->name }}</h5>
                    <x-base::gallery-button/>
                </div>
                <div class="card-body">
                    <form action="" method="post" id="product-variant-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="name" class="form-label">{{ trans('Name') }}</label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{ $data->name ?? old('name') }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="slug" class="form-label">{{ trans('Slug') }}</label>
                                        <input type="text" name="slug" class="form-control" id="slug" value="{{ $data->slug ?? old('slug') }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="sku" class="form-label">{{ trans('SKU') }}</label>
                                        <input type="text" name="sku" class="form-control" id="sku" value="{{ $data->sku ?? old('sku') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="price" class="form-label">{{ trans('Price') }}</label>
                                        <input type="text" name="price" class="form-control" id="price" value="{{ $data->price ?? old('price') }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="discount" class="form-label">{{ trans('Discount') }}</label>
                                        <input type="text" name="discount" class="form-control" id="discount" value="{{ $data->discount ?? old('discount') }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="stock" class="form-label">{{ trans('Stock') }}</label>
                                        <input type="text" name="stock" class="form-control" id="stock" value="{{ $data->stock ?? old('stock') }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="quantity_sold" class="form-label">{{ trans('Quantity Sold') }}</label>
                                        <input type="text" name="quantity_sold" class="form-control" id="quantity_sold" value="{{ $data->quantity_sold ?? old('quantity_sold') }}">
                                    </div>
                                    {{--<div class="col-md-8 form-group">
                                        <label for="suggest-products" class="form-label">{{ trans('Suggest Products') }}</label>
                                        @php($suggest_product_ids = json_decode($data->suggest_product_ids ?? '[]', 1))
                                        <x-base::autocomplete-field name="suggest_product_ids[]" id="suggest_products" action="{{ route('get.product_variant.find') }}" :options="$suggestProducts ?? []" :selected-options="$suggest_product_ids" :multiple="true"/>
                                    </div>--}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="image" class="form-label">{{ trans('Image') }}</label>
                                    <x-base::image-input id="image" name="images[main]" value="{{ getMainImage($data->images ?? '') ?? '' }}"/>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="py-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="mb-3">{{ trans('Attribute') }}</h5>
                                    @if(!empty($data->attributes))
                                        <table class="table table-bordered">
                                            @foreach($data->attributes as $key => $attribute)
                                                <tr>
                                                    <td style="width: 150px">
                                                        <label>{{ $attribute->name }}</label>
                                                    </td>
                                                    <td>{{ $attribute->pivot->value }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-3">{{ trans('Specification') }}</h5>
                                    <div class="form-group">
                                        <label for="engine" class="form-label">{{ trans('Engine') }}</label>
                                        <input type="text" name="engine" class="form-control" id="engine" value="{{ $data->engine ?? old('engine') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="power" class="form-label">{{ trans('Power') }}</label>
                                        <input type="text" name="power" class="form-control" id="power" value="{{ $data->power ?? old('power') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="drive_system" class="form-label">{{ trans('Drive System') }}</label>
                                        <input type="text" name="drive_system" class="form-control" id="drive_system" value="{{ $data->drive_system ?? old('drive_system') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-info text-white me-2">{{ trans('Save') }}</button>
                            <button type="reset" class="btn btn-outline-dark">{{ trans('Reset') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(!empty($data))
        <x-base::gallery :images="$data->images" action="{{ route('post.product_variant.add_image', $data->id) }}"/>
    @endif
@endsection
