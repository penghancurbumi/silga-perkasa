<?php

namespace App\Livewire;

use Livewire\Component;

class Content extends Component
{
    public $activeTab = 'semua';
    
    public function render()
    {
        return view('pages.content')
            ->layout('layouts.app');
    }
}