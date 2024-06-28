<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $table = 'classroom';
    protected $fillable = [
        'name'
    ];
    protected $guard = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function assignment()
    {
        return $this->hasMany(Assignment::class);
    }

    use HasFactory;
}
