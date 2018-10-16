<?php

namespace App;

use App\Mail\SendRes;
use App\Models\Detail;
use App\Models\Group;
use App\Models\Institute;
use App\Models\Level;
use App\Models\Result;
use App\Notifications\MailResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;

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

    public function updRes($topic_id, $is_compl, $value, $ects, $natValue, $result, $details, $start, $duration,
                           $correct, $incorrect)
    {
        $res = $this->results()
            ->firstOrCreate(['topic_id' => $topic_id, 'level_id' => $this->level_id]);
        $res->update(['topic_id' => $topic_id,
            'level_id' => $this->level_id,
            'group_id' => $this->group_id,
            'is_completed' => $is_compl,
            'value' => $value,
            'ects' => $ects,
            'natValue' => $natValue,
            'result' => $result,
            'start' => $start,
            'duration' => $duration,
        ]);
        $answers = json_encode($details);

        $res->detail()->firstOrCreate(['result_id' => $res->id])->update([
            'answers' => $answers,
            'correct' => $correct,
            'incorrect' => $incorrect
        ]);

        Mail::send(new SendRes($res));
        return true;

        //$res->detail()->save($detail);
    }

    public function reduceLevel()
    {
        $compl = $this->results()
            ->where('level_id', $this->level->id)
            ->where('is_completed', Null)->count();
        $generalTest = $this->results()
            ->where('level_id', $this->level->id)->where('topic_id', Null)
            ->where('is_completed', Null)->count();
        $topicsLev = $this->level->topics->where('status', 1)->count();

        if ($compl == ($topicsLev + $generalTest) && $this->level->id > 1) {
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
        $generalTest = $this->results()
            ->where('level_id', $this->level->id)->where('topic_id', Null)
            ->where('is_completed', 1)->count();
        $topicsLev = $this->level->topics->where('status', 1)->count();
        if ($compl == ($topicsLev + $generalTest)) {
            $this->increment('level_id');
            $this->save();
        }
    }


    public function getMidRes($level)
    {
        $curRes = $this->results->where('level_id', $level);

        return round($curRes->sum('result') / $curRes->count(), 0);
    }

    public function getFinalRes()
    {
        $finRes = $this->results;
        return round($finRes->sum('result') / $finRes->count(), 0);
    }

    public function getDistinctDatesForChart()
    {
        $dates = $this->results()->select('updated_at')
            ->orderBy('updated_at', 'ASC')->pluck('updated_at')->toArray();
        $datesRes = [];
        foreach ($dates as $item) {
            $datesRes[] = substr($item, 0, 10);
        }
        return array_unique($datesRes);
    }

    public function graphForStud()
    {
        return $this->load(['results' => function ($query) {
            $query->orderBy('updated_at', 'asc');
        },
            'results.topic',
            'results.level',
        ]);
    }

    public function graphForStudByDate($start, $end)
    {
        return $this->load(['results' => function ($query) use ($start, $end) {
            $query->whereBetween('updated_at', [$start, $end])
                ->orderBy('updated_at', 'asc');
        },
            'results.topic',
            'results.level',
        ]);
    }



}
