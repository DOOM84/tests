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
        if (!$request->topic) return redirect()->back();

        $topic = Topic::where('level_id', '<=', Auth::user()->level->id)->where('id', $request->topic)->first();

        if (!$topic) {
            return redirect()->route('user.index')
                ->with('error', 'You can not access to this page');
        };

        /*try {
            $topic = Auth::user()->level->topics->where('id', $request->topic)->first()
                ->load(['tasks' => function ($query) {$query->with('answers');}]);
        } catch (\Exception $ex) {
            return redirect()->route('user.index')
                ->with('error','You can not access to this page');
        } catch (\Throwable $ex) {
            return redirect()->route('user.index')
                ->with('error','You can not access to this page');
        }*/

        /*$level = Level::getTasksWithAnswers(Auth::user()->level_id);
        if(!$level->count()) {return redirect()->route('user.index')
            ->with('error','You can not access to this page or you have completed the tests');}
        $level = $level[0];*/

        return view('user.tasks', compact('topic'));
    }

    public function getResult(Request $request)
    {
        if (empty($request->answers) || count($request->answers) > $request->amount) {
            $arr = ['status' => 'Помилка! Ви не відзначили жодної відповіді'];
            return json_encode($arr);
        }
        if (Auth::user()->level_id > Level::max('ordered')) {
            $arr = ['status' => 'Congratulations! You\'ve completed all the tests successfully!'];
            return json_encode($arr);
        }
        $result = 0;
        foreach ($request->answers as $answer) {
            $res = Answer::where('id', $answer)->first();
            if ($res->is_correct) {
                $result++;
            }
        }

        $result = round(($result/$request->amount)*100, 0);

        if($result >= 90 && $result <= 100){
            $value = 'Відмінно';
            $ects = 'A';
            $natValue = 5;

            Auth::user()->updRes($request->topic_id, $request->level_id, 1, $value, $ects, $natValue, $result);

            $compl = Auth::user()->results()
                ->where('level_id', Auth::user()->level->id)->where('is_completed', 1)->count();
            $topicsLev = Auth::user()->level->topics->count();

            if ($compl == $topicsLev) {
                Auth::user()->increment('level_id');
                Auth::user()->save();
            }

        }elseif ($result >= 82 && $result <= 89){
            $value = 'Добре';
            $ects = 'B';
            $natValue = 4;

            Auth::user()->updRes($request->topic_id, $request->level_id, Null, $value, $ects, $natValue, $result);
            Auth::user()->reduceLevel();

        }elseif($result >= 75 && $result <= 81){
            $value = 'Добре';
            $ects = 'C';
            $natValue = 4;

            Auth::user()->updRes($request->topic_id, $request->level_id, Null, $value, $ects, $natValue, $result);
            Auth::user()->reduceLevel();

        }elseif ($result >= 67 && $result <= 74){
            $value = 'Задовільно';
            $ects = 'D';
            $natValue = 3;

            Auth::user()->updRes($request->topic_id, $request->level_id, Null, $value, $ects, $natValue, $result);
            Auth::user()->reduceLevel();

        }elseif($result >= 60 && $result <= 66){
            $value = 'Задовільно';
            $ects = 'E';
            $natValue = 3;

            Auth::user()->updRes($request->topic_id, $request->level_id, Null, $value, $ects, $natValue, $result);
            Auth::user()->reduceLevel();

        }elseif ($result >= 35 && $result <= 59){
            $value = 'Незадовільно';
            $ects = 'FX';
            $natValue = 1;

            Auth::user()->updRes($request->topic_id, $request->level_id, Null, $value, $ects, $natValue, $result);
            Auth::user()->reduceLevel();

        }elseif($result >= 0 && $result <= 34){
            $value = 'Незадовільно';
            $ects = 'F';
            $natValue = 0;

            Auth::user()->updRes($request->topic_id, $request->level_id, Null, $value, $ects, $natValue, $result);
            Auth::user()->reduceLevel();
        }

        if ((Auth::user()->level_id) > Level::max('ordered')) {
            Auth::user()->decrement('level_id');
            Auth::user()->save();
            $arr = [
                'status' => $result . ' Congratulations! You\'ve completed all the tests successfully!',
                'completed' => 1
            ];
        } else {
            $arr = ['status' => $result];
        }

        return json_encode($arr);







        if ($result != 0 && $result >= ($request->amount - 1)) {

            $res = Auth::user()->results()
                ->firstOrCreate(['topic_id' => $request->topic_id, 'level_id' => $request->level_id]);
            $res->update(['topic_id' => $request->topic_id, 'level_id' => $request->level_id, 'is_completed' => 1]);

            $compl = Auth::user()->results()
                ->where('level_id', Auth::user()->level->id)->where('is_completed', 1)->count();
            $topicsLev = Auth::user()->level->topics->count();

            if ($compl == $topicsLev) {
                Auth::user()->increment('level_id');
                Auth::user()->save();
            }

            if ((Auth::user()->level_id) > Level::max('ordered')) {
                Auth::user()->decrement('level_id');
                Auth::user()->save();
                $arr = [
                    'status' => $result . ' Congratulations! You\'ve completed all the tests successfully!',
                    'completed' => 1
                ];
            } else {
                $arr = ['status' => $result];
            }
        } else {
            $res = Auth::user()->results()
                ->firstOrCreate(['topic_id' => $request->topic_id, 'level_id' => $request->level_id,]);
            $res->update(['topic_id' => $request->topic_id, 'level_id' => $request->level_id, 'is_completed' => Null]);
            if (Auth::user()->level_id > 1 && Auth::user()->level->id == $request->level_id) {
                Auth::user()->decrement('level_id');
                Auth::user()->save();

                $prevResLev = Auth::user()->results->where('level_id', Auth::user()->level->id - 1)->all();
                foreach ($prevResLev as $level) {
                    $level->update(['is_completed' => Null]);
                }
            }
            $arr = ['status' => $result];
        }

        return json_encode($arr);
    }


}
