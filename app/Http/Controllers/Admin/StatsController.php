<?php

namespace App\Http\Controllers\Admin;

use App\Models\Answer;
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
        if (!isset($user->group->name)) {
            return redirect()->back();
        }
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
        //$result->with('detail')->get();

        $answers = Answer::whereIn('id', $result->detail->answers)->get();
        $answers->load([
            'task',
            'task.sources',
            'task.topics',
            'task.answers',
        ]);

        return view('admin.stats.show', compact('result', 'answers'));
    }

    public function graphStud(User $user)
    {
        $user->graphForStud();
        $dates = $user->getDistinctDatesForChart();

        return view('admin.stats.graphStud', compact('user', 'dates'));
    }

    public function graphStudByDate(User $user, Request $request)
    {
        $start = \Carbon\Carbon::createFromFormat('d-m-Y', $request->from)->startOfDay();
        $end = \Carbon\Carbon::createFromFormat('d-m-Y', $request->to)->endOfDay();
        $user->graphForStudByDate($start, $end);

        return View::make('admin._ajaxGraphStudByDate')->with(
            [
                'user' => $user,
                'from' => $request->from,
                'to' => $request->to
            ]
        );
    }

    public function graphGroup(Group $group)
    {
        $group->graphForGroup();
        $dates = $group->getDistinctDatesForChart();

        return view('admin.stats.graphGroup', compact('group', 'dates'));
    }

    public function graphGroupByDate(Group $group, Request $request)
    {

        $start = \Carbon\Carbon::createFromFormat('d-m-Y', $request->from)->startOfDay();
        $end = \Carbon\Carbon::createFromFormat('d-m-Y', $request->to)->endOfDay();
        $group->graphForGroupByDate($start, $end);

        return View::make('admin._ajaxGraphGroupByDate')->with(
            [
                'group' => $group,
                'from' => $request->from,
                'to' => $request->to
            ]
        );
    }
}
