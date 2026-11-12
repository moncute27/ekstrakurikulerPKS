<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('backend.admin_profile', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:user,username,' . $user->id,
            'email' => 'nullable|email|max:100',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;

        if (!empty($request->new_password)) {
            if (!empty($request->current_password) && !Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak cocok!'])->withInput();
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('admin.admin-profile')->with('success', 'Profil Admin berhasil diperbarui!');
    }
}
