<?php

namespace Modules\Product\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Requests\FormRequestBase;
use Modules\Product\Models\Product;

class ProductRequest extends FormRequestBase
{

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return TRUE;
	}

	public function rules()
	{
		$segment = segmentUrl(2);
		$table   = (new Product())->getTable();
		if (in_array($segment, ['update', 'add-attributes'])) {
			return [
				'name'                 => [
					'required',
					'max:255',
					Rule::unique($table, 'name')->whereNot('id', $this->id)->withoutTrashed(),
				],
				'sku'                  => [
					'required',
					'max:255',
					Rule::unique($table, 'sku')->whereNot('id', $this->id)->withoutTrashed(),
				],
				'product_category_id'  => 'required',
				'product_category_ids' => 'required',
				'meta_title'           => 'max:255',
				'meta_description'     => 'max:2000',
				'has_variant'          => 'required',
				'status'               => 'required',
			];
		}

		return [
			'name'                 => [
				'required',
				'max:255',
				Rule::unique($table, 'name')->withoutTrashed(),
			],
			'sku'                  => [
				'required',
				'max:255',
				Rule::unique($table, 'sku')->withoutTrashed(),
			],
			'product_category_id'  => 'required',
			'product_category_ids' => 'required',
			'meta_title'           => 'max:255',
			'meta_description'     => 'max:2000',
			'status'               => 'required',
			'has_variant'          => 'required',
		];
	}

	public function messages()
	{
		return [
			'required'        => ':attribute ' . trans('can not be empty.'),
			'unique'          => ':attribute ' . trans('was exist.'),
			'max'             => ':attribute ' . trans('must not be greater than') . ' :max ' . trans('characters.'),
			'status.required' => trans('Please select') . ' :attribute',
		];
	}

	public function attributes()
	{
		return [
			'name'                 => trans('Name'),
			'sku'                  => trans('SKU'),
			'product_category_id'  => trans('Main Category'),
			'product_category_ids' => trans('Category'),
			'status'               => trans('Status'),
			'meta_title'           => trans('Meta Title'),
			'meta_description'     => trans('Meta Description'),
			'has_variant'          => trans('Product Type'),
		];
	}
}
