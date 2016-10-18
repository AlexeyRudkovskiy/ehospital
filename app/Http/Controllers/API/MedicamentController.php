<?php

namespace App\Http\Controllers\API;

use App\Events\MedicamentHistoryUpdatedEvent;
use App\Medicament;
use App\MedicamentBatch;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MedicamentController extends Controller
{

    public function getList()
    {
        return Medicament::orderBy('name', 'asc')->get();
    }

    public function postIncome(Medicament $medicament, Request $request)
    {
        if ($medicament->id != null) {
            $data = [];
            $batch = null;
            if ($medicament->keep_records_by_series) {
                $batch = MedicamentBatch::find($request->get('batch'));
                $data = [
                    $request->get('income'),
                    $batch
                ];
            } else {
                $data = [
                    $request->get('income')
                ];
            }
            $data = array_merge($data, [[]]);
            call_user_func_array([
                $medicament, 'income'
            ], $data);
            $lastUpdate = $medicament->historyWithoutArmored->first();
            return [
                "response" => "success",
                "data" => [ /* empty */ ]
            ];
        }
        abort(403);
    }

    public function postOutgoing(Medicament $medicament, Request $request)
    {
        if ($medicament->id != null) {
            $data = [];
            $batch = null;
            if ($medicament->keep_records_by_series) {
                $batch = MedicamentBatch::find($request->get('batch'));
                $data = [
                    $request->get('outgoing'),
                    $batch
                ];
            } else {
                $data = [
                    $request->get('outgoing')
                ];
            }
            $data = array_merge($data, [[]]);
            call_user_func_array([
                $medicament, 'outgoing'
            ], $data);
            $lastUpdate = $medicament->historyWithoutArmored->first();
            return [
                "response" => "success",
                "data" => [ /* empty */ ]
            ];
        }
        abort(403);
    }

    public function getHistory(Medicament $medicament)
    {
        return $medicament->history;
    }

}
