<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {


        return [
            'article' => 'required|unique:products|regex:/(^[A-Za-z0-9 ]+$)+/',
            'name' => 'required|min:10',
            'status' => 'nullable',
            'data' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute должно быть заполненым',
            'min' => 'Поле :attribute содержит менее 10 символов',
            'unique' => 'Поле :attribute уже занято'
        ];

    }

    public function attributes()
    {
        return [
            'name' => 'название продукта',
            'article' => 'артикль'
        ];
    }
}
