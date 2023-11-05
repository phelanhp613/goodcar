<?php

namespace Modules\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthMemberRequest extends FormRequest{

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
            'email'             => 'required|email|validate_unique:members',
            'password'          => 'required|min:6',
            'password_re_enter' => 're_enter_password|required_with:password',
        ];
    }

    public function messages(){
        return [
            'required'          => ':attribute ' . trans('can not be empty.'),
            'email'             => ':attribute ' . trans('must be the email.'),
            'min'               => ':attribute ' . trans('too short.'),
            're_enter_password' => trans('Wrong password'),
            'required_with'     => ':attribute ' . trans('can not be empty.'),
            'validate_unique'   => ':attribute ' . trans('was exist.'),
        ];
    }

    public function attributes(){
        return [
            'email'             => trans('Email'),
            'password'          => trans('Password'),
            'password_re_enter' => trans('Re-enter Password'),
        ];
    }
}
