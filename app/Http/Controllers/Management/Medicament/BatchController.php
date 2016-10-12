<?php

namespace App\Http\Controllers\Management\Medicament;

use App\Events\BatchChangedEvent;
use App\Events\BatchCreatedEvent;
use App\Http\Requests\MedicamentBatchRequest;
use App\Medicament;
use App\MedicamentBatch;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BatchController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param Medicament $medicament
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Medicament $medicament)
    {
        if ($medicament->id != null) {
            return view('management.medicament.batch.create')
                ->with('medicament', $medicament)
                ->with('batch', new MedicamentBatch());
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Medicament $medicament, MedicamentBatchRequest $request)
    {
        if ($medicament->id != null) {
            $data = $request->only([
                'batch_number',
                'expiration_date',
                'price'
            ]);
            $batch = $medicament->batches()->create($data);
            session()->flash('message', 'management.medicament.batch.created');
            event(new BatchCreatedEvent($batch));
            return redirect()->route('medicament.show', [$medicament->id, '#activetab=.tab-content-batches']);
        }
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Medicament $medicament
     * @param  MedicamentBatch  $batch
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicament $medicament, MedicamentBatch $batch)
    {
        return view('management.medicament.batch.edit')
            ->with('medicament', $medicament)
            ->with('batch', $batch);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MedicamentBatchRequest  $request
     * @param Medicament $medicament
     * @param  MedicamentBatch  $batch
     * @return \Illuminate\Http\Response
     */
    public function update(MedicamentBatchRequest $request, Medicament $medicament, MedicamentBatch $batch)
    {
        $data = $batch->update($request->only([
            'batch_number',
            'expiration_date',
            'price'
        ]));
        event(new BatchChangedEvent($batch));

        return redirect()->route('medicament.show', [$medicament->id, '#activetab=.tab-content-batches']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  MedicamentBatch  $batch
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicamentBatch $batch)
    {
        //
    }

}
