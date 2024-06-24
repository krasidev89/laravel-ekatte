<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\User\StoreUserRequest;
use App\Http\Requests\Panel\User\UpdateUserRequest;
use App\Repositories\Panel\RoleRepository;
use App\Repositories\Panel\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;
    private $roleRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\Panel\UserRepository  $userRepository
     * @param  \App\Repositories\Panel\RoleRepository  $roleRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->userRepository->data($request->all());
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
        $roles = $this->roleRepository->all();

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
        $this->userRepository->create($request->only(['name', 'email', 'password', 'role']));

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
        $user = $this->userRepository->findOrFail($id);
        $roles = $this->roleRepository->all();

        return view('panel.users.edit', compact('user', 'roles'));
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
        $this->userRepository->update($request->only(['name', 'email', 'password', 'role']), $id);

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
        return $this->userRepository->delete($id);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        return $this->userRepository->restore($id);
    }

    /**
     * Force delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id)
    {
        return $this->userRepository->forceDelete($id);
    }
}
