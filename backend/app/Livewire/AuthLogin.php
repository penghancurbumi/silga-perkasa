<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\ActivityLog;
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

            ActivityLog::create([
                'user_id' => Auth::id(),
                'type' => 'login',
                'description' => 'User logged in',
                'ip_address' => request()->ip(),
            ]);
            
            $this->reset(['email','password']);

            // Langsung redirect dari backend agar tidak ada jeda "nyangkut"
            return redirect()->intended('/');
        }

        // Tampilkan pesan error di bawah field email/password lewat validation message
        $this->addError('password', 'Email atau password yang Anda masukkan salah.');
    }

    public function render()
    {
        return view('pages.auth-login')
            ->layout('layouts.guest');
    }
}