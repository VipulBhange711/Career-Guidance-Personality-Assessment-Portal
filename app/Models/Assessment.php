<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $fillable = ['title', 'type', 'description', 'is_active'];

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('display_order');
    }
}
