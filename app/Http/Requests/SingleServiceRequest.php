<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SingleServiceRequest extends FormRequest
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
            // name = name & id اللي داخل = service_id
            "name" => 'required|unique:service_translations,name,'.$this->id.',service_id',
            'price' => 'numeric|required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.required'),
            'name.unique' => trans('validation.unique'),
            'price.required' => trans('validation.required'),
            'price.numeric' => trans('validation.numeric'),
        ];
    }
}