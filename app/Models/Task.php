<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'body', 'description', 'level_id', 'category_id', 'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public static function add($request)
    {
        $task = new static;
        if(!isset($request['status'])) $request['status'] = 0;
        $task->fill($request);
        //$player->champ_id = $champId;
        $task->save();
        /*$detail = new player_detail;
        $detail->fill($request);
        $detail->heightweight = $request['height'] . '/' . $request['weight'];
        $player->player_detail()->save($detail);*/

        return $task;

    }
}
