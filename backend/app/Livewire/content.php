<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;

class Content extends Component
{

 use WithFileUploads;

    public $title;
    public $slug;
    public $content;
    public $category_id;
    public $status;
    public $visibility;
    public $thumbnail;
    public $published_at;
    public $scheduled_at;

    public function store($status = 'draft')
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:posts,slug',
            'content' => 'nullable|string',
            'category' => 'nullable|exists:category,id',
            'thumbnail' => 'nullable|image|max:5120'
        ]);

        $thumbnailPath = null;
        if($this->thumbnail){
            $thumbnailPath = $this->thumbnail->store('thumbnail', 'public');
        }

        Post::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'category_id' => $this->category_id,
            'status' => $status,
            'visibility' => $this->visibility,
            'thumbnail' => $thumbnailPath,
            'author_id' => auth()->id(),
            'published_at' => $status === 'published' ? now() : null,
            'scheduled_at' => $status === 'scheduled' ? $this->scheduled_at : null
        ]);

        $this->reset();
        $this->dispatch('postCreated');
        session()->flash('Success', 'Artikel sudah di simpan');
    }

    public function render()
    {
        return view('pages.content',[
            'posts' => Post::with(['author', 'category'])->paginate(10),
            'categories' => Category::orderBy('name')->get()
        ])->layout('layouts.app');
    }

    public string $activeTab = 'semua';

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }
}