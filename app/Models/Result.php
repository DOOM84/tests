<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'user_id', 'topic_id', 'level_id', 'is_completed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
