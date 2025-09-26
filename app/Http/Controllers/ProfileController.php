<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('hrd.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'telp'    => 'nullable|string|max:20|unique:users,telp,' . Auth::id(),
            'jabatan' => 'nullable|string|max:100',
            'alamat'  => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        $user->name    = $request->name;
        $user->telp    = $request->telp;
        $user->jabatan = $request->jabatan;
        $user->alamat  = $request->alamat;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('profile_pictures', 'public');
            $user->profile_photo = $path;
        }
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }
}
