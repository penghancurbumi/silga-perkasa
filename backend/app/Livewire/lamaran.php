<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Application;
use App\Models\JobCategory;
use App\Models\Lowongan;

class Lamaran extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = 'filter';
    public $categoryFilter = '';
    public $dateFrom = '';
    public $dateTo = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetFilters(){
        $this->search = '';
        $this->statusFilter = 'filter';
        $this->categoryFilter = '';
        $this->dateFrom = '';
        $this->dateTo = '';
        $this->resetPage();
    }

    public function render()
    {
        $query = Application::query()->with(['applicant', 'lowongan']); 

        if (!empty($this->search)) {
            $query->whereHas('applicant', function($q) {
                $q->where('fullname', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->statusFilter !== 'filter') {
            $query->where('status', $this->statusFilter);
        }

        if ($this->categoryFilter !== '') {
            $query->whereHas('lowongan', function($q) {
                $q->where('title', $this->categoryFilter);
            });
        }

        if (!empty($this->dateFrom))
        {
            $query->whereDate('applied_at','>=', $this->dateFrom);
        }
        if (!empty($this->dateTo))
        {
            $query->whereDate('applied_at','<=', clone\Carbon\Carbon::parse($this->dateTo)->endOfDay());
        }

        $lamarans = $query->latest('applied_at')->paginate(10);

        $positionTitles = Lowongan::whereHas('applications')->orderBy('title')->pluck('title')->unique();

        return view('livewire.lamaran', [
            'positionTitles' => $positionTitles,
            'lamarans' => $lamarans
        ]);
    }
}
