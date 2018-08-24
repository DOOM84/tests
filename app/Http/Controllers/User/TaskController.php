<?php

namespace App\Http\Controllers\User;

use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function index($lev = 1)
    {
        $level = Level::getTasksWithAnswers($lev);
        if(!$level->count()) {return redirect()->route('user.index');}
        $level = $level[0];

        return view('user.tasks', compact('level'));
    }
        

}
