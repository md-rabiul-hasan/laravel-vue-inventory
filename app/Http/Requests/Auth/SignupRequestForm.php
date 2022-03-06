<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class SignupRequestForm extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'required',
            'email'    => 'required|unique:users|max:255',
            'password' => 'required|confirmed'
        ];
    }

    /**
     * Get the error json response for the defined http response exception
     *
     * @return json
     */
    // public function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([
    //         'success' => false,
    //         'status'  => 400,
    //         'message' => $validator->errors()->first()
    //     ]));
    // }
}
