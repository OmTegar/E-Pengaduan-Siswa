<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        try {
            Auth::user()->role_id == 1 ? $users = User::orderBy('role_id')->paginate(20) : abort(403);
            $users = User::orderBy('role_id')->paginate(20);
            return view('management', compact('users'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateRole(Request $request, User $user)
    {
        try {
            $request->validate([
                'role_id' => 'required'
            ]);
            $user->update([
                'role_id' => $request->role_id
            ]);
            return redirect()->route('management');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('management');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function searchUser(Request $request)
    {
        $users = User::where('name', 'like', '%' . $request->search . '%')
            ->orWhere('email', 'like', '%' . $request->search . '%')
            ->paginate(20);
        return view('management', compact('users'));
    }
}
