<?php

namespace App\Http\Controllers\Management\Department;

use App\Nomenclature;
use App\NomenclatureSet;
use App\NomenclatureSetItem;
use App\Unit;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('management.department.current.nomenclature_sets.create')
            ->with('item', new NomenclatureSet());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $department = auth()->user()->department;
        $department->nomenclatureSets()->create($request->only([
            'name'
        ]));

        return redirect()->route('department.current');
    }

    /**
     * @param NomenclatureSet $nomenclatureSet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(NomenclatureSet $nomenclatureSet)
    {
        return view('management.department.current.nomenclature_sets.edit')
            ->with('item', $nomenclatureSet);
    }

    /**
     * @param NomenclatureSet $nomenclatureSet
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NomenclatureSet $nomenclatureSet, Request $request)
    {
        $nomenclatureSet->update($request->only(['name']));

        return redirect()->route('department.current');
    }

    /**
     * @param NomenclatureSet $nomenclatureSet
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(NomenclatureSet $nomenclatureSet)
    {
        $nomenclatureSet->delete();

        return redirect(route('department.current') . '#sets');
    }

    /**
     * @param NomenclatureSet $nomenclatureSet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createItem(NomenclatureSet $nomenclatureSet)
    {
        return view('management.department.current.nomenclature_sets.item.create')
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
            'nomenclature_id', 'amount', 'unit_id'
        ]));
        return redirect()->route('department.nomenclature_set.show', $nomenclatureSet->id);
    }

    /**
     * @param NomenclatureSet $nomenclatureSet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editItem(NomenclatureSet $nomenclatureSet, NomenclatureSetItem $nomenclatureSetItem)
    {
        return view('management.department.current.nomenclature_sets.item.edit')
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
            'nomenclature_id', 'amount', 'unit_id'
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
        return collect([$nomenclatureSetItem->nomenclature])->map(function (Nomenclature $nomenclature) use ($nomenclatureSetItem) {
            $units = collect([
                $nomenclature->baseUnit,
                $nomenclature->basicUnit
            ])->map(function ($unit) use ($nomenclatureSetItem) {
                $unit = $unit->toArray();
                $unit['selected'] = $nomenclatureSetItem->unit->id === $unit['id'];
                return $unit;
            });
            return [
                'id' => $nomenclature->id,
                'name' => $nomenclature->name,
                'name_for_department' => $nomenclature->name_for_department,
                'selected' => true,
                'units' => $units
            ];
        });
    }

}
