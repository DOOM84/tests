<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description', 'status',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public static function add($request)
    {
        $category = new static;
        if(!isset($request['status'])) $request['status'] = 0;
        $category->fill($request);
        $category->save();
        return $category;

    }

    public function edit($request)
    {
        if(!isset($request['status'])) $request['status'] = 0;
        $this->fill($request);
        $this->save();

    }
}
