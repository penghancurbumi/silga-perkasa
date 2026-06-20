<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;

class Content extends Component
{
    use WithFileUploads, WithPagination;

    protected $paginationTheme = 'tailwind';

    public $title;
    public $slug;
    public $content;
    public $category_id;
    public $status;
    public $thumbnail;
    public $published_at;
    public $scheduled_at;
    public $filterKategori ='';
    public $filterUrutan = 'terbaru';
    public $search = "";    

    public function edit($id)
    {
        return redirect()->route('content.edit', $id);
    }

    public function store($status)
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:posts,slug',
            'content' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
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
        session()->flash('success', 'Artikel sudah di simpan');
    }

    public string $activeTab = 'semua';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilterKategori(): void
    {
        $this->resetPage();
    }

    public function updatedFilterUrutan(): void
    {
        $this->resetPage();
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function render()
    {   
        $query = Post::with(['author', 'category']);

        //search input
        if($this->search){
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('content', 'like', '%' . $this->search . '%');
            });
        }

        //filter category
        if($this->filterKategori){
            $query->where('category_id', $this->filterKategori);
        }

        //filter Terbaru 
        if($this->filterUrutan === 'terbaru'){
            $query->latest();
        }elseif($this->filterUrutan === 'terlama'){
            $query->oldest();
        }

        match($this->activeTab) {
            'terpublikasi' => $query->where('status', 'published'),
            'draft'        => $query->where('status', 'draft'),
            'terjadwal'    =>$query->where('status', 'scheduled'),
            default        => null,
        };
       
        return view('livewire.content',[
            'posts' => $query->paginate(auth()->user()->getSetting('pagination_limit', 5)),
            'categories' => Category::orderBy('name')->get(),
            'totalPosts' => Post::count(),
            'totalPublished' => Post::where('status', 'published')->count(),
            'totalDraft' => Post::where('status', 'draft')->count(),
            'totalViews' => Post::sum('views'),
        ])->layout('layouts.app');
    }
}