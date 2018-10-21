<?php

namespace App\Http\Controllers\User;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function index()
    {

        if (Auth::check()){
            //$topics = Topic::where('level_id',  Auth::user()->level->id)->get();
            $topics = Auth::user()->level->topics->where('status', 1);
            //$results = Auth::user()->results->where('is_completed', 1)->all();
        }

        return view('user.index', compact('topics', 'results'));
        
    }

    public function setLocale(Request $request, $locale)
    {
        $cookie = cookie('setloc', $locale, time()+60*60*24*365);
        return redirect()->back()->cookie($cookie);

    }
}
