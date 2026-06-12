<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthLogin extends Component
{

    public $email;
    public $password;

    public function store()
    {
        $this->validate([
            'email' => 'required|string',
            'password' => 'required',
        ]);

       if(Auth::attempt([
            'email' => $this->email,
            'password' => $this->password
        ])) {
            
            session()->regenerate();

            return redirect()->to('/');
        }

        session()->flash('error', 'email dan password kamu salah');
    }

    public function render()
    {
        return view('pages.auth-login')
            ->layout('layouts.guest');
    }
}