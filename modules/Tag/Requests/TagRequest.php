<?php

namespace Modules\Tag\Requests;

use Modules\Base\Requests\FormRequestBase;

class TagRequest extends FormRequestBase
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
        if ($segment == "update") {
            return [
                'name' => 'required|max:30|unique:tags,name,' . $this->id,
            ];
        }

        return [
            'name' => 'required|max:30|unique:tags,name',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute ' . trans('can not be empty.'),
            'unique'   => ':attribute ' . trans('was exist.'),
            'max'      => ':attribute ' . trans('must not be greater than') . ' :max ' . trans('characters.'),
        ];
    }

    public function attributes()
    {
        return [
            'name'    => trans('Name'),
        ];
    }
}
