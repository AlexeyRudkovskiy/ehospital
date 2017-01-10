<?php

namespace App\Http\Controllers\API;

use App\Department;
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

    public function users(Request $request)
    {
        return User::search($request->get('text'))->get()->map(function (User $user) {
            return [
                'id' => $user->id,
                'name' => $user->fullName()
            ];
        });
    }

}
