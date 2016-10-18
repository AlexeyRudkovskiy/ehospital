<?php

namespace App\Http\Controllers\API;

use App\Contractor;
use App\Events\Contractor\AgreementCreated;
use App\Events\Notification;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContractorController extends Controller
{

    public function addressStore(Contractor $contractor, Request $request)
    {
        $address = $contractor->addresses()->create($request->all());
        $address->country;

        $notification = new Notification(trans('management.notification.contractor.address.created'), 'notification-default');

        auth()->user()->notify($notification);

        return [
            'response' => 'success',
            'data' => [
                'item' => $address
            ]
        ];
    }

    public function agreementStore(Contractor $contractor, Request $request)
    {
        $agreement = $contractor->agreements()->create($request->all());

        $notification = new Notification(trans('management.notification.contractor.agreement.created'), 'notification-default');

        auth()->user()->notify($notification);
        event(new AgreementCreated($contractor, $agreement));

        return [
            'response' => 'success',
            'data' => [
                'item' => $agreement
            ]
        ];
    }

}
