<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateOfficeManRequest extends Request
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
            'office_id' => 'required',
            'code' => 'required',
            'huri_office_man_name' => 'required',
            'office_man_name' => 'required',
            'v_index' => 'required',
            'v_status' => 'required'
        ];
    }
}
