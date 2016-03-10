<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateItemRequest extends Request
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
            'huri_item_name' => 'required',
            'item_name' => 'required|max:8',
            'mark_color' => 'required',
            'other_cond' => 'required'
        ];
    }
}
