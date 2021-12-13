<?php

namespace App\Http\Requests\Product;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class Create extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Product name is mandatory',
            'quantity.required' => 'Product quantity is mandatory',
            'price.required' => 'Product price is mandatory',
            'quantity.numeric' => 'Product quantity must be numeric',
            'price.numeric' => 'Product price must be numeric',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->first();
        throw new HttpResponseException(response()->json($errors, 400));
    }
}
