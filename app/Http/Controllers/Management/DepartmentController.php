<?php

namespace App\Http\Controllers\Management;

use App\Department;
use App\Http\Controllers\PermissibleController;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DepartmentController extends PermissibleController
{

    protected $model = Department::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::orderBy('id', 'desc')->paginate(config('eh.pagination.limit'));
        return view('management.department.index')
            ->with('departments', $departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management.department.create')
            ->with('department', new Department());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\DepartmentRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\DepartmentRequest $request)
    {
        $data = $request->only([
            'name',
            'leader_id',
            'organization_id',
            'department_code',
            'beds_amount',
            'beds_amount_in_repair',
            'female_beds_amount',
            'male_beds_amount'
        ]);

        Department::create($data);

        session()->flash('message', trans('management.department.saved'));
        return redirect()->route('department.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view('management.department.show')
            ->with('department', $department);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('management.department.edit')
            ->with('department', $department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\DepartmentRequest|Request $request
     * @param  \App\Department $department
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\DepartmentRequest $request, Department $department)
    {
        $data = $request->only([
            'name',
            'leader_id',
            'organization_id',
            'department_code',
            'beds_amount',
            'beds_amount_in_repair',
            'female_beds_amount',
            'male_beds_amount'
        ]);

        $department->update($data);
        session()->flash('message', trans('management.department.saved'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }
}
