<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;

class contentCreate extends Component
{
    public $title;
    public $slug;
    public $content;
    public $category_id;
    public $status;
    public $visibility;
    public $thumbnail;
    public $published_at;
    public $scheduled_at;

    public function updateTitle($value)
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:posts,slug',
            'content' => 'nullalle|string',
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
            ''
        ]);
    }
}