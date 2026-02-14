@extends('layout.app')

@section('title', $news['title'] . ' - Desa Banjaran')

@section('content')

<div class="bg-desa-dark pt-32 pb-20">
    <div class="max-w-4xl mx-auto px-6 text-center text-white">
        <span class="inline-block bg-desa-gold text-desa-dark font-bold text-xs px-3 py-1 rounded mb-4">{{ $news['category'] }}</span>
        <h1 class="text-3xl md:text-5xl font-extrabold leading-tight mb-6">{{ $news['title'] }}</h1>
        <div class="flex items-center justify-center gap-6 text-sm text-gray-300 font-medium">
            <span class="flex items-center gap-2">📅 {{ $news['date'] }}</span>
            <span class="flex items-center gap-2">✍️ Admin Desa</span>
        </div>
    </div>
</div>

<section class="py-20 bg-gray-50 -mt-10">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <div class="lg:col-span-2">
                <article class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                    <div class="h-96 w-full overflow-hidden">
                        <img src="{{ $news['image'] }}" alt="{{ $news['title'] }}" class="w-full h-full object-cover">
                    </div>
                    
                    <div class="p-8 md:p-12">
                        <div class="prose prose-lg prose-gray max-w-none text-gray-700 leading-loose">
                            {!! nl2br(e($news['content'])) !!}
                        </div>

                        <div class="mt-12 pt-8 border-t border-gray-100">
                            <h4 class="font-bold text-desa-dark mb-4 text-sm uppercase tracking-wide">Bagikan Artikel:</h4>
                            <div class="flex gap-3">
                                <a href="#" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-bold hover:bg-blue-700 transition">Facebook</a>
                                <a href="#" class="px-5 py-2.5 bg-sky-500 text-white rounded-lg text-sm font-bold hover:bg-sky-600 transition">Twitter</a>
                                <a href="#" class="px-5 py-2.5 bg-green-500 text-white rounded-lg text-sm font-bold hover:bg-green-600 transition">WhatsApp</a>
                            </div>
                        </div>
                    </div>
                </article>

                <div class="mt-8">
                    <a href="{{ route('news') }}" class="inline-flex items-center text-gray-500 font-bold hover:text-desa-gold transition">
                        ← Kembali ke Daftar Berita
                    </a>
                </div>
            </div>

            <aside class="space-y-8">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 sticky top-24">
                    <h3 class="text-xl font-bold text-desa-dark mb-6 border-b border-gray-100 pb-4">Berita Terkait</h3>
                    <div class="space-y-6">
                        @foreach($relatedNews as $related)
                        <a href="{{ route('news.show', $related['id']) }}" class="group flex gap-4 items-start">
                            <div class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden bg-gray-200">
                                <img src="{{ $related['image'] }}" alt="{{ $related['title'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div>
                                <h4 class="font-bold text-desa-dark text-sm leading-snug group-hover:text-desa-gold transition-colors line-clamp-2">
                                    {{ $related['title'] }}
                                </h4>
                                <span class="text-xs text-gray-400 mt-2 block">{{ $related['date'] }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </aside>

        </div>
    </div>
</section>
@endsection