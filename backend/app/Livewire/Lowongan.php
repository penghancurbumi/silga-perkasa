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
    public $filterUrutan = 'terbaru';
    public $jobTypeFilter = 'filter';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingFilterUrutan()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Lowongans::with('jobCategory');

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%')
                  ->orWhereHas('jobCategory', function ($q) {
                      $q->where('name', 'like', '%' . $this->search . '%');
                  });
        }

        if ($this->statusFilter !== 'filter') {
            $query->where('status', $this->statusFilter);
        }

        if ($this->jobTypeFilter !== 'filter') {
            $query->where('employment_type', $this->jobTypeFilter);
        }

        if ($this->filterUrutan === 'terbaru') {
            $query->latest();
        } elseif ($this->filterUrutan === 'terlama') {
            $query->oldest();
        }

        $lowongans = $query->paginate(6);

        return view('livewire.lowongan', [
            'lowongans' => $lowongans
        ]);
    }
}
