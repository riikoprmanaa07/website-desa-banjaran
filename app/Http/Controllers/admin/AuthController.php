<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = AdminUser::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            session([
                'admin_logged_in' => true,
                'admin_id' => $admin->id,
                'admin_name' => $admin->name,
                'admin_email' => $admin->email,
                'admin_role' => $admin->role,
            ]);

            return redirect()->route('admin.dashboard')
                ->with('success', 'Selamat datang, ' . $admin->name);
        }

        return back()
            ->withInput($request->only('email'))
            ->with('error', 'Email atau password salah');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('admin.login')
            ->with('success', 'Berhasil logout');
    }
}