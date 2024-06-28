<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question';
    protected $fillable = [
        'assignment_id',
        'is_essay',
        'description',
        'choice_1',
        'choice_2',
        'choice_3',
        'choice_4',
        'correct_answer',
        'point'
    ];
    public $timestamps = false;
    
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    use HasFactory;
}
