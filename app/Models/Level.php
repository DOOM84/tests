<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = [
        'description', 'level', 'ordered'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function add($request)
    {
        $level = new static;
        //dd($request['ordered']);
        self::makeOrderAdd($request['ordered']);
        $level->fill($request);
        $level->save();
        return $level;
    }

    public function edit($request)
    {
        self::makeOrderEdit($request['ordered'], $this->ordered);
        $this->fill($request);
        $this->save();
    }


    public static function makeOrderEdit($newOrdered, $oldOrdered)
    {
        $levels = new static;
        if ($newOrdered == 1) {
            return $levels->where('ordered', '<', $oldOrdered)->increment('ordered');
        } elseif ($newOrdered == $levels->max('ordered')) {
            return $levels->where('ordered', '>', $oldOrdered)->decrement('ordered');
        } elseif ($newOrdered < $oldOrdered) {
            return $levels->where('ordered', '<', $oldOrdered)->where('ordered', '>=', $newOrdered)
                ->increment('ordered');
        } else {
            return $levels->where('ordered', '>', $oldOrdered)->where('ordered', '<=', $newOrdered)
                ->decrement('ordered');
        }

    }

    public static function makeOrderAdd($newOrdered)
    {
        $levels = new static;
        return $levels->where('ordered', '>=', $newOrdered)->increment('ordered');
    }

    public static function makeOrderDelete($oldOrdered)
    {
        $levels = new static;
        return $levels->where('ordered', '>', $oldOrdered)->decrement('ordered');
    }

    public static function getTasksWithAnswers($lev)
    {
        return self::where('ordered', $lev)->with(['tasks' => function ($query) {
            $query->with('answers');
        }])->get();

        //return self::all()->where('status', 1)->sortBy('ordered');
    }
}
