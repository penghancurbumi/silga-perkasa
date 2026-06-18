<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'thumbnail',
        'status',         
        'category_id',
        'author_id',
        'published_at',
    ];

    
    /*fungsi untuk mengubah tipe data otomatis*/
    protected $casts = [
        'published_at' => 'datetime',
        'scheduled_at' => 'datetime',
    ];

    /* Relationships */

    /*post di miliki oleh 1 user*/
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    
    /*1 post memiliki 1 category*/
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    /*user post memiliki banyak komen*/
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /* Scopes */

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    public function scopeByAuthor($query, int $authorId)
    {
        return $query->where('author_id', $authorId);
    }

    /* Accessors & Mutators */

    /**
     * Auto-generate slug jika tidak diisi.
     */
    protected static function booted(): void
    {
        static::creating(function (Post $post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function getIsPublishedAttribute(): bool
    {
        return $this->status === 'published';
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'published' => 'Terpublikasi',
            'draft'     => 'Draft',
            'scheduled' => 'Terjadwal',
            default     => ucfirst($this->status),
        };
    }
}