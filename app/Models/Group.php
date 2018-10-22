<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name', 'status', 'institute_id', 'branch_id'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public static function add($request)
    {
        $group = new static;
        if (!isset($request['status'])) $request['status'] = 0;
        $group->fill($request);
        $group->save();
        return $group;

    }

    public function edit($request)
    {
        if (!isset($request['status'])) $request['status'] = 0;
        $this->fill($request);
        $this->save();

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


    public function graphForGroup()
    {
        return $this->load([
            'results' => function ($query) {
                $query->orderBy('start', 'asc'); //updated_at
            },
            'results.topic',
            'results.level',
            'results.user',
        ]);
    }

    public function graphForGroupByDate($start, $end)
    {
        return $this->load(['results' => function ($query) use ($start, $end) {
            $query->whereBetween('updated_at', [$start, $end])
                ->orderBy('start', 'asc'); //updated_at
        },
            'results.topic',
            'results.level',
            'results.user',
        ]);
    }
}
