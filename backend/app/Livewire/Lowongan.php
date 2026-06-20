<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Lowongan as Lowongans;

class Lowongan extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = 'filter';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Lowongans::query();

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('category', 'like', '%' . $this->search . '%');
        }

        if ($this->statusFilter !== 'filter') {
            $query->where('status', $this->statusFilter);
        }

        $lowongans = $query->latest()->paginate(10);

        return view('livewire.lowongan', [
            'lowongans' => $lowongans
        ]);
    }
}
