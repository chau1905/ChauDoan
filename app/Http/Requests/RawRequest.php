<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RawRequest extends FormRequest
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
            'price' => 'required|integer|min:1000',
            'quantity' => 'required|integer|min:1',
            'unit' => 'required|string',
            'category' => 'required|integer',
            'name' => 'required|string|min:2|max:100',
            'desc' => 'required|string|min:2|max:400'
        ];
    }
}
