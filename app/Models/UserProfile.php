<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'date_of_birth',
        'gender',
        'phone',
        'address',
        'education_level',
        'current_education',
        'interests',
        'career_goals',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
