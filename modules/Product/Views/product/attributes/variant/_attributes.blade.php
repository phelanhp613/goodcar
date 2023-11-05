@php
    $variants = !empty($data) ? $data->variants : [];
@endphp
<div class="product-variants">
    <h5>{{ trans('All Version') }}</h5>
    <div class="variant-list py-3">
        <div class="table-responsive">
            @if(!$variants->isEmpty())
                <table class="table">
                    <thead>
                    <tr>
                        <th style="min-width: 300px">{{ trans('Version') }}</th>
                        <th style="min-width: 150px">{{ trans('SKU') }}</th>
                        <th style="width: 200px">{{ trans('Price') }}</th>
                        <th style="width: 200px">{{ trans('Discount') }}</th>
                        <th style="width: 120px">{{ trans('Stock') }}</th>
                        @foreach($variants->first()->attributes as $id => $attribute)
                            <th style="min-width: 100px">{{ $attribute->name }}</th>
                        @endforeach
                        <th class="action">{{ trans('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($variants as $variant)
                        <tr>
                            <td><input type="text" name="variants[{{ $variant->id }}][name]" class="form-control" value="{{ $variant->name }}"></td>
                            <td><input type="text" name="variants[{{ $variant->id }}][sku]" min="0" class="form-control" value="{{ $variant->sku ?? $variant->product->sku }}"></td>
                            <td><input type="number" name="variants[{{ $variant->id }}][price]" min="0" class="form-control" value="{{ $variant->price ?? 0 }}"></td>
                            <td><input type="number" name="variants[{{ $variant->id }}][discount]" min="0" class="form-control" value="{{ $variant->discount ?? 0 }}"></td>
                            <td><input type="number" name="variants[{{ $variant->id }}][stock]" min="0" class="form-control" value="{{ $variant->stock  ?? 0}}"></td>
                            @foreach($variant->attributes as $attribute)
                                <td>{{ $attribute->pivot->value }}</td>
                            @endforeach
                            <td class="link-action">
                                <a href="{{ route('get.product_variant.update', $variant->id) }}" class="btn btn-info text-white">{{ trans('Detail') }}</a>
                                {{--<a href="{{ route('get.product_variant.delete', $variant->id) }}" class="btn btn-danger text-white">
                                    <i class="fa-solid fa-trash"></i>
                                </a>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>