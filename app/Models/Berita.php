<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
        'excerpt',
        'konten',
        'gambar',
        'kategori',
        'admin_user_id',
        'status',
        'views',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'views' => 'integer',
    ];

    // Relationships
    public function admin()
    {
        return $this->belongsTo(AdminUser::class, 'admin_user_id');
    }

    // Boot method
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->judul);
            }
            
            // Pastikan slug unik
            $count = 1;
            $originalSlug = $berita->slug;
            while (static::where('slug', $berita->slug)->exists()) {
                $berita->slug = $originalSlug . '-' . $count++;
            }
        });

        static::updating(function ($berita) {
            if ($berita->isDirty('judul')) {
                $slug = Str::slug($berita->judul);
                
                // Pastikan slug unik (kecuali untuk record ini sendiri)
                $count = 1;
                $originalSlug = $slug;
                while (static::where('slug', $slug)->where('id', '!=', $berita->id)->exists()) {
                    $slug = $originalSlug . '-' . $count++;
                }
                
                $berita->slug = $slug;
            }
        });
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'Published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'Draft');
    }

    // Accessors
    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/' . $this->gambar);
        }
        return asset('images/default-berita.jpg');
    }

    public function getStatusBadgeAttribute()
    {
        return $this->status == 'Published' 
            ? 'bg-green-100 text-green-800' 
            : 'bg-gray-100 text-gray-800';
    }

    public function getTanggalPublishAttribute()
    {
        if ($this->published_at) {
            return $this->published_at->format('d F Y');
        }
        return '-';
    }

    // Mutators
    public function incrementViews()
    {
        $this->increment('views');
    }
}