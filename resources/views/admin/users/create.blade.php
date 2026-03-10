@extends('layout.admin')

@section('title', 'Tambah Admin Baru')
@section('page-title', 'Tambah Admin Baru')
@section('page-subtitle', 'Buat akun admin atau super admin baru')

@section('content')
<div class="max-w-2xl">

    {{-- Back --}}
    <a href="{{ route('admin.users.index') }}"
       class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-800 mb-6 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Admin
    </a>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="px-8 py-5 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800 text-lg">Informasi Akun</h3>
            <p class="text-sm text-gray-500 mt-0.5">Isi semua kolom dengan lengkap dan benar</p>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="px-8 py-6 space-y-5">
            @csrf

            {{-- Nama --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name"
                       value="{{ old('name') }}"
                       placeholder="Contoh: Budi Santoso"
                       class="w-full border @error('name') border-red-400 bg-red-50 @else border-gray-200 @enderror rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-desa-gold focus:border-transparent transition"
                       required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                <input type="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="contoh@desa.go.id"
                       class="w-full border @error('email') border-red-400 bg-red-50 @else border-gray-200 @enderror rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-desa-gold focus:border-transparent transition"
                       required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
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
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                       placeholder="Ulangi password"
                       class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-desa-gold focus:border-transparent transition"
                       required>
            </div>

            {{-- Role --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Role</label>
                <select name="role"
                        class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-desa-gold focus:border-transparent transition bg-white"
                        required>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="super_admin" {{ old('role') === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                </select>
                <p class="text-xs text-gray-400 mt-1.5">Super Admin dapat mengelola akun admin lain.</p>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="bg-desa-gold hover:bg-yellow-600 text-white font-semibold px-6 py-2.5 rounded-lg transition text-sm">
                    Simpan Akun
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