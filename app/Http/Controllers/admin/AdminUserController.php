<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminUserController extends Controller
{
    // Tampilkan daftar semua admin
    public function index()
    {
        $admins = AdminUser::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('admins'));
    }

    // Tampilkan form tambah admin baru
    public function create()
    {
        return view('admin.users.create');
    }

    // Simpan admin baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admin_users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'role'     => 'required|in:admin,super_admin',
        ]);

        AdminUser::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun admin berhasil ditambahkan.');
    }

    // Hapus akun admin
    public function destroy(AdminUser $user)
    {
        // ✅ Pakai session('admin_id') — sesuai sistem auth Anda
        if ($user->id === session('admin_id')) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun admin berhasil dihapus.');
    }

    // Tampilkan form reset password
    public function showResetForm(AdminUser $user)
    {
        return view('admin.users.reset-password', compact('user'));
    }

    // Proses reset password
    public function resetPassword(Request $request, AdminUser $user)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Password berhasil direset.');
    }
}
