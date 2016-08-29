<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'name' => 'required',
            'leader_id' => 'required',
            'organization_id' => 'required',
            'department_code' => 'required',
            'beds_amount' => 'required',
            'beds_amount_in_repair' => 'required',
            'female_beds_amount' => 'required',
            'male_beds_amount' => 'required'
        ];
    }
}
