<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class ContentCreate extends Component
{
    public $title;
    public $slug;
    public $content;
    public $category_id;
    public $published_at;
    public $categories = [];

    public function mount(){
        $this->categories = Category::orderBy('name')->get();
    }

    public function save($status)
    {
        dd($status);

        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|unique:posts,slug',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Post::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'category_id' => $this->category_id,
            'published_at' => $this->published_at,
            'status' => $status,
        ]);

        return redirect()->route('content');
    }

    public function render()
    {
        return view('pages.content-create');
    }
}