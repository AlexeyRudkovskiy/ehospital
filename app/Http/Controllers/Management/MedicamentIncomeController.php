<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MedicamentIncomeController extends Controller
{

    public function index()
    {
        return view('management.medicamentIncome.index')
            ->with('model', new \stdClass());
    }

}
