<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PermissibleController extends Controller
{

    protected $model = null;

    public function callAction($method, $parameters)
    {
        foreach ($parameters as $parameter) {
            if (get_parent_class($parameter) == Requests\PermissibleRequest::class) {
                return parent::callAction($method, $parameters);
            }
        }
        if (!policy()->dispatch(new $this->model, $method)) {
            abort(403);
        }
        return parent::callAction($method, $parameters);
    }


}
