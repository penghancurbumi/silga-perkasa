<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Application; // Asumsi model bernama Application atau application

class Lamaran extends Component
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
        $query = Application::query(); // Jika perlu relasi bisa ditambahkan ->with(['applicant', 'lowongan'])

        if ($this->statusFilter !== 'filter') {
            $query->where('status', $this->statusFilter);
        }

        $lamarans = $query->latest('applied_at')->paginate(10);

        return view('livewire.lamaran', [
            'lamarans' => $lamarans
        ]);
    }
}
