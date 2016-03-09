<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateOfficeRequest extends Request
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
        return [
            'v_index' => 'required',
            'huri_office_name' => 'required',
            'office_name' => 'required'
        ];
    }
}
