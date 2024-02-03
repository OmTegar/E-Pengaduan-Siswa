<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
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

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

    public function updateAvatar(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id' => ['required', 'string'],
            'avatar' => ['required', 'image'],
        ]);

        $user = User::find($request->user_id);

        if ($user) {
            if ($user->avatar_url) {
                Storage::delete('/public/images/' . $user->avatar_url);
            }

            $file = $request->file('avatar');
            $avatarName = Str::random(24) . '.' . $request->file('avatar')->extension();
            $file->storeAs('images', $avatarName, 'public');

            $user->update([
                'avatar_url' => $avatarName,
            ]);

            return redirect()->route('profile.edit')->with('status', 'avatar-updated');
        } else {
            // Handle the case where the user with the given ID is not found.
            return redirect()->route('profile.edit')->with('status', 'user-not-found');
        }
    }
}
