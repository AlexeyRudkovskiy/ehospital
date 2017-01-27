<?php

namespace App\Http\Controllers\API;

use App\Department;
use App\Nomenclature;
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
        return Nomenclature::search($request->get('text'))->get()->map(function (Nomenclature $nomenclature) {
            return [
                'id' => $nomenclature->id,
                'name' => $nomenclature->name,
                'name_for_department' => $nomenclature->name_for_department
            ];
        });
    }

}
