<?php

// Livewire Component
use App\Models\Category;

class NamaComponent extends Component
{
    public $category_id;
    
    public function render()
    {
        return view('livewire.nama-view', [
            'categories' => Category::all(), // ← ini wajib ada
        ]);
    }
}