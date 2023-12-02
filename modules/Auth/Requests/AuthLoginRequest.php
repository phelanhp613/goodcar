<?php

namespace Modules\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'email'             => 'required|email',
            'password'          => 'required',
        ];
    }

    public function messages(){
        return [
            'required'          => ':attribute ' . trans('can not be empty.'),
            'email'             => ':attribute ' . trans('must be the email.'),
        ];
    }

    public function attributes(){
        return [
            'email'             => trans('Email'),
            'password'          => trans('Password'),
        ];
    }
}
