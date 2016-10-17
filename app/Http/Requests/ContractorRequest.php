<?php

namespace App\Http\Requests;

use App\Contractor;
use Illuminate\Foundation\Http\FormRequest;

class ContractorRequest extends PermissibleRequest
{

    protected $model = Contractor::class;

    public $fields = [
        'name',
        'fullName',
        'type',
        'contractor_group_id',
        'edrpou',
        'description',
        'phone'
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'fullName' => 'required',
            'type' => 'required',
            'contractor_group_id' => 'required'
        ];
    }
}
