<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateCompanyRequest extends Request
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
            'huri_company_name' => 'required',
            'company_name' => 'required'
        ];
    }
}
