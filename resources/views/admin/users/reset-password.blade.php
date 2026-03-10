@extends('layout.admin')

@section('title', 'Reset Password Admin')
@section('page-title', 'Reset Password')
@section('page-subtitle', 'Atur ulang password akun admin')

@section('content')
<div class="max-w-lg">

    {{-- Back --}}
    <a href="{{ route('admin.users.index') }}"
       class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-800 mb-6 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Admin
    </a>

    {{-- Info Akun --}}
    <div class="bg-yellow-50 border border-yellow-200 rounded-xl px-5 py-4 mb-5 flex items-center gap-4">
        <div class="w-11 h-11 rounded-full bg-desa-gold flex items-center justify-center text-white font-bold text-lg shrink-0">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div>
            <p class="font-semibold text-gray-800">{{ $user->name }}</p>
            <p class="text-sm text-gray-500">{{ $user->email }}</p>
            <span class="inline-block mt-1 text-xs font-semibold px-2 py-0.5 rounded-full
                {{ $user->role === 'super_admin' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600' }}">
                {{ $user->role }}
            </span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="px-8 py-5 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800 text-lg">Password Baru</h3>
            <p class="text-sm text-gray-500 mt-0.5">Password lama akan langsung diganti setelah disimpan</p>
        </div>

        <form action="{{ route('admin.users.reset-password.update', $user) }}" method="POST" class="px-8 py-6 space-y-5">
            @csrf

            {{-- Password Baru --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password Baru</label>
                <input type="password" name="password"
                       placeholder="Minimal 8 karakter"
                       class="w-full border @error('password') border-red-400 bg-red-50 @else border-gray-200 @enderror rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-desa-gold focus:border-transparent transition"
                       required>
                @error('password')
                    <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation"
                       placeholder="Ulangi password baru"
                       class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-desa-gold focus:border-transparent transition"
                       required>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="bg-desa-gold hover:bg-yellow-600 text-white font-semibold px-6 py-2.5 rounded-lg transition text-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                    Simpan Password
                </button>
                <a href="{{ route('admin.users.index') }}"
                   class="text-gray-500 hover:text-gray-800 font-medium text-sm transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>
@endsection