<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Profile\UpdateProfileRequest;
use App\Repositories\Panel\ProfileRepository;
use App\Repositories\Panel\RoleRepository;

class ProfileController extends Controller
{
    private $profileRepository;
    private $roleRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\Panel\ProfileRepository  $profileRepository
     * @param  \App\Repositories\Panel\RoleRepository  $roleRepository
     * @return void
     */
    public function __construct(ProfileRepository $profileRepository, RoleRepository $roleRepository)
    {
        $this->profileRepository = $profileRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Show the form for editing the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $roles = $this->roleRepository->all();

        return view('panel.profile.show', compact('roles'));
    }

    /**
     * Update the resource in storage.
     *
     * @param  \App\Http\Requests\Panel\Profile\UpdateProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {
        $this->profileRepository->update($request->only(['name', 'email', 'role', 'password']), auth()->user()->id);

        if ($request->get('_form') == 'update-password') {
            $withSuccess = __('Profile password updated successfully!');
        } else {
            $withSuccess = __('Profile updated successfully!');
        }

        return redirect()->route('panel.profile.show')
            ->withSuccess($withSuccess);
    }

    /**
     * Remove the resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $this->profileRepository->delete(auth()->user()->id);

        return redirect()->route('login');
    }
}
