<?php 

namespace App\Livewire;

use Livewire\Component;

class AuthLogin extends Component
{
    public function render()
    {
        return view('pages.auth-login')
            ->layout('layouts.guest');
    }
}