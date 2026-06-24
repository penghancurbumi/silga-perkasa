<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthLogin extends Component
{

    public string $email = '';
    public string $password = '';

    private function throttleKey(): string
    {
        return Str::lower(trim($this->email)).'|'.request()->ip();
    }

    protected $messages = [
        'email.required' => 'Email is required',
        'password.required' => 'Password is required',
    ];

    public function store()
    {
        // 1. Cek Rate Limiting (Maksimal 5 kali percobaan)
        if (RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            $seconds = RateLimiter::availableIn($this->throttleKey());
            $this->addError('email', "Terlalu banyak percobaan. Silahkan coba lagi dalam {$seconds} detik.");
            return;
        }

        // 2. Validasi Input
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        // 3. Proses Login
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            // Bersihkan rate limiter jika berhasil
            RateLimiter::clear($this->throttleKey());

            session()->regenerate();

            ActivityLog::create([
                'user_id' => Auth::id(),
                'type' => 'login',
                'description' => 'User logged in',
                'ip_address' => request()->ip(),
            ]);
            
            $this->reset(['email', 'password']);

            return redirect()->intended('/');
        }

        // 4. Jika gagal, catat percobaan (Hit) ke RateLimiter
        RateLimiter::hit($this->throttleKey(), 60); // Blokir selama 60 detik jika mencapai limit

        // Tampilkan pesan error ambigu
        $this->addError('password', 'Email atau password yang Anda masukkan salah.');
        $this->reset('password');
    }

    public function render()
    {
        return view('livewire.auth-login')
            ->layout('layouts.guest');
    }
}