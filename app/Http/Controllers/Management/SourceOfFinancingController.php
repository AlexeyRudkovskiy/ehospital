<?php

namespace App\Http\Controllers\Management;

use App\SourceOfFinancing;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SourceOfFinancingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $sourceOfFinancings = SourceOfFinancing::orderBy('id', 'desc')->paginate(config('eh.pagination.limit'));
        return view('management.sourceOfFinancing.index')
            ->with('items', $sourceOfFinancings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('management.sourceOfFinancing.create')
            ->with('item', new SourceOfFinancing());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SourceOfFinancing::create($request->only([
            'name'
        ]));

        session()->flash('message', json_encode([
            'text' => trans('management.notification.sourceOfFinancing.created'),
            'type' => 'notification-default'
        ]));

        return redirect()->route('sourceOfFinancing.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  SourceOfFinancing $sourceOfFinancing
     * @return \Illuminate\Http\Response
     */
    public function show(SourceOfFinancing $sourceOfFinancing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  SourceOfFinancing $sourceOfFinancing
     * @return \Illuminate\Http\Response
     */
    public function edit(SourceOfFinancing $sourceOfFinancing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  SourceOfFinancing $sourceOfFinancing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SourceOfFinancing $sourceOfFinancing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  SourceOfFinancing $sourceOfFinancing
     * @return \Illuminate\Http\Response
     */
    public function destroy(SourceOfFinancing $sourceOfFinancing)
    {
        $sourceOfFinancing->delete();

        session()->flash('message', json_encode([
            'text' => trans('management.notification.sourceOfFinancing.deleted'),
            'type' => 'notification-default'
        ]));

        return back();
    }
}
