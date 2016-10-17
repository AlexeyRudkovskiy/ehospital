<?php

namespace App\Http\Requests;

use App\Department;
use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends PermissibleRequest
{

    protected $model = Department::class;

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
