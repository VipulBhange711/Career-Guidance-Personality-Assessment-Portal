<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $request->user()->profile()->firstOrCreate();

        return view('profile.edit', [
            'user' => $request->user(),
            'profile' => $request->user()->profile,
        ]);
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

        $profileData = $request->validate([
            'date_of_birth' => ['nullable', 'date'],
            'gender' => ['nullable', 'in:male,female,other'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:500'],
            'education_level' => ['nullable', 'string', 'max:50'],
            'current_education' => ['nullable', 'string', 'max:255'],
            'interests' => ['nullable', 'string', 'max:1000'],
            'career_goals' => ['nullable', 'string', 'max:1000'],
        ]);

        $request->user()->profile()->updateOrCreate(['user_id' => $request->user()->id], $profileData);

        return Redirect::route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
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
