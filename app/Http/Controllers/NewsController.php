<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = Berita::published()  // pakai scope dari model Anda
            ->orderByDesc('published_at')
            ->get()
            ->map(fn($item) => $this->format($item));

        return view('news.index', compact('news'));
    }

    public function show($id)
    {
        $berita = Berita::published()->findOrFail($id);

        $berita->incrementViews(); // pakai method dari model Anda

        $relatedNews = Berita::published()
            ->where('id', '!=', $id)
            ->where('kategori', $berita->kategori)
            ->latest('published_at')
            ->take(3)
            ->get()
            ->map(fn($item) => $this->format($item));

        // Tambah dari kategori lain jika kurang dari 3
        if ($relatedNews->count() < 3) {
            $existing = $relatedNews->pluck('id')->push($id)->toArray();
            $extra = Berita::published()
                ->whereNotIn('id', $existing)
                ->latest('published_at')
                ->take(3 - $relatedNews->count())
                ->get()
                ->map(fn($item) => $this->format($item));
            $relatedNews = collect($relatedNews->all())->merge(collect($extra->all()));
        }

        $news = $this->format($berita);

        return view('news.show', compact('news', 'relatedNews'));
    }

    private function format(Berita $item): array
    {
        return [
            'id'       => $item->id,
            'title'    => $item->judul,
            'excerpt'  => $item->excerpt,
            'content'  => $item->konten,
            'image'    => $item->gambar_url,        // pakai accessor dari model Anda
            'date'     => $item->tanggal_publish,   // pakai accessor dari model Anda
            'category' => $item->kategori,
            'views'    => $item->views,
        ];
    }
}