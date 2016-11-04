<?php

namespace App\Http\Controllers\Management;

use App\Manufacturer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manufacturers = Manufacturer::orderBy('id', 'desc')->paginate(config('eh.pagination.limit'));
        return view('management.manufacturer.index')
            ->with('manufacturers', $manufacturers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management.manufacturer.create')
            ->with('manufacturer', new Manufacturer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\ManufacturerRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\ManufacturerRequest $request)
    {
        Manufacturer::create($request->only(['name']));
        session()->flash('message', trans('management.manufacturer.crated'));
        return redirect()->route('manufacturer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function show(Manufacturer $manufacturer)
    {
        return $manufacturer;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function edit(Manufacturer $manufacturer)
    {
        return view('management.manufacturer.edit')
            ->with('manufacturer', $manufacturer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\ManufacturerRequest|Request $request
     * @param  \App\Manufacturer $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ManufacturerRequest $request, Manufacturer $manufacturer)
    {
        $manufacturer->update($request->only(['name']));
        session()->flash('message', trans('management.manufacturer.crated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manufacturer $manufacturer)
    {
        //
    }
}
