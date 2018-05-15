<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MergeOrderRequest extends FormRequest
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
            'table' => 'required|integer',
            'id_order' => 'required|integer',
        ];
    }
}
