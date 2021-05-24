<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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


    protected function failedAuthorization()
    {
        if ($this->expectsJson()){
            throw new HttpResponseException(response()->json([
                'status' => 'Error',
                'message' => 'failedAuthorization'
            ], 422));
        }
    }

    
    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()){
            throw new HttpResponseException(response()->json([
                'status' => 'Error',
                'message' => $validator->errors()
            ], 422));
        } else {
            throw (new ValidationException($validator))
                ->errorBag($this->errorBag)
                ->redirectTo($this->getRedirectUrl());
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
        ];
    }
}
