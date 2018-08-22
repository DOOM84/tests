<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = [
        'description', 'level',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
