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
        $data = $request->except(['_token', 'nomenclature']);

        $income = new NomenclatureIncome($data);
        $nomenclatures = $request->get('nomenclature');
        $income->nomenclatures = json_encode($nomenclatures);
        $income->created_by = auth()->id();

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
