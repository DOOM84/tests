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
       $result->with('detail')->get();

        return view('user.ResDetail', compact('result'));


    }

    public function show(Result $result)
    {
        $result->with('detail')->get();

        return view('user.ResShow', compact('result'));
    }

    public function group()
    {
        return view('user.groupRes');
    }
}
