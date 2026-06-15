<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'email',
        'name',
        'password',
        'avatar',
        'settings'
    ];

    protected $hidden =[
        'password',
        'remember_token'
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    /**
     * Get user setting with fallback to default values.
     */
    public function getSetting(string $key, mixed $default = null): mixed
    {
        $defaults = [
            'timezone' => 'Asia/Jakarta',
            'theme' => 'light',
            'notif_login' => true,
            'notif_publish' => true,
            'pagination_limit' => 10,
        ];

        return $this->settings[$key] ?? ($defaults[$key] ?? $default);
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }
}
