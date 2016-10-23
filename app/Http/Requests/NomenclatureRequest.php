<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NomenclatureRequest extends FormRequest
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
            'name_for_department' => 'required',
            'small_name' => 'required',
            'amount_in_a_package' => 'required',
            'nds' => 'required',
            'barcode' => 'required',
            'morion_code' => 'required',
            'base_unit_id' => 'required',
            'basic_unit_id' => 'required',
            'atc_classification_id' => 'required',
            'keep_records_by_series' => 'required'
        ];
    }
}
