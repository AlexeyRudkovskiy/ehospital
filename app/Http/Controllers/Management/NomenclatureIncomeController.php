<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NomenclatureIncomeController extends Controller
{

    public function index()
    {
        return view('management.nomenclatureIncome.index')
            ->with('model', new \stdClass());
    }

    public function postNomenclatures(Request $request)
    {
        return $request->all();
    }

}
