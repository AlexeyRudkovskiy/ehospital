<?php

namespace App\Http\Controllers\Management\Department;

use App\Nomenclature;
use App\NomenclatureSet;
use App\NomenclatureSetItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NomenclatureSetController extends Controller
{

    /**
     * @param NomenclatureSet $nomenclatureSet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(NomenclatureSet $nomenclatureSet)
    {
        return view('management.department.current.nomenclature_sets.show')
            ->with('items', $nomenclatureSet->items)
            ->with('nomenclatureSet', $nomenclatureSet);
    }

    /**
     * @param NomenclatureSet $nomenclatureSet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createItem(NomenclatureSet $nomenclatureSet)
    {
        return view('management.department.current.nomenclature_sets.create')
            ->with('item', new NomenclatureSetItem())
            ->with('nomenclatureSet', $nomenclatureSet);
    }

    /**
     * @param NomenclatureSet $nomenclatureSet
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeItem(NomenclatureSet $nomenclatureSet, Request $request)
    {
        $nomenclatureSet->items()->create($request->only([
            'nomenclature_id', 'amount'
        ]));
        return redirect()->route('department.nomenclature_set.show', $nomenclatureSet->id);
    }

    /**
     * @param NomenclatureSet $nomenclatureSet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editItem(NomenclatureSet $nomenclatureSet, NomenclatureSetItem $nomenclatureSetItem)
    {
        return view('management.department.current.nomenclature_sets.edit')
            ->with('item', $nomenclatureSetItem)
            ->with('nomenclatureSet', $nomenclatureSet);
    }

    /**
     * @param NomenclatureSet $nomenclatureSet
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateItem(NomenclatureSet $nomenclatureSet, NomenclatureSetItem $nomenclatureSetItem, Request $request)
    {
        $nomenclatureSetItem->update($request->only([
            'nomenclature_id', 'amount'
        ]));
        return redirect()->route('department.nomenclature_set.show', $nomenclatureSet->id);
    }

    public function deleteItem(NomenclatureSet $nomenclatureSet, NomenclatureSetItem $nomenclatureSetItem)
    {
        $nomenclatureSetItem->delete();
        return redirect()->route('department.nomenclature_set.show', $nomenclatureSet->id);
    }

    public function preloadItem(NomenclatureSet $nomenclatureSet, NomenclatureSetItem $nomenclatureSetItem)
    {
        return collect([$nomenclatureSetItem->nomenclature])->map(function (Nomenclature $nomenclature) {
            return [
                'id' => $nomenclature->id,
                'name' => $nomenclature->name,
                'name_for_department' => $nomenclature->name_for_department,
                'selected' => true
            ];
        });
    }

}
