<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientInspectionRequest extends FormRequest
{

    public $fields = [
        'blood_group',
        'rh_factor',
        'blood_transfusions',
        'diabetes',
        'allergic_history'
    ];

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
            'blood_group' => 'required|numeric|max:4|min:1',
            'rh_factor' => 'required|boolean',
            'blood_transfusions' => 'required'
        ];
    }
}
