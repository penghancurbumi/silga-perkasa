<?php

namespace App\Livewire;

use Livewire\Component;

class Setting extends Component
{
    public string $timezone = 'Asia/Jakarta';
    public bool $notif_login = true;
    public bool $notif_publish = true;
    public int $pagination_limit = 10;

    public function mount()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $this->timezone = $user->getSetting('timezone');
        $this->notif_login = (bool) $user->getSetting('notif_login');
        $this->notif_publish = (bool) $user->getSetting('notif_publish');
        $this->pagination_limit = (int) $user->getSetting('pagination_limit');
    }

    public function save()
    {
        $this->validate([
            'timezone' => 'required|string|in:Asia/Jakarta,Asia/Makassar,Asia/Jayapura,UTC',
            'notif_login' => 'required|boolean',
            'notif_publish' => 'required|boolean',
            'pagination_limit' => 'required|integer|in:5,10,12,15,20,25',
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

    public function resetPaginationLimit()
    {
        $this->pagination_limit = 12;
    }

    public function isDirty(): bool
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        return $this->timezone !== $user->getSetting('timezone') ||
               $this->notif_login !== (bool) $user->getSetting('notif_login') ||
               $this->notif_publish !== (bool) $user->getSetting('notif_publish') ||
               $this->pagination_limit !== (int) $user->getSetting('pagination_limit');
    }

    public function render()
    {
        return view('pages.setting')->layout('layouts.app');
    }
}
