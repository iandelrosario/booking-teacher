<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsGeneralRequest extends FormRequest
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
            'username' => 'required|min:6|alpha_dash|unique:users,username,' . auth()->user()->id,
            'paypal_email_address' => 'required|email|unique:users,paypal_email_address,' . auth()->user()->id,
            'email_address' => 'required|email|unique:users,email_address,' . auth()->user()->id
        ];
    }
}
