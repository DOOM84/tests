<?php

namespace App\Http\Controllers\Admin;

use App\Models\Group;
use App\Models\Result;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class StatsController extends Controller
{
    public function index()
    {
        $users = User::with('level')->with('group')->get();
        return view('admin.stats.index', compact('users'));
    }

    public function student(User $user)
    {
        return view('admin.stats.student', compact('user'));
    }

    public function group(Group $group)
    {
        $group->with('users');
        return view('admin.stats.group', compact('group'));
    }

    public function detail(Result $result)
    {
        $result->with('detail')->get();

        return view('admin.stats.detail', compact('result'));
    }

    public function show(Result $result)
    {
        $result->with('detail')->get();

        return view('admin.stats.show', compact('result'));
    }

    public function graphStud(User $user)
    {
        $dates = $user->getDistinctDatesForChart();
        return view('admin.stats.graphStud', compact('user', 'dates'));
    }

    public function graphStudByDate(User $user, Request $request)
    {
        $start = \Carbon\Carbon::createFromFormat('d-m-Y', $request->from)->startOfDay();
        $end = \Carbon\Carbon::createFromFormat('d-m-Y', $request->to)->endOfDay();
        $resForChart = $user->results()->whereBetween('updated_at', [$start, $end])->get();

        return View::make('admin._ajaxGraphStudByDate')->with(
            [
                'user' => $user,
                'results' => $resForChart,
                'from' => $request->from,
                'to' => $request->to
            ]
        );
    }

    public function graphGroup(Group $group)
    {
        $group->with('users');
        return view('admin.stats.graphGroup', compact('group'));
    }
}
