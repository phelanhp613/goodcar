<?php

namespace Modules\Setting\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Requests\FormRequestBase;

class MenuRequest extends FormRequestBase
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$method = segmentUrl(3);
		if ($method == 'update') {
			return [
				'name' => 'required',
				'slug' => [
					"required",
					Rule::unique('menus', 'slug')->whereNot('id', $this->id),
				],
			];
		}

		return [
			'name' => 'required',
			'slug' => [
				"required",
				Rule::unique('menus', 'slug'),
			],
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
			'name' => trans('Name'),
			'slug' => trans('Key'),
		];
	}
}
