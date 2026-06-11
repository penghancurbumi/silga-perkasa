<?php

namespace App\Livewire;

use Livewire\Component;

class AuthRegister extends Component
{
    public function render()
    {
        return view('pages.auth-register')
            ->layout('layouts.guest');
    }
}