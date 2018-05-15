<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookServiceRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:500',
            'phone' => 'required',
            'time' => 'required',
            'email' => 'required|email',
        ];
    }
}
