<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerRecommendation extends Model
{
    protected $fillable = ['user_id', 'career_id', 'match_score', 'assessment_attempt_id'];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}
