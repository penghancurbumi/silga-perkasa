<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ActivityLog;
use Carbon\Carbon;

class Activity extends Component
{
    use WithPagination;

    public string $period = 'all';
    public string $typeFilter = 'all';

    public function setPeriod(string $period)
    {
        $this->period = in_array($period, ['all', 'day', 'week', 'month', 'year']) ? $period : 'all';
        $this->resetPage(); // Reset pagination when filter changes
    }

    public function updatingTypeFilter()
    {
        $this->resetPage(); // Reset pagination when type filter changes via wire:model
    }

    public function render()
    {
        $query = ActivityLog::with('user')->latest();

        // Filter Waktu
        if ($this->period === 'day') {
            $query->where('created_at', '>=', Carbon::today());
        } elseif ($this->period === 'week') {
            $query->where('created_at', '>=', Carbon::now()->startOfWeek());
        } elseif ($this->period === 'month') {
            $query->where('created_at', '>=', Carbon::now()->startOfMonth());
        } elseif ($this->period === 'year') {
            $query->where('created_at', '>=', Carbon::now()->startOfYear());
        }

        // Filter Tipe Aktivitas
        if ($this->typeFilter !== 'all') {
            $query->where('type', $this->typeFilter);
        }

        $activities = $query->paginate(auth()->user()->getSetting('pagination_limit', 12));

        return view('pages.activity', [
            'recentActivity' => $activities
        ])->layout('layouts.app');
    }
}
