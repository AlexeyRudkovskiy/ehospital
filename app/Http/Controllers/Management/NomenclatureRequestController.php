<?php

namespace App\Http\Controllers\Management;

use App\Events\NomenclatureOutgoingEvent;
use App\Events\Notification;
use App\Nomenclature;
use App\NomenclatureRequest;
use App\NomenclatureRequestMerged;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NomenclatureRequestController extends Controller
{

    public function index()
    {
        $requests = NomenclatureRequestMerged::latest()->orderBy('accepted', 'asc')->paginate(config('eh.pagination.limit'));
        return view('management.nomenclature.request.index')
            ->with('requests', $requests);
    }

    public function show(NomenclatureRequestMerged $nomenclatureRequestMerged)
    {
        $items = [];
        if (count($nomenclatureRequestMerged->accepted) > 0) {
            $items = collect($nomenclatureRequestMerged->accepted)->map(function ($item) {
                return [
                    'nomenclature' => Nomenclature::find($item['nomenclature_id']),
                    'amount' => $item['requested'],
                    'accepted' => $item['accepted']
                ];
            });
        } else {
            $items = collect($nomenclatureRequestMerged['requested'])->map(function ($item, $key) {
                $nomenclature = Nomenclature::find($key);

                return [
                    'nomenclature' => $nomenclature,
                    'amount' => $item
                ];
            });
        }

        return view('management.nomenclature.request.show')
            ->with('items', $items)
            ->with('request', $nomenclatureRequestMerged);
    }

    public function create(NomenclatureRequestMerged $nomenclatureRequestMerged, Request $request)
    {
        $accepted = $request->get('nomenclature');
        $requested = $nomenclatureRequestMerged->requested;

        $acceptedData = [];

        foreach ($accepted as $key => $item) {
            $data = [
                'nomenclature_id' => $key,
                'requested' => number_format($requested[$key], 2),
                'accepted' => number_format($item, 2)
            ];

            array_push($acceptedData, $data);

            $nomenclatureRequestMerged->department->nomenclatureIncome(Nomenclature::find($key), $item);
        }

        $nomenclatureRequestMerged->update([
            'accepted' => $acceptedData,
            'pharmacist_id' => auth()->id()
        ]);

        $notification = new Notification(trans('management.notification.department.nomenclature.income.message'), 'success');
        $notification
            ->addAction(trans('management.notification.department.nomenclature.income.actions.open'), route('department.current') . '#storage');

        $nomenclatureRequestMerged->department->leader->notify($notification);

        return redirect()->route('nomenclature.requests');

//        $accepted = $request->get('nomenclature');
//        $nomenclatureRequest->update([ 'accepted' => $accepted, 'done' => true ]);
//
//        foreach ($accepted as $key => $item) {
//            $nomenclature = Nomenclature::find($key);
//            $batch = null;
//            $nomenclature->outgoing($item, $batch, [
//                'nomenclature_request_id' => $nomenclatureRequest->id
//            ]);
//
//            event(new NomenclatureOutgoingEvent($nomenclature));
//        }

        return redirect()->route('nomenclature.index');
    }

}
