<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profil.index', compact('user'));
    }

    public function updateInfo(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id_users . ',id_users',
            'no_telp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'fakultas' => 'nullable|string',
            'program_studi' => 'nullable|string',
        ]);

        $user->update($request->only('nama', 'email', 'no_telp', 'alamat', 'fakultas', 'program_studi'));

        return back()->with('success', 'Informasi profil berhasil diperbarui!');
    }

    public function updatePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture_path) {
                Storage::disk('public')->delete($user->profile_picture_path);
            }
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->update(['profile_picture_path' => $path]);

            return response()->json(['success' => true, 'path' => asset('storage/' . $path)]);
        }

        return response()->json(['success' => false], 400);
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password saat ini salah!');
        }

        $user->update(['password' => $request->new_password]);

        return back()->with('success', 'Password berhasil diubah!');
    }
}
