<?php

namespace App\Livewire;

use Livewire\Component;

class Setting extends Component
{
    public string $timezone = 'Asia/Jakarta';
    public bool $notif_login = true;
    public bool $notif_publish = true;
    public ?int $pagination_limit = null;

    public function mount()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $this->timezone = $user->getSetting('timezone');
        $this->notif_login = (bool) $user->getSetting('notif_login');
        $this->notif_publish = (bool) $user->getSetting('notif_publish');
        
        $limit = $user->getSetting('pagination_limit');
        $this->pagination_limit = $limit !== null ? (int) $limit : null;
    }

    public function save()
    {
        $this->validate([
            'timezone' => 'required|string|in:Asia/Jakarta,Asia/Makassar,Asia/Jayapura,UTC',
            'notif_login' => 'required|boolean',
            'notif_publish' => 'required|boolean',
            'pagination_limit' => 'nullable|integer|in:5,10,12,15,20,25',
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->user();

        $user->settings = [
            'timezone' => $this->timezone,
            'notif_login' => $this->notif_login,
            'notif_publish' => $this->notif_publish,
            'pagination_limit' => $this->pagination_limit,
        ];

        $user->save();

        $this->dispatch('settings-success');
    }

    public function isDirty(): bool
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $limit = $user->getSetting('pagination_limit');
        $dbLimit = $limit !== null ? (int) $limit : null;

        return $this->timezone !== $user->getSetting('timezone') ||
               $this->notif_login !== (bool) $user->getSetting('notif_login') ||
               $this->notif_publish !== (bool) $user->getSetting('notif_publish') ||
               $this->pagination_limit !== $dbLimit;
    }

    public function render()
    {
        return view('livewire.setting')->layout('layouts.app');
    }
}
