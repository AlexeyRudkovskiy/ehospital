<?php

namespace App\Http\Controllers\Management;

use App\Nomenclature;
use App\NomenclatureBatch;
use App\NomenclatureIncome;
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

    public function show(int $income)
    {
        $income = NomenclatureIncome::find($income);
        return view('management.nomenclatureIncome.show')
            ->with('income', $income->data());
    }

    public function postNomenclatures(Request $request)
    {
        $data = $request->except(['_token']);

        $data['nomenclatures'] = \json_decode($data['nomenclatures']);

        $data = array_merge($data, [
            'created_by' => auth()->id()
        ]);
        $nomenclatureIncome = NomenclatureIncome::create($data);

        foreach ($data['nomenclatures'] as $nomenclatureData) {
            $nomenclature = Nomenclature::find($nomenclatureData->nomenclature_id);
            $batch = null;

            if (isset($nomenclatureData->keep_records_by_series) && $nomenclatureData->keep_records_by_series && isset($nomenclatureData->batch_id)) {
                $batch = NomenclatureBatch::find($nomenclatureData->batch_id);
            }

            $nomenclature->income($nomenclatureData->amount, $batch, [
                'nomenclature_income_id' => $nomenclatureIncome->id
            ]);
        }

        return $nomenclatureIncome;
    }

}
