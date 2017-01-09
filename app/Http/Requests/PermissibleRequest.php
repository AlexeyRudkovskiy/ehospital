<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissibleRequest extends FormRequest
{
    protected $model = null;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $action = $this->route()->getName();
        $action = explode('.', $action);
        $action = array_pop($action);

        return policy()->dispatch(new $this->model(), $action);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * Should be empty
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
