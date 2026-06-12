<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRegister extends Component
{

    public $email;
    public $password;
    public $password_confirmation;

    protected $messages = [
        'email.required' => 'This field is required',
        'password.required' => 'This field is required',
        'password.confirmed' => 'Password does not match',
        'password.min' => 'Password must be at least 8 characters long'
    ];

    public function save()
    {
        $this->validate([
            'email' => 'required|string|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ]);

        User::create([
            'email' =>$this->email,
            'password' =>Hash::make($this->password)
        ]);

        return redirect()->to('/login');
    }

    public function render()
    {
        return view('pages.auth-register')
            ->layout('layouts.guest');
    }
}