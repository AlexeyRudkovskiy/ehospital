<?php

namespace App\Http\Controllers\Management;

use App\Cure;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CureController extends Controller
{

    public function show(Cure $cure)
    {
        return view('management.cure.show')
            ->with('cure', $cure);
    }

}
