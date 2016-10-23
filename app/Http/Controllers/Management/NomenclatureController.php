<?php

namespace App\Http\Controllers\Management;

use App\Events\NomenclatureChangedEvent;
use App\Nomenclature;
use App\NomenclatureBatch;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NomenclatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nomenclatures = Nomenclature::orderBy('id', 'desc')->paginate(config('eh.pagination.limit'));
        return view('management.nomenclature.index')
            ->with('nomenclatures', $nomenclatures);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management.nomenclature.create')
            ->with('nomenclature', new Nomenclature());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\NomenclatureRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\NomenclatureRequest $request)
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
            'atc_classification_id',
            'keep_records_by_series'
        ]);

        $data = array_merge($data, [
            'keep_records_by_series' => true,
            'inn_name' => 0
        ]);

        $nomenclature = Nomenclature::create($data);
        session()->flash('message', trans('management.notification.nomenclature.created'));
        return redirect()->route('nomenclature.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nomenclature  $nomenclature
     * @return \Illuminate\Http\Response
     */
    public function show(Nomenclature $nomenclature)
    {
        return view('management.nomenclature.show')
            ->with('nomenclature', $nomenclature);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nomenclature  $nomenclature
     * @return \Illuminate\Http\Response
     */
    public function edit(Nomenclature $nomenclature)
    {
        return view('management.nomenclature.edit')
            ->with('nomenclature', $nomenclature);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\NomenclatureRequest|Request $request
     * @param  \App\Nomenclature $nomenclature
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\NomenclatureRequest $request, Nomenclature $nomenclature)
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
            'atc_classification_id',
            'keep_records_by_series'
        ]);

        if ($data['keep_records_by_series'] == '0') {
            $data['keep_records_by_series'] = false;
        } else {
            $data['keep_records_by_series'] = true;
        }

        $nomenclature->update($data);
        session()->flash('message', json_encode([
            'text' => 'management.notification.nomenclature.modified',
            'type' => ''
        ]));

        event(new NomenclatureChangedEvent($nomenclature));

        return redirect()->route('nomenclature.show', $nomenclature->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nomenclature  $nomenclature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nomenclature $nomenclature)
    {
        //
    }

    public function getIncome(Nomenclature $nomenclature)
    {
        return view('management.nomenclature.income')
            ->with('nomenclature', $nomenclature);
    }

    public function getOutgoing(Nomenclature $nomenclature)
    {
        return view('management.nomenclature.outgoing')
            ->with('nomenclature', $nomenclature);
    }

    public function postIncome(Nomenclature $nomenclature, Request $request)
    {
        return $request->all();
    }

}
