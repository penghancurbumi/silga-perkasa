<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NotificationBell extends Component
{
    public bool $open = false;

    public function toggle()
    {
        $this->open = !$this->open;
    }

    public function markAllRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
    }

    public function markRead(string $id)
    {
        $notif = Auth::user()->notifications()->find($id);
        if($notif){
            $notif->markAsRead();
        }
    }

    public function render()
    {
        return view('components.notification-bell',[
            'notifications' => Auth::user()->notifications()->latest()->take(10)->get(),
            'unreadCount' => Auth::user()->unreadNotifications->count(),
        ]);
    }
}