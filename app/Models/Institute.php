<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    protected $fillable = [
        'name', 'status'
    ];

    /*public function userss()
    {
        return $this->hasManyThrough(User::class, Group::class);
    }*/

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public static function add($request)
    {
        $institute = new static;
        if(!isset($request['status'])) $request['status'] = 0;
        $institute->fill($request);
        $institute->save();
        return $institute;

    }

    public function edit($request)
    {
        if(!isset($request['status'])) $request['status'] = 0;
        $this->fill($request);
        $this->save();

    }
}
