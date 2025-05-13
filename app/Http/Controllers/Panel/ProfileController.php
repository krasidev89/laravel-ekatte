<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Profile\UpdateProfileRequest;
use App\Services\Panel\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profileService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\Panel\ProfileService  $profileService
     * @return void
     */
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Show the form for editing the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $roles = $this->profileService->getAllRoles();

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
        $this->profileService->update($request->only(['name', 'email', 'role', 'password']), $request->user()->id);

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->profileService->delete($request->user()->id);

        return redirect()->route('login');
    }
}
