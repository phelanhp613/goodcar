<?php

namespace Modules\Product\Requests;

use Modules\Base\Requests\FormRequestBase;

class ProductAttributeRequest extends FormRequestBase
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
		if ($segment == 'update') {
			return [
				'name'        => 'required|max:255',
				'description' => 'max:1000',
			];
		}

		return [
			'name'        => 'required|max:255',
			'description' => 'max:1000',
		];
	}

	public function messages()
	{
		return [
			'required' => ':attribute ' . trans('can not be empty.'),
		];
	}

	public function attributes()
	{
		return [
			'name'        => trans('Name'),
			'name[]'      => trans('Name'),
			'description' => trans('Description'),
		];
	}
}
