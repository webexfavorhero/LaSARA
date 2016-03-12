<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateCompanyManRequest extends Request
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
            'company_id' => 'required',
            'huri_company_man_name' => 'required',
            'company_man_name' => 'required'
        ];
    }
}
