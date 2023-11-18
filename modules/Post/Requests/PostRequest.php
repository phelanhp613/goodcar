<?php

namespace Modules\Post\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Requests\FormRequestBase;
use Modules\Post\Models\Post;

class PostRequest extends FormRequestBase
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
        $table = (new Post())->getTable();
        return [
            'name' => "required",
            'status' => "required",
            'images' => "required",
            'post_category' => "required",
            'description' => "required",
        ];
    }

    public function messages()
    {
        return [
            'required'        => ':attribute ' . trans('can not be empty.'),
        ];
    }

    public function attributes()
    {
        return [
            'name'        => trans('Post name'),
            'status'      => trans('Status'),
            'images'      => trans('Images'),
            'post_category'      => trans('Post Category'),
            'description'      => trans('Description'),
        ];
    }
}
