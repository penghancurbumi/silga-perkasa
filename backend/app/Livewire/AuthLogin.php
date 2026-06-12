<?php 

namespace App\Livewire;

use Livewire\Component;
use Liveeire\Models\User;

class AuthLogin extends Component
{



    public function render()
    {
        return view('pages.auth-login')
            ->layout('layouts.guest');
    }
}