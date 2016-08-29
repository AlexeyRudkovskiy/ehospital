<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $passwordRule = '';
        if (getActionName(request()->route()->getName()) == 'store') {
            $passwordRule = 'required';
        }
        return [
            'firstName' => 'required',
            'lastName' => 'required',
            'middleName' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'password' => $passwordRule,
            'user_position_id' => 'required',
            'permission_id' => 'required',
            'organization_id' => 'required'
        ];
    }
}
