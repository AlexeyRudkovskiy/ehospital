<?php

namespace App\Http\Controllers\Management;

use App\Events\NomenclatureOutgoingEvent;
use App\Nomenclature;
use App\NomenclatureRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NomenclatureRequestController extends Controller
{

    public function show(NomenclatureRequest $nomenclatureRequest)
    {
        $requestedData = $nomenclatureRequest->requestedData();

        return view('management.nomenclatureRequest.show')
            ->with('requestedData', $requestedData)
            ->with('accepted', $nomenclatureRequest->accepted)
            ->with('isAccepted', $nomenclatureRequest->accepted != null);
    }

    public function create(NomenclatureRequest $nomenclatureRequest, Request $request)
    {
        $accepted = $request->get('nomenclature');
        $nomenclatureRequest->update([ 'accepted' => $accepted, 'done' => true ]);

        foreach ($accepted as $key => $item) {
            $nomenclature = Nomenclature::find($key);
            $batch = null;
            $nomenclature->outgoing($item, $batch, [
                'nomenclature_request_id' => $nomenclatureRequest->id
            ]);

            event(new NomenclatureOutgoingEvent($nomenclature));
        }

        return redirect()->route('nomenclature.index');
    }

}
