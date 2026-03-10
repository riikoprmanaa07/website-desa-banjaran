<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureSuperAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Menggunakan session — sesuai sistem auth Anda
        if (session('admin_role') !== 'super_admin') {
            abort(403, 'Akses ditolak. Hanya Super Admin yang diizinkan.');
        }

        return $next($request);
    }
}

