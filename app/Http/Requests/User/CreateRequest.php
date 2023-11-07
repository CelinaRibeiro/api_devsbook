<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|min:6',
            'name' => 'required|max:100|string',
            'birthdate' => 'required|date',
            'city' => 'nullable|max:100|string',
            'work' => 'nullable|max:100|string',
            'avatar' => 'required|max:100|string',
            'cover' => 'required|max:100|string',
            'token' => 'nullable|max:200|string',
        ];
    }

     //validation error
     protected function failedValidation(Validator $validator): void
     {
         throw new HttpResponseException(response()->json(
             [
                 'error' => array_values($validator->errors()->getMessages())[0][0]
             ]
         ));   
     }
}
