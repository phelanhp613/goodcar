<?php

namespace Modules\Product\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Requests\FormRequestBase;
use Modules\Product\Models\ProductCategory;

class ProductCategoryRequest extends FormRequestBase
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
		$segment = segmentUrl(3);
		$table   = (new ProductCategory)->getTable();

		if ($segment == 'update') {
			return [
				'name'             => [
					'required',
					'max:255',
					Rule::unique($table, 'name')->whereNot('id', $this->id)->withoutTrashed(),
				],
				'description'      => 'max:2000',
				'meta_title'       => 'max:255',
				'meta_description' => 'max:2000',
				'status'           => 'required',
			];
		}

		return [
			'name'             => [
				'required',
				'max:255',
				Rule::unique($table, 'name')->withoutTrashed(),
			],
			'description'      => 'max:2000',
			'meta_title'       => 'max:255',
			'meta_description' => 'max:2000',
			'status'           => 'required',
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
			'name'             => trans('Name'),
			'description'      => trans('Description'),
			'status'           => trans('Status'),
			'meta_title'       => trans('Meta Title'),
			'meta_description' => trans('Meta Description'),
		];
	}
}
