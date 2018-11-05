<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'body', 'description', 'level_id', 'category_id', 'status', 'topic_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function sources()
    {
        return $this->belongsToMany(Source::class);
    }

    public static function add($request)
    {
        $task = new static;
        if (!isset($request['status'])) $request['status'] = 0;
        $task->fill($request);
        $task->save();
        return $task;

    }

    public function edit($request)
    {
        if (!isset($request['status'])) $request['status'] = 0;
        $this->fill($request);
        $this->save();

    }
}
