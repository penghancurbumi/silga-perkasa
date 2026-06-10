<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon; 

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
        'title.required' => 'Judul wajib diisi',
        'slug.required' => 'slug wajib diisi',
        'slug.unique' => 'slug sudah di gunakan',
        'content.required' => 'konten wajib di isi',
        'thumbnail.required' => 'thumbnail wajib di isi',
        'category_id.required' => 'kategori wajb di isi',
        'published_at.required' => 'tanggal publikasi wajib di isi',
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

        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|unique:posts,slug',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'required|image|max:5120',
            'published_at' => 'required'
        ]);

        $thumbnailPath = $this->thumbnail?->store('thumbnails', 'public');

        Post::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'category_id' => $this->category_id,
            'published_at' => $this->published_at,
            'status' => $status,
            'author_id' => auth()->id(),
            'thumbnail' => $thumbnailPath
        ]);

        return redirect()->route('content');
    }

    public function render()
    {
        return view('pages.content-create');
    }
}