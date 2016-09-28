<?php

namespace App\Http\Controllers\Management\Medicament;

use App\Events\BatchCreatedEvent;
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
    public function store(Medicament $medicament, Requests\BatchRequest $request)
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
