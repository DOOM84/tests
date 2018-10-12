<?php

namespace App\Http\Controllers\User;

use App\Models\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\View;

class StatsController extends Controller
{
    public function index()
    {

        return view('user.stats');
    }

    public function detail(Result $result)
    {
        if ($result->user->id != Auth::user()->id) {
            return abort('404');
        }
        $result->with('detail')->get();

        return view('user.ResDetail', compact('result'));


    }

    public function show(Result $result)
    {
        if ($result->user->id != Auth::user()->id) {
            return abort('404');
        }
        $result->with('detail')->get();

        return view('user.ResShow', compact('result'));
    }

    public function group()
    {
        return view('user.groupRes');
    }


    public function graphStud()
    {
        $user = Auth::user()->graphForStud();
        $dates = $user->getDistinctDatesForChart();

        return view('user.graphStud', compact('user', 'dates'));
    }

    public function graphStudByDate(Request $request)
    {
        $start = \Carbon\Carbon::createFromFormat('d-m-Y', $request->from)->startOfDay();
        $end = \Carbon\Carbon::createFromFormat('d-m-Y', $request->to)->endOfDay();
        $user = Auth::user()->graphForStudByDate($start, $end);

        return View::make('user._ajaxGraphStudByDate')->with(
            [
                'user' => $user,
                /*'results' => $resForChart,*/
                'from' => $request->from,
                'to' => $request->to
            ]
        );
    }

    public function graphGroup()
    {
        $group = Auth::user()->group->graphForGroup();
        $dates = Auth::user()->group->getDistinctDatesForChart();
        return view('user.graphGroup', compact('dates', 'group'));
    }

    public function graphGroupByDate(Request $request)
    {
        $start = \Carbon\Carbon::createFromFormat('d-m-Y', $request->from)->startOfDay();
        $end = \Carbon\Carbon::createFromFormat('d-m-Y', $request->to)->endOfDay();
        $group = Auth::user()->group->graphForGroupByDate($start, $end);

        return View::make('user._ajaxGraphGroupByDate')->with(
            [
                'group' => $group,
                'from' => $request->from,
                'to' => $request->to
            ]
        );
    }

}
