<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Result extends Model
{
    protected $fillable = [
        'user_id', 'group_id', 'topic_id', 'level_id', 'is_completed', 'value',
        'ects', 'natValue', 'result', 'start', 'duration'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function detail()
    {
        return $this->hasOne(Detail::class);
    }

    public function getDurationAttribute($value)
    {
        return gmdate("H:i:s", $value);
    }

    public function getStartAttribute($date)
    {
        return \Carbon\Carbon::createFromTimestamp($date)->format('d-m-Y H:i');
    }

    public function getUpdatedAtAttribute($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y H:i');
    }

    /*public function getMidRes($level)
    {
        $curRes = $this->where('user_id', Auth::user()->id)->where('level_id', $level)->get();
        return round($curRes->sum('result') / $curRes->count(), 0);
    }*/
}
