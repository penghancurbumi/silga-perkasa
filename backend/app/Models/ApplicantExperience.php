<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicantExperience extends Model
{
    protected $fillable = [
        'applicant_id', 'company_name', 'job_title',
        'employment_type', 'start_date', 'end_date',
        'is_current', 'job_description',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'is_current' => 'boolean',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}