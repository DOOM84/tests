<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $fillable = [
        'result_id', 'answers', 'correct', 'incorrect'
    ];

    public function result()
    {
        return $this->belongsTo(Result::class);
    }
}
