<?php

namespace App\Http\Controllers\Management\Nomenclature;

use App\Events\BatchChangedEvent;
use App\Events\BatchCreatedEvent;
use App\Http\Requests\NomenclatureBatchRequest;
use App\Nomenclature;
use App\NomenclatureBatch;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BatchController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param Nomenclature $nomenclature
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Nomenclature $nomenclature)
    {
        if ($nomenclature->id != null) {
            return view('management.nomenclature.batch.create')
                ->with('nomenclature', $nomenclature)
                ->with('batch', new NomenclatureBatch());
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Nomenclature $nomenclature, NomenclatureBatchRequest $request)
    {
        if ($nomenclature->id != null) {
            $data = $request->only([
                'batch',
                'price'
            ]);
            $batch = $nomenclature->batches()->create($data);
            session()->flash('message', 'management.nomenclature.batch.created');
            event(new BatchCreatedEvent($batch));
            return redirect()->route('nomenclature.show', [$nomenclature->id, '#activetab=.tab-content-batches']);
        }
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Nomenclature $nomenclature
     * @param  NomenclatureBatch  $batch
     * @return \Illuminate\Http\Response
     */
    public function edit(Nomenclature $nomenclature, NomenclatureBatch $batch)
    {
        return view('management.nomenclature.batch.edit')
            ->with('nomenclature', $nomenclature)
            ->with('batch', $batch);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  NomenclatureBatchRequest  $request
     * @param Nomenclature $nomenclature
     * @param  NomenclatureBatch  $batch
     * @return \Illuminate\Http\Response
     */
    public function update(NomenclatureBatchRequest $request, Nomenclature $nomenclature, NomenclatureBatch $batch)
    {
        $data = $batch->update($request->only([
            'batch',
            'price'
        ]));
        event(new BatchChangedEvent($batch));

        return redirect()->route('nomenclature.show', [$nomenclature->id, '#activetab=.tab-content-batches']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  NomenclatureBatch  $batch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nomenclature $nomenclature, NomenclatureBatch $batch)
    {
        $batch->delete();
        session()->flash('message', json_encode([
            'text' => 'management.nomenclature.batch.deleted',
            'type' => ''
        ]));
        return redirect()->route('nomenclature.show', [$nomenclature->id, '#activetab=.tab-content-batches']);
    }

}
