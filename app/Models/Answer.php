<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'body', 'task_id', 'is_correct', 'status'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
