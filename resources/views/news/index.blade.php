@extends('layout.app')

@section('title', 'Berita - Desa Banjaran')

@section('content')

{{-- Hero Section --}}
<section class="bg-desa-dark text-white pt-32 pb-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
    </div>
    <div class="absolute top-0 right-0 w-64 h-64 bg-desa-gold/10 rounded-full -mr-16 -mt-16 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-desa-gold/5 rounded-full -ml-12 -mb-12 blur-2xl"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">

       
       <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Berita Terkini</h1>
        <p class="text-gray-400 text-base max-w-xl mx-auto">
            Informasi terbaru seputar kegiatan, pembangunan, dan program Desa Banjaran.
        </p>
    </div>
</section>


{{-- News Grid --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        @if($news->isEmpty())
            <div class="text-center py-24">
                <div class="text-6xl mb-4">📰</div>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">Belum Ada Berita</h3>
                <p class="text-gray-400">Berita akan segera ditampilkan di sini.</p>
            </div>
        @else

        {{-- Featured Post (first item) --}}
        @php $featured = $news->first(); $rest = $news->skip(1); @endphp

        <div class="mb-12">
            <a href="{{ route('news.show', $featured['id']) }}" class="group grid grid-cols-1 lg:grid-cols-2 bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-500">
                <div class="relative h-72 lg:h-full overflow-hidden min-h-[320px]">
                    <img src="{{ $featured['image'] }}" alt="{{ $featured['title'] }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                    <span class="absolute top-5 left-5 bg-desa-gold text-desa-dark text-xs font-extrabold px-3 py-1.5 rounded-full tracking-wide uppercase">
                        {{ $featured['category'] }}
                    </span>
                   
                </div>
                <div class="p-10 lg:p-14 flex flex-col justify-center">
                    <div class="flex items-center text-xs text-gray-400 mb-5 font-medium gap-4">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $featured['date'] }}
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            {{ $featured['views'] ?? 0 }} dilihat
                        </span>
                    </div>
                    <h2 class="text-2xl lg:text-3xl font-extrabold text-desa-dark mb-4 leading-tight group-hover:text-desa-gold transition-colors duration-300">
                        {{ $featured['title'] }}
                    </h2>
                    <p class="text-gray-500 leading-relaxed mb-8 line-clamp-3">
                        {{ $featured['excerpt'] }}
                    </p>
                    <div class="inline-flex items-center text-desa-dark font-bold text-sm group-hover:text-desa-gold transition-colors">
                        Baca Selengkapnya
                        <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </div>
                </div>
            </a>
        </div>

        {{-- Rest of News --}}
        @if($rest->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($rest as $item)
            <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group flex flex-col h-full">
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <span class="absolute top-4 left-4 bg-desa-dark/80 backdrop-blur-sm text-white text-xs font-bold px-3 py-1 rounded-full">
                        {{ $item['category'] }}
                    </span>
                </div>

                <div class="p-7 flex flex-col flex-grow">
                    <div class="flex items-center text-xs text-gray-400 mb-3 font-medium gap-3">
                        <span class="flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $item['date'] }}
                        </span>
                        @if(isset($item['views']))
                        <span class="flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            {{ $item['views'] }}
                        </span>
                        @endif
                    </div>

                    <h2 class="text-lg font-bold text-desa-dark mb-3 leading-snug group-hover:text-desa-gold transition-colors line-clamp-2">
                        <a href="{{ route('news.show', $item['id']) }}">{{ $item['title'] }}</a>
                    </h2>

                    <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-3 flex-grow">
                        {{ $item['excerpt'] }}
                    </p>

                    <div class="mt-auto pt-5 border-t border-gray-50 flex items-center justify-between">
                        <a href="{{ route('news.show', $item['id']) }}"
                           class="inline-flex items-center text-desa-dark font-bold text-sm hover:text-desa-gold transition-colors group/link">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-1.5 transition-transform duration-300 group-hover/link:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                       
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        @endif

        {{-- Pagination --}}
        @if($news instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="mt-16 flex justify-center">
            {{ $news->links() }}
        </div>
        @endif

        @endif
    </div>
</section>

@endsection