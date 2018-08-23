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

    public static function add($request)
    {
        $level = new static;
        $level->fill($request);
        $level->save();
        return $level;
    }

    public function edit($request)
    {
        $this->fill($request);
        $this->save();
    }
}
