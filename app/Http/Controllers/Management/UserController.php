<?php

namespace App\Http\Controllers\Management;

use App\User;
use App\UserPosition;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(config('eh.pagination.limit'));
        return view('management.user.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management.user.create')
            ->with('user', new User);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\UserRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\UserRequest $request)
    {
        $data = $request->only([
            'firstName',
            'lastName',
            'middleName',
            'phone',
            'email',
            'password',
            'user_position_id',
            'permission_id',
            'organization_id'
        ]);

        $data['cryptKey'] = md5($data['firstName'] . md5($data['lastName']) . time());

        $user = User::create($data);

        foreach ($request->get('schedule') as $item) {
            $user->schedule()->create($item);
        }

        session()->flash('message', trans('management.user.created'));
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('management.user.show')
            ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('management.user.edit')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\UserRequest|Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UserRequest $request, User $user)
    {
        $user->update($request->all());
        session()->flash('message', trans('management.user.saved'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
