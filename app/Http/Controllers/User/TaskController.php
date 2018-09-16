<?php

namespace App\Http\Controllers\User;

use App\Models\Answer;
use App\Models\Level;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {

        try {
            $topic = Auth::user()->level->topics->where('id', $request->topic)->first()
                ->load(['tasks' => function ($query) {$query->with('answers');}]);
        } catch (\Exception $ex) {
            return redirect()->route('user.index')
                ->with('error','You can not access to this page');
        } catch (\Throwable $ex) {
            return redirect()->route('user.index')
                ->with('error','You can not access to this page');
        }

        /*$level = Level::getTasksWithAnswers(Auth::user()->level_id);
        if(!$level->count()) {return redirect()->route('user.index')
            ->with('error','You can not access to this page or you have completed the tests');}
        $level = $level[0];*/

        return view('user.tasks', compact('topic'));
    }

    public function getResult(Request $request)
    {
        if(empty($request->answers) || count($request->answers) > $request->amount){
            if(Auth::user()->level_id > 1){
                Auth::user()->decrement('level_id');
                Auth::user()->save();
            }
            $arr = ['status' => 0];
            return json_encode($arr);
        }
        if(Auth::user()->level_id > Level::max('ordered')){
            $arr = ['status' => 'Congratulations! You\'ve completed all the tests successfully!'];
            return json_encode($arr);
        }
        $result = 0;
        foreach ($request->answers as $answer) {
            $res = Answer::where('id', $answer)->first();
            if ($res->is_correct){
                $result++;
            }
        }
        if($result != 0 && $result >= ($request->amount - 1)){
            Auth::user()->increment('level_id');
            Auth::user()->save();

            if((Auth::user()->level_id + 1) > Level::max('ordered')){
                $arr = [
                    'status' => $result.' Congratulations! You\'ve completed all the tests successfully!',
                    'completed' => 1
                ];
            }else{
                $arr = ['status' => $result];
            }
        }else{
            //dd(Auth::user()->level_id);
            if(Auth::user()->level_id > 1){
                Auth::user()->decrement('level_id');
                Auth::user()->save();
            }
            $arr = ['status' => $result];
        }

        return json_encode($arr);
    }
        

}
