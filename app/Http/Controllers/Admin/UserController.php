<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
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
        $users = User::orderBy('id', 'DESC')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id')->toArray();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $password = bcrypt($request->_password);

        $addRequest = [
            'password' => $password,
        ];

        $user = new User;

        if ($user->create($request->all() + $addRequest)) {
            return back()->with('notice', trans('messages.user_add_success'));
        } else {
            return back()->with('message', trans('messages.create_failed'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::pluck('name', 'id')->toArray();

        try {
            $user = User::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('notice_error', trans('messages.no_result'));
        }
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $addRequest = [];
        if ($request->changePassword == 'on') {
            $password = bcrypt($request->_password);

            $addRequest += [
                'password' => $password,
            ];
        }

        $user = User::findOrFail($id);

        if ($user->update($request->all() + $addRequest)) {
            return redirect()->route('users.edit', [$id])->with('notice', trans('messages.edit.success'));
        } else {
            return redirect()->route('users.edit', [$id])->with('notice_error', trans('messages.edit.error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('users.index')->with('notice', trans('messages.delete.success'));
    }
}
