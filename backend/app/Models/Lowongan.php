<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'category',
        'location',
        'minimum_experience',
        'employment_type',
        'description',
        'qualification',
        'posted_at',
        'deadline',
        'status',
    ];

    protected $casts = [
        'posted_at' => 'datetime',
        'deadline' => 'date',
    ];


    public function user()
    {
        return $this->belongTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(applications::class);
    }
}
