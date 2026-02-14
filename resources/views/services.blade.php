@extends('layout.app')

@section('title', 'Layanan - Desa Banjaran')

@section('content')

<section class="bg-desa-dark text-white pt-32 pb-20 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-desa-gold/10 rounded-full -mr-16 -mt-16 blur-3xl"></div>
    
    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
        
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Layanan Desa</h1>
        <p class="text-gray-300 max-w-2xl mx-auto text-lg font-light">
            Berbagai layanan administrasi untuk kemudahan warga.
        </p>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col h-full hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group overflow-hidden">
                
                <div class="p-8 flex-grow">
                    <div class="w-14 h-14 bg-desa-gold/10 rounded-xl flex items-center justify-center text-3xl mb-6 text-desa-dark group-hover:bg-desa-gold group-hover:text-white transition-colors duration-300">
                        {{ $service['icon'] }}
                    </div>
                    
                    <h3 class="text-xl font-bold text-desa-dark mb-3 group-hover:text-desa-gold transition-colors">{{ $service['title'] }}</h3>
                    <p class="text-gray-500 text-sm mb-6 leading-relaxed">{{ $service['description'] }}</p>
                    
                    <div class="bg-gray-50 rounded-lg p-5 border border-gray-100">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-3">Persyaratan:</h4>
                        <ul class="space-y-2">
                            @foreach($service['requirements'] as $requirement)
                            <li class="flex items-start text-sm text-gray-600">
                                <span class="text-desa-gold mr-2 text-xs mt-1">●</span>
                                {{ $requirement }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                
                <div class="px-8 py-4 border-t border-gray-50 bg-gray-50/50 flex justify-between items-center text-sm">
                    <span class="flex items-center text-gray-500 font-medium text-xs">
                        ⏱️ Estimasi: 1-3 Hari
                    </span>
                    <span class="font-bold text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full uppercase tracking-wide">
                        Biaya : RP 100K
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection