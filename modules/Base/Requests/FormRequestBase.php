<?php

namespace Modules\Base\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestBase extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    protected function passedValidation()
    {
        $this->offsetUnset('proengsoft_jsvalidation');
    }
}
