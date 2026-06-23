<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'gender',
        'birth_place',
        'birth_date',
        'address',
        'village',
        'district',
        'city',
        'province',
        'postal_code',
        'referral_source',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function educations()
    {
        return $this->hasMany(ApplicantEducation::class);
    }

    public function experiences()
    {
        return $this->hasMany(ApplicantExperience::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}