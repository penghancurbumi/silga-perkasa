<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class Content extends Component
{
    public $activeTab = 'semua';
    
    public function render()
    {
        return view('pages.content', [
            'posts' => Post::with(['author','ctegory'])->paginate(10)
        ]) ->layout('layouts.app');
    }
}