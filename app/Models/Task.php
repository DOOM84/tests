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
}
