<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Profile extends Component
{
    use WithFileUploads;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public $avatar;
    public ?string $existingAvatar = null;
    public bool $avatarDeleted = false; // Flag untuk menandai avatar dihapus di UI

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name ?? '';
        $this->email = $user->email;
        $this->existingAvatar = $user->avatar;
    }

    public function save()
    {
        $user = Auth::user();

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|max:2048'
        ];

        $passwordChanged = !empty($this->password);

        if ($passwordChanged) {
            $rules['password'] = 'required|min:6';
        }

        $this->validate($rules);

        $user->name = $this->name;
        $user->email = $this->email;

        if ($passwordChanged) {
            $user->password = Hash::make($this->password);
        }

        // Hapus avatar lama jika ditandai untuk dihapus di UI
        if ($this->avatarDeleted) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
                $user->avatar = null;
            }
            $this->avatarDeleted = false;
        }

        if($this->avatar){
            if($user->avatar){
                Storage::disk('public')->delete($user->avatar);
            }

            $avatarPath = $this->avatar->store('avatars', 'public');
            $user->avatar = $avatarPath;
            $this->existingAvatar = $avatarPath;
            $this->avatar = null;
        }

        $user->save();

        // Kirim notifikasi sistem ke pengguna
        $user->notify(new \App\Notifications\ProfileNotification('Profil Anda berhasil diperbarui.', 'success'));

        // Clear password after saving
        $this->password = '';

        // Dispatch alert notification
        $this->dispatch('settings-success');
    }

    public function deleteAvatar()
    {
        $this->avatar = null;
        
        if ($this->existingAvatar) {
            $this->avatarDeleted = true;
            $this->existingAvatar = null;
        }
    }

    public function isDirty(): bool
    {
        $user = Auth::user();
        
        $nameChanged = $this->name !== ($user->name ?? '');
        $emailChanged = $this->email !== $user->email;
        $passwordChanged = !empty($this->password);
        $avatarChanged = $this->avatar !== null || $this->avatarDeleted;

        return $nameChanged || $emailChanged || $passwordChanged || $avatarChanged;
    }

    public function render()
    {
        return view('pages.profile')->layout('layouts.app');
    }
}
