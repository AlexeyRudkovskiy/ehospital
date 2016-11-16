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
        if ($cure->review != null) {
            $newCureReview = $cure->review;
            $newCureReviewData = array_map(function ($item) {
                foreach ($item as $key => $val) {
                    $item['_' . $key] = $val;
                    unset($item[$key]);
                }
                return $item;
            }, $newCureReview['data']);
            $newCureReview['data'] = $newCureReviewData;
            $cure->review = $newCureReview;
        }

        return view('management.cure.show')
            ->with('cure', $cure);
    }

    public function postReview(Cure $cure, Request $request)
    {
        $calendarDays = $request->get('calendar_days');
        $calendarDays = \json_decode($calendarDays, true);

        dd($calendarDays);

        $calendarDays = array_map(function ($item) {
            foreach ($item as $key => $value) {
                unset($item[$key]);
                $key = substr($key, 1);
                $item[$key] = $value;
            }

            return (object)$item;
        }, $calendarDays);

        $currentData = $cure->review['data'];
        $updatedReview = $cure->review;
        $updatedReview['initial'] = $currentData;
        $updatedReview['data'] = $calendarDays;

        $cure->review = $updatedReview;
        $cure->save();

        return redirect()->route('cure.show', $cure->id);
    }

}
