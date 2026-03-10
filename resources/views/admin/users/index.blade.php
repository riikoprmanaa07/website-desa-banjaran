@extends('layout.admin')

@section('title', 'Manajemen Akun Admin')
@section('page-title', 'Manajemen Akun')
@section('page-subtitle', 'Kelola akun admin dan super admin website desa')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <p class="text-gray-500 text-sm">Total <span class="font-bold text-gray-700">{{ $admins->count() }}</span> akun terdaftar</p>
        </div>
        <a href="{{ route('admin.users.create') }}"
           class="inline-flex items-center justify-center gap-2 bg-desa-gold hover:bg-yellow-600 text-white font-semibold px-5 py-2.5 rounded-lg transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Admin
        </a>
    </div>

    {{-- Tabel --}}
    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-desa-dark text-white text-left">
                    <th class="px-6 py-4 font-semibold w-10">#</th>
                    <th class="px-6 py-4 font-semibold">Nama</th>
                    <th class="px-6 py-4 font-semibold">Email</th>
                    <th class="px-6 py-4 font-semibold">Role</th>
                    <th class="px-6 py-4 font-semibold">Dibuat</th>
                    <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                {{-- Urutkan agar Super Admin selalu di atas --}}
                @forelse($admins->sortByDesc('role') as $admin)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-gray-400">{{ $loop->iteration }}</td>

                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-white text-sm shrink-0
                                {{ $admin->role === 'super_admin' ? 'bg-red-500' : 'bg-desa-gold' }}">
                                {{ strtoupper(substr($admin->name, 0, 1)) }}
                            </div>
                            <div>
                                {{-- Gunakan ucwords agar format nama selalu Title Case --}}
                                <p class="font-semibold text-gray-800">{{ ucwords(strtolower($admin->name)) }}</p>
                                @if($admin->id === session('admin_id'))
                                    <span class="text-xs text-blue-500 font-medium">● Anda</span>
                                @endif
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-4 text-gray-600">{{ $admin->email }}</td>

                    <td class="px-6 py-4">
                        @if($admin->role === 'super_admin')
                            <span class="inline-flex items-center gap-1 bg-red-50 text-red-600 border border-red-200 text-xs font-semibold px-2.5 py-1 rounded-full">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                Super Admin
                            </span>
                        @else
                            <span class="inline-flex items-center bg-gray-50 text-gray-600 border border-gray-200 text-xs font-semibold px-2.5 py-1 rounded-full">
                                Admin
                            </span>
                        @endif
                    </td>

                    <td class="px-6 py-4 text-gray-500">{{ $admin->created_at->format('d M Y') }}</td>

                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.users.reset-password', $admin) }}"
                               class="flex items-center gap-1.5 bg-yellow-50 hover:bg-yellow-100 text-yellow-700 text-xs font-semibold px-3 py-1.5 rounded-lg transition border border-yellow-200">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                </svg>
                                Reset
                            </a>

                            @if($admin->id !== session('admin_id'))
                            <form action="{{ route('admin.users.destroy', $admin) }}" method="POST"
                                  onsubmit="return confirm('Hapus akun {{ ucwords(strtolower($admin->name)) }}? Tindakan ini tidak dapat dibatalkan.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="flex items-center justify-center gap-1.5 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-semibold px-3 py-1.5 rounded-lg transition border border-red-200 min-w-[85px]">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                            @else
                            {{-- Modifikasi strip agar memiliki lebar (min-w-[85px]) setara dengan tombol hapus sehingga sejajar --}}
                            <span class="flex items-center justify-center text-gray-300 px-3 py-1.5 font-bold min-w-[85px] border border-transparent">—</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center gap-3 text-gray-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <p class="font-medium">Belum ada akun admin</p>
                            <a href="{{ route('admin.users.create') }}" class="text-desa-gold hover:underline text-sm">Tambah sekarang</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection