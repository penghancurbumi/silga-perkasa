<?php

namespace App\Livewire;
use App\Models\JobCategory;

use Livewire\Component;

class LowonganCreate extends Component
{
    public $kualifikasi;
    public $status = 'draft';

    public function render()
    {
        $categories = JobCategory::all();
        return view('livewire.lowongan-create', [
            'categories' => $categories
        ]);
    }
}
