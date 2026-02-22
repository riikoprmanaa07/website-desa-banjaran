@extends('layout.app')

@section('title', $news['title'] . ' - Desa Banjaran')

@section('content')

{{-- Hero / Header --}}
<div class="bg-desa-dark pt-32 pb-28 relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid)" />
        </svg>
    </div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-desa-gold/10 rounded-full -mr-24 -mt-24 blur-3xl"></div>

    <div class="max-w-4xl mx-auto px-6 text-center text-white relative z-10">
        <span class="inline-block bg-desa-gold text-desa-dark font-extrabold text-xs px-4 py-1.5 rounded-full mb-6 tracking-widest uppercase">
            {{ $news['category'] }}
        </span>
        <h1 class="text-3xl md:text-5xl font-extrabold leading-tight mb-8 tracking-tight">
            {{ $news['title'] }}
        </h1>
        <div class="flex items-center justify-center flex-wrap gap-6 text-sm text-gray-400 font-medium">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4 text-desa-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $news['date'] }}
            </span>
            <span class="text-gray-600">•</span>
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4 text-desa-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Admin Desa Banjaran
            </span>
            <span class="text-gray-600">•</span>
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4 text-desa-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                {{ $news['views'] ?? 0 }} kali dilihat
            </span>
        </div>
    </div>
</div>

{{-- Main Content --}}
<section class="py-20 bg-gray-50 -mt-10">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            {{-- Article --}}
            <div class="lg:col-span-2 space-y-6">
                <article class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                    {{-- Featured Image --}}
                    <div class="relative h-80 md:h-[420px] w-full overflow-hidden">
                        <img src="{{ $news['image'] }}" alt="{{ $news['title'] }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>

                    {{-- Content --}}
                    <div class="p-8 md:p-12">
                        {{-- Excerpt / Lead --}}
                        <p class="text-lg text-gray-600 font-medium leading-relaxed mb-8 pb-8 border-b border-gray-100 italic">
                            {{ $news['excerpt'] }}
                        </p>

                        {{-- Article Body --}}
                        <div class="prose prose-lg prose-gray max-w-none text-gray-700 leading-loose">
                            {!! nl2br(e($news['content'])) !!}
                        </div>

                        {{-- Share --}}
                        <div class="mt-12 pt-8 border-t border-gray-100">
                            <h4 class="font-bold text-desa-dark mb-4 text-sm uppercase tracking-widest text-gray-400">Bagikan Artikel</h4>
                            <div class="flex flex-wrap gap-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                   target="_blank"
                                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 transition-colors">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                                    Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?text={{ urlencode($news['title']) }}&url={{ urlencode(url()->current()) }}"
                                   target="_blank"
                                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-500 text-white rounded-xl text-sm font-bold hover:bg-sky-600 transition-colors">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
                                    Twitter
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($news['title'] . ' - ' . url()->current()) }}"
                                   target="_blank"
                                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-green-500 text-white rounded-xl text-sm font-bold hover:bg-green-600 transition-colors">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M11.99 2C6.473 2 2 6.473 2 11.99a9.986 9.986 0 001.374 5.102L2 22l5.02-1.354A9.952 9.952 0 0011.99 22c5.518 0 9.99-4.473 9.99-9.99C21.98 6.473 17.508 2 11.99 2z"/></svg>
                                    WhatsApp
                                </a>
                                <button onclick="navigator.clipboard.writeText(window.location.href).then(() => alert('Link disalin!'))"
                                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl text-sm font-bold hover:bg-gray-200 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    Salin Link
                                </button>
                            </div>
                        </div>
                    </div>
                </article>

                {{-- Back Button --}}
                <div>
                    <a href="{{ route('news') }}"
                       class="inline-flex items-center gap-2 text-gray-500 font-bold hover:text-desa-gold transition-colors group">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Daftar Berita
                    </a>
                </div>
            </div>

            {{-- Sidebar --}}
            <aside class="space-y-8">

                {{-- Related News --}}
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-7 sticky top-24">
                    <h3 class="text-lg font-extrabold text-desa-dark mb-6 pb-4 border-b border-gray-100 flex items-center gap-2">
                        <span class="w-1 h-5 bg-desa-gold rounded-full inline-block"></span>
                        Berita Terkait
                    </h3>

                    @if($relatedNews->isEmpty())
                        <p class="text-sm text-gray-400 text-center py-6">Tidak ada berita terkait.</p>
                    @else
                    <div class="space-y-5">
                        @foreach($relatedNews as $related)
                        <a href="{{ route('news.show', $related['id']) }}" class="group flex gap-4 items-start">
                            <div class="w-20 h-20 flex-shrink-0 rounded-xl overflow-hidden bg-gray-100">
                                <img src="{{ $related['image'] }}" alt="{{ $related['title'] }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="flex-1 min-w-0">
                                <span class="text-xs font-bold text-desa-gold uppercase tracking-wide">{{ $related['category'] }}</span>
                                <h4 class="font-bold text-desa-dark text-sm leading-snug mt-1 group-hover:text-desa-gold transition-colors line-clamp-2">
                                    {{ $related['title'] }}
                                </h4>
                                <span class="text-xs text-gray-400 mt-1.5 block flex items-center gap-1">
                                    <svg class="w-3 h-3 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $related['date'] }}
                                </span>
                            </div>
                        </a>
                        @if(!$loop->last)
                        <div class="border-t border-gray-50"></div>
                        @endif
                        @endforeach
                    </div>
                    @endif
                </div>

               

            </aside>
        </div>
    </div>
</section>

@endsection