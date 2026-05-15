<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_id',
        'question_text',
        'question_type',
        'category',
        'options',
        'correct_option',
        'display_order',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
}
