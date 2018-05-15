<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:45',
            'price' => 'required|integer|min:1000',
            'bonus' => 'nullable|integer',
            'time' => 'required|integer',
            'unit_time' => 'required|integer',
            'description' => 'required|string|min:2|max:1000',
            'image-service' => 'required|file|image|max:10240',
        ];
    }
}
