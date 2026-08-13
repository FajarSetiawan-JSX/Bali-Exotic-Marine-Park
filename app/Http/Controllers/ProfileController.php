<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        $user = Auth::user();
        $user = [
            'id' => $user->id,
            'name' => $user->name,
            'nik' => decrypt($user->nik),
            'username' => $user->username,
            'email' => $user->email,
            'phone' => decrypt($user->phone),
            'emergency' => decrypt($user->emergency),
            'gender' => $user->gender,
            'city' => $user->born_at,
            'birthday' => $user->birthday,
            'address' => $user->address,
            'profile' => $user->profile,
            'verified' => $user->email_verified_at,
            'division' => $user->division->level->level,
            'position' => $user->position?->position_id
        ];
        if ($user['division'] == 1) {
            return Inertia::render('Admin/profile/Edit', [
                'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
                'status' => session('status'),
                'user' => $user

            ]);
        } elseif ($user['division'] == 2) {
        } else {
        }
    }

    public function changepassword()
    {
        $user = Auth::user();
        if ($user->division->level->level == 1) {
            return Inertia::render('Admin/profile/Changepassword');
        } elseif ($user->division->level->level == 2) {
        } else {
        }
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
