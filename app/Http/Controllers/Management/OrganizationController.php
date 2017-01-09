<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\PermissibleController;
use App\Organization;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrganizationController extends PermissibleController
{
    protected $model = Organization::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (!policy()->dispatch(new Organization(), 'index')) { abort(403); }
        $paginated = Organization::orderBy('id', 'desc')->paginate(config('eh.pagination.limit'));
        return view('management.organization.index')
            ->with('organizations', $paginated);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('management.organization.create')
            ->with('organization', new Organization());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\OrganizationRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\OrganizationRequest $request)
    {
        Organization::create($request->only([
            'name', 'type'
        ]));

        session()->flash('message', trans('management.organization.create'));

        return redirect()->route('organization.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show($organization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organization $organization
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Organization $organization)
    {
        return view('management.organization.edit')
            ->with('organization', $organization);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\OrganizationRequest|Request $request
     * @param  \App\Organization $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\OrganizationRequest $request, Organization $organization)
    {
        $organization->update($request->only(['name', 'type']));
        session()->flash('message', trans('management.organization.saved'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy($organization)
    {
        //
    }
}
