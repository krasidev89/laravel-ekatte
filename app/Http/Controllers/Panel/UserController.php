<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\User\StoreUserRequest;
use App\Http\Requests\Panel\User\UpdateUserRequest;
use App\Services\Panel\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\Panel\UserService  $userService
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->userService->authorizeViewAny();

        if ($request->ajax()) {
            $users = $this->userService->getUsersForDataTable($request->all());

            $datatable = datatables()->eloquent($users);

            $datatable->addColumn('roles', function ($user) {
                return $user->roles->map(function ($role) {
                    return $role->name;
                })->implode(', ');
            });

            $datatable->addColumn('actions', function ($user) {
                return view('panel.users.table.table-actions', compact('user'));
            });

            $datatable->rawColumns(['actions']);

            return $datatable->make(true);
        }

        return view('panel.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->userService->authorizeCreate();

        $roles = $this->userService->getAllRoles();

        return view('panel.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Panel\User\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $this->userService->authorizeCreate();

        $this->userService->create($request->only(['name', 'email', 'password', 'role']));

        return redirect()->route('panel.users.index')
            ->withSuccess(__('User added successfully!'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->userService->authorizeUpdate($id);

        $data = $this->userService->getEditData($id);

        return view('panel.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Panel\User\UpdateUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $this->userService->authorizeUpdate($id);

        $this->userService->update($request->only(['name', 'email', 'password', 'role']), $id);

        return redirect()->route('panel.users.index')
            ->withSuccess(__('User updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userService->authorizeDelete($id);

        return $this->userService->delete($id);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $this->userService->authorizeRestore($id);

        return $this->userService->restore($id);
    }

    /**
     * Force delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id)
    {
        $this->userService->authorizeForceDelete($id);

        return $this->userService->forceDelete($id);
    }
}
