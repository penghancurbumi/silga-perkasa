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
    public $thumbnail;
    public $published_at;
    public $scheduled_at;
    public $filterKategori ='';
    public $filterUrutan = 'terbaru';

    //edit
    public $editId = null;
    public $editTitle;
    public $editSlug;
    public $editContent;
    public $editCategoryId;
    public $editThumbnail;
    public $editPublishedAt;
    
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        $this->editId       = $post->id;
        $this->editTitle    = $post->title;
        $this->editSlug     = $post->slug;
        $this->editContent  = $post->content;
        $this->editCategoryId = $post->category_id;
        $this->editPublishedAt = $post->published_at;
    }

    public function update()
    {
        try{
            $this->validate([
                'editTitle' => 'required|string|max:255',
                'editSlug' => 'required|string|unique:posts,slug,id,' . $this->editId,
                'editContent' => 'nullable|string',
                'editCategoryId' => 'nullable|exists:categories,id',
                'editThumbnail' => 'nullable|image|max:5120'
            ]);

            $post = Post::findOrFail($this->editId);

            $thumbnailPath = $post->thumbnail;
            if ($this->editThumbnail) {
                $thumbnailPath = $this->editThumbnail->store('thumbnails', 'public');
            }

            $post->update([
                'title'         => $this->editTitle,
                'slug'          => $this->editSlug,
                'content'       => $this->editContent,
                'category_id'   => $this->editCategoryId,
                'thumbnail'     => $thumbnailPath,
                'published_at'  => $this->editPublishedAt,  
            ]);

            $this->reset(['editId','editTitle', 'editSlug', 'editContent', 'editCategoryId', 'editThumbnail', 'editPublishedAt']);

            $this->dispatch('edit-success');
        
        }catch (\Illuminate\Validation\ValidationException $e){
            $this->dispatch('edit-error');
            throw $e;

        }catch (\Exception $e){
            $this->dispatch('edit-error');
        }
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

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function render()
    {   
        $query = Post::with(['author', 'category']);

        //filter category
        if($this->filterKategori){
            $query->where('category_id', $this->filterKategori);
        }

        //filter Terbaru 
        if($this->filterUrutan === 'Terbaru'){
            $query->latest();
        }elseif($this->filterUrutan === 'Terlama'){
            $query->oldest();
        }

        match($this->activeTab) {
            'terpublikasi' => $query->where('status', 'published'),
            'draft'        => $query->where('status', 'draft'),
            'terjadwal'    =>$query->where('status', 'scheduled'),
            default        => null,
        };
       
        return view('pages.content',[
            'posts' => $query->paginate(5),
            'categories' => Category::orderBy('name')->get(),
            'totalPosts' => Post::count(),
            'totalPublished' => Post::where('status', 'published')->count(),
            'totalDraft' => Post::where('status', 'draft')->count(),
            'totalViews' => Post::sum('views'),
        ])->layout('layouts.app');
    }
}