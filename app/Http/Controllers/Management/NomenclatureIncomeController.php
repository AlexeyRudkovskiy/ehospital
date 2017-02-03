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

    public function show(NomenclatureIncome $nomenclatureIncome)
    {
        return $nomenclatureIncome;
//        $income = NomenclatureIncome::find($income);
//        dd($income);
//        return view('management.nomenclatureIncome.show')
//            ->with('income', $income->data());
    }

    public function postNomenclatures(Request $request)
    {
        $data = $request->except(['_token', 'nomenclature']);

        $loadedNomenclatures = [];

        $income = new NomenclatureIncome($data);
        $nomenclatures = $request->get('nomenclature');
        $income->nomenclatures = json_encode($nomenclatures);
        $income->created_by = auth()->id();

        foreach ($nomenclatures as $item) {
            if (!array_key_exists($item['id'], $loadedNomenclatures)) {
                $nomenclature = Nomenclature::find($item['id']);
                if ($nomenclature === null) {
                    return response('Nomenclature is empty', 400);
                }
                $loadedNomenclatures[$item['id']] = $nomenclature;
            }
        }

        $income->save();

        foreach ($nomenclatures as $item) {
            $nomenclature = Nomenclature::find($item['id']);
            $batches = $item['batches'];
            foreach ($batches as $batch) {
                $createdBatch = $nomenclature->batches()->create([
                    'batch' => implode(' ', [$batch['batch_date'], $batch['batch_number']]),
                    'price' => $batch['total']
                ]);

                $nomenclature->income($batch['amount'], $createdBatch, [
                    'user_id' => auth()->id(),
                    'nomenclature_income_id' => $income->id
                ]);
            }
        }

        return redirect()->route('nomenclature.index');
    }

}
