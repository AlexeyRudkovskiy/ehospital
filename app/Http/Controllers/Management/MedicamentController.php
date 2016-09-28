<?php

namespace App\Http\Controllers\Management;

use App\Events\MedicamentChangedEvent;
use App\Medicament;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MedicamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicaments = Medicament::orderBy('id', 'desc')->paginate(config('eh.pagination.limit'));
        return view('management.medicament.index')
            ->with('medicaments', $medicaments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management.medicament.create')
            ->with('medicament', new Medicament());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\MedicamentRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\MedicamentRequest $request)
    {
        $data = $request->only([
            'name',
            'name_for_department',
            'small_name',
            'amount_in_a_package',
            'nds',
            'barcode',
            'morion_code',
            'base_unit_id',
            'basic_unit_id',
            'atc_classification_id'
        ]);

        $data = array_merge($data, [
            'keep_records_by_series' => true,
            'inn_name' => 0
        ]);

        $medicament = Medicament::create($data);
        session()->flash('message', trans('management.medicament.created'));
        return redirect()->route('medicament.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function show(Medicament $medicament)
    {
        return view('management.medicament.show')
            ->with('medicament', $medicament);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicament $medicament)
    {
        return view('management.medicament.edit')
            ->with('medicament', $medicament);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\MedicamentRequest|Request $request
     * @param  \App\Medicament $medicament
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\MedicamentRequest $request, Medicament $medicament)
    {
        $data = $request->only([
            'name',
            'name_for_department',
            'small_name',
            'amount_in_a_package',
            'nds',
            'barcode',
            'morion_code',
            'base_unit_id',
            'basic_unit_id',
            'atc_classification_id'
        ]);

        $medicament->update($data);
        session()->flash('message', 'management.medicament.saved');

        event(new MedicamentChangedEvent($medicament));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicament $medicament)
    {
        //
    }

    public function getIncome(Medicament $medicament)
    {
        return view('management.medicament.income')
            ->with('medicament', $medicament);
    }

    public function postIncome(Medicament $medicament, Request $request)
    {
        return $request->all();
    }

}
