<?php

namespace App\Http\Controllers\API;

use App\Contractor;
use App\Department;
use App\Nomenclature;
use App\NomenclatureSet;
use App\Procedure;
use App\SourceOfFinancing;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{

    public function departments (Request $request) {
        return Department::search($request->get('text'))->get()->map(function (Department $item) {
            return [
                'id' => $item->id,
                'name' => $item->name
            ];
        });
    }

    public function departmentUsersList (Department $department)
    {
        return $department->users->map(function (User $user) {
            return [
                'id' => $user->id,
                'name' => $user->fullName()
            ];
        });
    }

    public function departmentUsers (Department $department, Request $request)
    {
        return User::search($request->get('text'))->where('department_id', $department->id)->get()->map(function (User $user) {
            return [
                'id' => $user->id,
                'name' => $user->fullName()
            ];
        });
    }

    public function users(Request $request)
    {
        return User::search($request->get('text'))->get()->map(function (User $user) {
            return [
                'id' => $user->id,
                'name' => $user->fullName()
            ];
        });
    }

    public function nomenclatures(Request $request)
    {
        $nomenclatures = Nomenclature::search($request->get('text'))->get()->map(function (Nomenclature $nomenclature) {
            $units = collect([
                $nomenclature->baseUnit,
                $nomenclature->basicUnit
            ]);
            return [
                'id' => $nomenclature->id,
                'name' => $nomenclature->name,
                'name_for_department' => $nomenclature->name_for_department,
                'units' => $units
            ];
        });

        if ($request->has('sets_link') && $request->get('sets_link', -1) == 1) {
            $nomenclatures->push([
                'id' => -1,
                'name' => 'Загрузить наборы',
                'name_for_department' => '',
                'units' => [],
                'is_set' => true
            ]);
        }

        return $nomenclatures;
    }

    public function nomenclature(Nomenclature $nomenclature, Request $request)
    {
        $currentUnitId = $request->get('unit_id', 0);
        $units = collect([
            $nomenclature->baseUnit,
            $nomenclature->basicUnit
        ])->map(function ($unit) use ($currentUnitId) {
            $unit = $unit->toArray();
            $unit['selected'] = $unit['id'] == $currentUnitId;
            return $unit;
        });
        return [
            [
                'id' => $nomenclature->id,
                'name' => $nomenclature->name,
                'name_for_department' => $nomenclature->name_for_department,
                'units' => $units,
                'selected' => true
            ]
        ];
    }

    public function procedures(Request $request)
    {
        return Procedure::search($request->get('text'))->get();
    }

    public function procedure(Procedure $procedure)
    {
        $procedure->selected = true;
        return [ $procedure ];
    }

    public function source_of_financing(Request $request)
    {
        return SourceOfFinancing::search($request->get('text'))->get();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function contractors(Request $request)
    {
        return Contractor::search($request->get('text'))->where('group', 'provider')->get()->map(function (Contractor $contractor) {
            $contractor->agreements;
            return $contractor;
        });
    }

    public function sets(Department $department, Request $request)
    {
        $default = null;
        if ($request->has('set_id')) {
            $default = NomenclatureSet::whereId($request->get('set_id', 0))
                ->get()
                ->map(function (NomenclatureSet $set) {
                    $set->selected = true;
                    return $set;
                });
        } else {
            $default = NomenclatureSet::search($request->get('text'))
                ->where('department_id', $department->id)
                ->get();
        }
        return $default
            ->map(function (NomenclatureSet $nomenclatureSet) {
                $nomenclatureSet->count = $nomenclatureSet->items()->count();
                return $nomenclatureSet;
            });
    }

}
