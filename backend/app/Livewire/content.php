<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class Content extends Component
{
    public string $activeTab = 'semua';

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }
    
    public function render()
    {
        return view('pages.content', [
            'posts' => Post::with(['author','category'])->paginate(10)
        ]) ->layout('layouts.app');
    }
}