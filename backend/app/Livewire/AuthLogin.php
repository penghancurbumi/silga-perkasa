<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthLogin extends Component
{

    public $email;
    public $password;

    protected $messages = [
        'email.required' => 'Email is required',
        'password.required' => 'Password is required',
    ];

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
            
            $this->reset(['email','password']);

            $this->dispatch('login-success');

            return;
        }

        session()->flash('error', 'email dan password kamu salah');
    }

    public function render()
    {
        return view('pages.auth-login')
            ->layout('layouts.guest');
    }
}