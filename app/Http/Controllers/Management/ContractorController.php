<?php

namespace App\Http\Controllers\Management;

use App\Address;
use App\Contractor;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContractorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $type = $request->get('type', 'provider');

        $contractors = Contractor::orderBy('id', 'desc')
            ->whereGroup($type)->paginate(config('eh.pagination.limit'));

        view()->share('hasType', true);
        view()->share('type', $type);

        return view('management.contractor.index')
            ->with('contractors', $contractors)
            ->with('type', $type);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management.contractor.create')
            ->with('contractor', new Contractor());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\ContractorRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\ContractorRequest $request)
    {
        $data = $request->only($request->fields);
        $data = array_merge($data, [
            'contractor_group_id' => 1
        ]);
        $contractor = Contractor::create($data);

        session()->flash('message', json_encode([
            'text' => trans('management.notification.contractor.created'),
            'type' => 'notification-default'
        ]));

        return redirect()->route('contractor.show', $contractor->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  Contractor   $contractor
     * @return \Illuminate\Http\Response
     */
    public function show(Contractor $contractor)
    {
        return view('management.contractor.show')
            ->with('contractor', $contractor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function edit(Contractor $contractor)
    {
        return view('management.contractor.edit')
            ->with('contractor', $contractor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\ContractorRequest|Request $request
     * @param  Contractor $contractor
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ContractorRequest $request, Contractor  $contractor)
    {
        $data = $request->only($request->fields);
        $contractor->update($data);

        session()->flash('message', json_encode([
            'text' => trans('management.notification.contractor.modified'),
            'type' => 'notification-default'
        ]));

        return redirect()->route('contractor.show', $contractor->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contractor  $contractor)
    {
        //
    }

    public function getAddAddress(Contractor $contractor)
    {
        return view('management.contractor.address.create')
            ->with('contractor', $contractor);
    }

    public function deleteAddress(Contractor $contractor, Address $address)
    {
        $address->delete();

        session()->flash('message', json_encode([
            'text' => trans('management.notification.contractor.address.deleted'),
            'type' => 'notification-default'
        ]));

        return back();
    }

    public function getAddAgreement(Contractor $contractor)
    {
        return view('management.contractor.agreement.create')
            ->with('contractor', $contractor);
    }

}
