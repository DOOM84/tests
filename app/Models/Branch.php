<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name', 'status'
    ];

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public static function add($request)
    {
        $branch = new static;
        if(!isset($request['status'])) $request['status'] = 0;
        $branch->fill($request);
        $branch->save();
        return $branch;

    }

    public function edit($request)
    {
        if(!isset($request['status'])) $request['status'] = 0;
        $this->fill($request);
        $this->save();

    }
}
