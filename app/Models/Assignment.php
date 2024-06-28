<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'assignment';
    protected $fillable = [
        'classroom_id',
        'title',
        'expired_at',
        'is_expired',
        'number_of_question'
    ];

    public function question()
    {
        return $this->hasMany(Question::class);
    }
    public function score()
    {
        return $this->hasMany(Score::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    use HasFactory;
}
