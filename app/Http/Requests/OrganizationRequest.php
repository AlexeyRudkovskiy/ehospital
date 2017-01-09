<?php

namespace App\Http\Requests;

use App\Organization;
use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends PermissibleRequest
{

    protected $model = Organization::class;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $nameRule = 'required';
        if (getActionName(request()->route()->getName()) == 'store') {
            $nameRule .= '|unique:organizations';
        }
        return [
            'name' => $nameRule,
            'type' => "required|in:legal,private"
        ];
    }

}
