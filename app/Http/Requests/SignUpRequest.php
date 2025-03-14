<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email_address' => 'required|email|unique:users,email_address',
            'username' => 'required|min:6|alpha_dash|unique:users,username',
            'password' => 'required|min:8|alpha_num|same:confirm_password',
            'confirm_password' => 'required',
            'terms_of_use' => 'required'
        ];
    }
}
