<?php

namespace App\Http\Controllers\Management;

use App\AtcClassification;
use App\Http\Requests\AtcClassificationRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AtcClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $atcClassifications = AtcClassification::orderBy('id', 'desc')->paginate(config('eh.pagination.limit'));

        return view('management.atcClassification.index')
            ->with('classifications', $atcClassifications);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('management.atcClassification.create')
            ->with('classification', new AtcClassification());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AtcClassificationRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AtcClassificationRequest $request)
    {
        $data = $request->only([
            'name_en',
            'name_ua',
            'parent_id'
        ]);
        if ($request->has('has_parent_category') && $request->get('has_parent_category') == 'yes') {
            if (!array_has($data, 'parent_id') || strlen($data['parent_id']) < 1) {
//            unset($data['parent_id']);
                $data['parent_id'] = null;
            }
        } else {
            $data['parent_id'] = null;
        }

        AtcClassification::create($data);
        session()->flash('message', trans('management.created'));
        return redirect()->route('atcClassification.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  AtcClassification  $atcClassification
     * @return AtcClassification
     */
    public function show(AtcClassification $atcClassification)
    {
        return $atcClassification;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  AtcClassification  $atcClassification
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(AtcClassification $atcClassification)
    {
        return view('management.atcClassification.edit')
            ->with('classification', $atcClassification);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AtcClassificationRequest|Request $request
     * @param  AtcClassification $atcClassification
     * @return \Illuminate\Http\Response
     */
    public function update(AtcClassificationRequest $request, AtcClassification $atcClassification)
    {
        $atcClassification->update($request->only([
            'name_en',
            'name_ua',
            'parent_id'
        ]));
        session()->flash('message', trans('management.atcClassification.saved'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  AtcClassification  $atcClassification
     * @return \Illuminate\Http\Response
     */
    public function destroy($atcClassification)
    {
        //
    }
}
