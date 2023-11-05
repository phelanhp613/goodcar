<?php

namespace Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
		$method = segmentUrl(2);

		if($method == 'update' || $method == 'profile') {
			$id = !empty($this->id) ? $this->id : auth('admin')->id();
			return [
				'name'     => 'required',
				'username' => [
					"required",
					Rule::unique('users', 'username')->whereNot('id', $id)->withoutTrashed(),
				],
				'email'    => [
					"required",
					"email",
					Rule::unique('users', 'email')->whereNot('id', $id)->withoutTrashed(),
				],
				'phone'    => [
					"required",
					"digits:10",
					Rule::unique('users', 'phone')->whereNot('id', $id)->withoutTrashed(),
				],
				'status'   => 'required',
				'role_id'  => 'required',
				'password' => 'nullable|min:6|confirmed',
			];
		}

		return [
			'name'     => 'required',
			'username' => [
				"required",
				Rule::unique('users', 'username')->withoutTrashed(),
			],
			'email'    => [
				"required",
				"email",
				Rule::unique('users', 'email')->withoutTrashed(),
			],
			'phone'    => [
				"required",
				"digits:10",
				Rule::unique('users', 'phone')->withoutTrashed(),
			],
			'status'   => 'required',
			'role_id'  => 'required',
			'password' => 'required|min:6|confirmed',
		];
	}

	public
	function messages()
	{
		return [
			'required'         => ':attribute ' . trans('can not be empty.'),
			'unique'           => ':attribute ' . trans('was exist.'),
			'confirmed'        => ':attribute ' . trans('confirmation does not match.'),
			'email'            => ':attribute ' . trans('must be a valid email address.'),
			'digits'           => ':attribute ' . trans('must be') . ' :digits' . trans('digits.'),
			'min'              => ':attribute ' . trans('too short.'),
			'role_id.required' => trans('Please select') . ' :attribute',
		];
	}

	public
	function attributes()
	{
		return [
			'name'     => trans('Name'),
			'username' => trans('Username'),
			'email'    => trans('Email'),
			'phone'    => trans('Phone'),
			'password' => trans('Password'),
			'status'   => trans('Status'),
			'role_id'  => trans('Role'),
		];
	}
}
