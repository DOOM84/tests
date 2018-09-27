<?php

namespace App;

use App\Models\Group;
use App\Models\Institute;
use App\Models\Level;
use App\Models\Result;
use App\Notifications\MailResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'level_id', 'status', 'is_admin', 'group_id', 'institute_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id', 'ordered');
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordNotification($token));
    }

    public function updRes($topic_id, $is_compl, $value, $ects, $natValue, $result)
    {
        $res = $this->results()
            ->firstOrCreate(['topic_id' => $topic_id, 'level_id' => $this->level_id]);
        $res->update(['topic_id' => $topic_id,
            'level_id' => $this->level_id,
            'is_completed' => $is_compl,
            'value' => $value,
            'ects' => $ects,
            'natValue' => $natValue,
            'result' => $result,
        ]);
    }

    public function reduceLevel()
    {
        $compl = $this->results()
            ->where('level_id', $this->level->id)->where('is_completed', Null)->count();
        $topicsLev = $this->level->topics->count();

        if ($compl == $topicsLev) {
            $this->decrement('level_id');
            $this->save();
        }
        $prevResLev = $this->results->where('level_id', $this->level->id - 1);
        $prevResLev->each(function ($level) {
            $level->update(['is_completed' => Null]);
        });
    }

    public function increaseLevel()
    {

        $compl = $this->results()
            ->where('level_id', $this->level->id)->where('is_completed', 1)->count();
        $topicsLev = $this->level->topics->count();

        if ($compl == $topicsLev) {
            $this->increment('level_id');
            $this->save();
        }
    }
}
