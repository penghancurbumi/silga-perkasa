<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Category;
use App\Models\ActivityLog;
use App\Notifications\ArticleNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon; 
use Mews\Purifier\Facades\Purifier;

class ContentCreate extends Component
{
    use WithFileUploads;

    public $title;
    public $existingThumbnail = null; 
    public $slug;
    public $content;
    public $category_id;
    public $published_at;
    public $thumbnail;
    public $categories = [];

    protected $messages = [
        'title.required'        => 'Judul wajib diisi',
        'slug.required'         => 'Slug wajib diisi',
        'slug.unique'           => 'Slug sudah digunakan',
        'content.required'      => 'Konten wajib diisi',
        'thumbnail.required'    => 'Thumbnail wajib diisi',
        'category_id.required'  => 'Kategori wajib diisi',
        'published_at.required' => 'Tanggal publikasi wajib diisi',
    ];

    public function mount()
    {
        $this->categories = Category::orderBy('name')->get();
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function save($status)
    {
        $rules = [
            'title'        => 'required|string|max:255',
            'slug'         => 'required|unique:posts,slug',
            'content'      => 'required',
            'category_id'  => 'required|exists:categories,id',
            'thumbnail'    => 'required|image|max:10240',
            'published_at' => 'required',
        ];

        // Draft: thumbnail & published_at tidak wajib
        if ($status === 'draft') {
            $rules['thumbnail']    = 'nullable|image|max:10240';
            $rules['published_at'] = 'nullable';
        }

        $validator = Validator::make(
            [
                'title'        => $this->title,
                'slug'         => $this->slug,
                'content'      => $this->content,
                'category_id'  => $this->category_id,
                'thumbnail'    => $this->thumbnail,
                'published_at' => $this->published_at,
            ],
            $rules,
            $this->messages
        );

        $content =Purifier::clean($this->content, 'quill');

        if (strip_tags($content) == ''){
            $this->addError('content','Konten wajib diisi');
            return;
        }

        try {
            $thumbnailPath = $this->thumbnail?->store('thumbnails', 'public');

            $post = Post::create([
                'title'        => $this->title,
                'slug'         => $this->slug,
                'content'      => $content,
                'category_id'  => $this->category_id,
                'published_at' => $this->published_at,
                'status'       => $status,
                'author_id'    => auth()->id(),
                'thumbnail'    => $thumbnailPath,
            ]);

            $statusLabel = match($status) {
                'published' => 'dipublikasikan',
                'draft'     => 'disimpan sebagai draft',
                'scheduled' => 'dijadwalkan',
                default     => $status,
            };

            $titleSnapshot = $this->title;

            ActivityLog::create([
                'user_id'     => Auth::id(),
                'type'        => 'create_post',
                'description' => 'Artikel "' . $titleSnapshot . '" ' . $statusLabel,
                'ip_address'  => request()->ip(),
            ]);

            auth()->user()->notify(new ArticleNotification(
                message: 'Artikel "' . $titleSnapshot . '" berhasil ' . $statusLabel,
                type: $status,
                post: $post,
            ));

            $this->reset(['title', 'slug', 'content', 'category_id', 'thumbnail', 'published_at']);
            $this->resetErrorBag();

            $this->dispatch($status . '-success');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Content Create Error: ' . $e->getMessage());
            $this->dispatch($status . '-error-1');
        }
    }

    public function render()
    {
        return view('livewire.content-create');
    }
}