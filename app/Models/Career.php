<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = [
        'title',
        'category',
        'description',
        'required_skills',
        'education_requirements',
        'education_level',
        'salary_range',
        'job_outlook',
        'work_environment',
        'personality_matches',
        'aptitude_requirements',
        'is_active',
    ];

    protected $casts = [
        'required_skills' => 'array',
        'personality_matches' => 'array',
        'aptitude_requirements' => 'array',
        'is_active' => 'boolean',
    ];
}
