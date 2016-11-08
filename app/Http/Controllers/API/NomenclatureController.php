<?php

namespace App\Http\Controllers\API;

use App\Events\NomenclatureHistoryUpdatedEvent;
use App\Nomenclature;
use App\NomenclatureBatch;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NomenclatureController extends Controller
{

    public function getList(Request $request)
    {
        if (!$request->has('only')) {
            return Nomenclature::orderBy('name', 'asc')->get();
        }
        $attributes = explode(',', $request->get('only'));
        $attributes = array_merge($attributes, [ 'basic_unit_id', 'base_unit_id' ]);
        $data = DB::table('nomenclatures')->select($attributes)->get();

        $data = $data->map(function ($item) {
            $unitIds = [$item->basic_unit_id, $item->base_unit_id];
            $item->units = DB::table('units')
                                ->select('name')
                                ->whereIn('id', $unitIds)
                                ->select(['text', 'id'])
                                ->get();
            return $item;
        });

        return $data;
    }

    public function postIncome(Nomenclature $nomenclature, Request $request)
    {
        if ($nomenclature->id != null) {
            $data = [];
            $batch = null;
            if ($nomenclature->keep_records_by_series) {
                $batch = NomenclatureBatch::find($request->get('batch'));
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
                $nomenclature, 'income'
            ], $data);
            $nomenclature->historyWithoutArmored;
            $lastUpdate = $nomenclature->historyWithoutArmored->first();
            return [
                "response" => "success",
                "data" => [ /* empty */ ]
            ];
        }
        abort(403);
    }

    public function postOutgoing(Nomenclature $nomenclature, Request $request)
    {
        if ($nomenclature->id != null) {
            $data = [];
            $batch = null;
            if ($nomenclature->keep_records_by_series) {
                $batch = NomenclatureBatch::find($request->get('batch'));
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
                $nomenclature, 'outgoing'
            ], $data);
            $lastUpdate = $nomenclature->historyWithoutArmored->first();
            return [
                "response" => "success",
                "data" => [ /* empty */ ]
            ];
        }
        abort(403);
    }

    public function getHistory(Nomenclature $nomenclature)
    {
        return $nomenclature->history;
    }

}
