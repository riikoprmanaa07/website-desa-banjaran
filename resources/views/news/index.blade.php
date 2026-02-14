@extends('layout.app')

@section('title', 'Berita - Desa Banjaran')

@section('content')

<section class="bg-desa-dark text-white pt-32 pb-20 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-desa-gold/10 rounded-full -mr-16 -mt-16 blur-3xl"></div>
    
    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
        
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Berita</h1>
        <p class="text-gray-300 max-w-2xl mx-auto text-lg font-light">
            Informasi terbaru seputar kegiatan, pembangunan, dan program desa.
        </p>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($news as $item)
            <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col h-full">
                <div class="relative h-60 overflow-hidden">
                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <span class="absolute top-4 left-4 bg-desa-dark text-white text-xs font-bold px-3 py-1 rounded shadow-md">
                        {{ $item['category'] }}
                    </span>
                </div>
                
                <div class="p-8 flex flex-col flex-grow">
                    <div class="flex items-center text-xs text-gray-400 mb-4 font-medium">
                        <span class="flex items-center gap-1">📅 {{ $item['date'] }}</span>
                    </div>
                    
                    <h2 class="text-xl font-bold text-desa-dark mb-3 leading-snug group-hover:text-desa-gold transition-colors line-clamp-2">
                        <a href="{{ route('news.show', $item['id']) }}">{{ $item['title'] }}</a>
                    </h2>
                    
                    <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-3 flex-grow">
                        {{ $item['excerpt'] }}
                    </p>
                    
                    <div class="mt-auto pt-6 border-t border-gray-50">
                        <a href="{{ route('news.show', $item['id']) }}" class="inline-flex items-center text-desa-dark font-bold text-sm hover:text-desa-gold transition-colors">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        
        <div class="mt-16 text-center">
            </div>
    </div>
</section>
@endsection