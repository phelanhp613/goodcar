<?php

namespace Modules\Role\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Requests\FormRequestBase;
use Modules\Role\Models\Role;

class RoleRequest extends FormRequestBase
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
        $segment = segmentUrl(2);
        $table = (new Role())->getTable();
        switch ($segment) {
            default:
                return [
                    'name'   => [
                        "required",
                        Rule::unique($table, 'name')->withoutTrashed(),
                    ],
                    'status' => 'required',
                ];
            case 'update':
                return [
                    'name'   => [
                        "required",
                        Rule::unique($table, 'name')->whereNot('id', $this->id)->withoutTrashed(),
                    ],
                    'status' => 'required',
                ];
        }
    }

    public function messages()
    {
        return [
            'required'        => ':attribute ' . trans('can not be empty.'),
            'unique' => ':attribute ' . trans('was exist.'),
        ];
    }

    public function attributes()
    {
        return [
            'name'        => trans('Role name'),
            'status'      => trans('Status'),
            'description' => trans('Description'),
        ];
    }
}
