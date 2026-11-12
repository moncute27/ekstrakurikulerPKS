<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\UploadGambar;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller implements HasMiddleware
{
    /**
     * Manajemen pengguna hanya boleh diakses oleh admin.
     */
    public static function middleware(): array
    {
        return [
            new Middleware(function ($request, $next) {
                abort_unless($request->user()?->isAdmin(), 403, 'Hanya admin yang dapat mengelola pengguna.');

                return $next($request);
            }),
        ];
    }

    public function index(Request $request)
    {
        $cari = $request->query('cari');

        return view('admin.user.index', [
            'users' => User::query()
                ->when($cari, fn ($q) => $q->where(fn ($s) => $s
                    ->where('name', 'like', "%{$cari}%")
                    ->orWhere('email', 'like', "%{$cari}%")))
                ->orderBy('name')
                ->paginate(10)
                ->withQueryString(),
            'cari' => $cari,
        ]);
    }

    public function create()
    {
        return view('admin.user.form', ['item' => new User(['role' => User::ROLE_PENGURUS])]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', Rule::in(User::ROLES)],
            'password' => ['required', 'confirmed', Password::min(8)],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $data['foto'] = UploadGambar::simpan($request->file('foto'), 'user');

        User::create($data);

        return redirect()->route('admin.user.index')->with('sukses', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.user.form', ['item' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => ['required', Rule::in(User::ROLES)],
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // Jangan sampai admin terakhir kehilangan hak aksesnya.
        if ($user->isAdmin() && $data['role'] !== User::ROLE_ADMIN && User::where('role', User::ROLE_ADMIN)->count() <= 1) {
            return back()->withInput()->withErrors(['role' => 'Minimal harus ada satu akun admin.']);
        }

        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        $data['foto'] = UploadGambar::simpan($request->file('foto'), 'user', $user->foto);

        $user->update($data);

        return redirect()->route('admin.user.index')->with('sukses', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->id === $request->user()->id) {
            return back()->withErrors(['user' => 'Anda tidak dapat menghapus akun sendiri.']);
        }

        if ($user->isAdmin() && User::where('role', User::ROLE_ADMIN)->count() <= 1) {
            return back()->withErrors(['user' => 'Minimal harus ada satu akun admin.']);
        }

        UploadGambar::hapus($user->foto);
        $user->delete();

        return redirect()->route('admin.user.index')->with('sukses', 'Pengguna berhasil dihapus.');
    }
}
