@extends('layout.app')

@section('title', 'Profil Desa - Desa Banjaran')

@section('content')

<<section class="bg-desa-dark text-white pt-32 pb-20 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-desa-gold/10 rounded-full -mr-16 -mt-16 blur-3xl"></div>
    
    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
        
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Struktur Desa Banjaran</h1>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-12">

       
       

        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-10">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-desa-dark mt-2">Perangkat Desa</h2>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($structure as $person)
                <div class="group text-center">
                    <div class="relative w-32 h-32 mx-auto mb-4">
                        <div class="w-full h-full rounded-full bg-gray-100 flex items-center justify-center text-4xl overflow-hidden border-4 border-white shadow-md group-hover:border-desa-gold transition-colors duration-300">
                            👤
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-desa-dark group-hover:text-desa-gold transition-colors">{{ $person['name'] }}</h3>
                    <p class="text-sm text-gray-500 uppercase tracking-wide mt-1">{{ $person['position'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>
@endsection