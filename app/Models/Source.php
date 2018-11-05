<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $fillable = [
        'url', 'task_id', 'status'
    ];

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }


    public static function add($request)
    {
        $source = new static;
        if(!isset($request['status'])) $request['status'] = 0;
        $source->fill($request);
        $source->save();
        return $source;

    }

    public function edit($request)
    {
        if(!isset($request['status'])) $request['status'] = 0;
        $this->fill($request);
        $this->save();

    }
}
