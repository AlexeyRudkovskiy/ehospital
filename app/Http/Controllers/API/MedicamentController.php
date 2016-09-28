<?php

namespace App\Http\Controllers\API;

use App\Events\MedicamentIncomeEvent;
use App\Medicament;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MedicamentController extends Controller
{
    public function postIncome(Medicament $medicament, Request $request)
    {
        if ($medicament->id != null && $request->has('user_id')) {
            auth()->loginUsingId($request->get('user_id'));
            $medicament->income($request->get('income'), []);
            event(new MedicamentIncomeEvent($medicament));
            return [
                "response" => "success",
                "data" => [ /* empty */ ]
            ];
        }
        abort(403);
    }
}
