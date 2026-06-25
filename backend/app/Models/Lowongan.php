<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'job_category_id',
        'location',
        'minimum_experience',
        'employment_type',
        'description',
        'qualification',
        'skills',
        'posted_at',
        'deadline',
        'status',
    ];

    protected $casts = [
        'posted_at' => 'datetime',
        'deadline' => 'date',
        'skills' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = \Illuminate\Support\Str::slug($model->title) . '-' . uniqid();
            }
        });
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class);
    }
}
