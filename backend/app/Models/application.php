<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class application extends Model
{
    protected $fillable = [
        'applicant_id', 'lowongan_id', 'resume',
        'declaration', 'status', 'notes', 'applied_at',
    ];

    protected $casts = [
        'declaration' => 'boolean',
        'applied_at'  => 'datetime',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }
}
