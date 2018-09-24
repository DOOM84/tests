<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'name', 'description', 'status', 'level_id'
    ];

    /*public function tasks()
    {
        return $this->hasMany(Task::class);
    }*/

    public function result()
    {
        return $this->hasOne(Result::class);
    }

    public static function add($request)
    {
        $topic = new static;
        if(!isset($request['status'])) $request['status'] = 0;
        $topic->fill($request);
        $topic->save();
        return $topic;

    }

    public function levels()
    {
        return $this->belongsToMany(Level::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function edit($request)
    {
        if(!isset($request['status'])) $request['status'] = 0;
        $this->fill($request);
        $this->save();

    }
}
