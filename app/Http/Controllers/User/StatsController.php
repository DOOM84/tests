<?php

namespace App\Http\Controllers\User;

use App\Models\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatsController extends Controller
{
    public function index()
    {

        return view('user.stats');
    }

    public function detail(Result $result)
    {
       $result->with('detail')->firstOrFail();

        return view('user.ResDetail', compact('result'));


    }
}
