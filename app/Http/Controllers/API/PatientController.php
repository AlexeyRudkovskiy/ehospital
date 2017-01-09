<?php

namespace App\Http\Controllers\API;

use App\Comment;
use App\Patient;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{

    public function getComments(Patient $patient)
    {
        return $patient->comments;
    }

}
