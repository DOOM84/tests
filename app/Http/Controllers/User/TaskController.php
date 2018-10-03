<?php

namespace App\Http\Controllers\User;

use App\Models\Answer;
use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        /*$tasks = Auth::user()->level->tasks()->take(50)->inRandomOrder()->get();
        dd($tasks);*/

        if (!$request->topic || $request->isMethod('get')) return redirect()->back();

        $topic = Null;
        $tasks = Null;

        if ($request->topic == 'general') {
            $tasks = Auth::user()->level->tasks()->with('answers')->distinct()->inRandomOrder()->take(50)->get();
        } else {
            if (Auth::user()->level->ordered == 3) {
                if (Auth::user()->attempts > Auth::user()->level->topics->count() * 2) {
                    return redirect()->route('user.index')->with('error', 'Перевищено кількість спроб.');
                } else {
                    Auth::user()->increment('attempts');
                    Auth::user()->save();
                }
            }
            //$topic = Topic::where('level_id', '<=', Auth::user()->level->id)->where('id', $request->topic)->first();
            $topic = Auth::user()->level->topics->where('id', $request->topic)->first()
                ->load(['tasks' => function ($query) {
                    $query->where('level_id', Auth::user()->level->ordered)->with('answers');
                }]);
        };

        if (!$topic && !$tasks->count()) {
            return redirect()->route('user.index')
                ->with('error', 'You can not access to this page');
        }


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

        return view('user.tasks', compact('topic', 'tasks'));
    }

    public function getResult(Request $request)
    {
        //dd($request->answers);
        if (empty($request->answers) || count($request->answers) > $request->amount) {
            $arr = ['status' => 'Помилка! Ви не відзначили жодної відповіді'];
            return json_encode($arr);
        }
        if (Auth::user()->level_id > Level::max('ordered')) {
            $arr = ['status' => 'Congratulations! You\'ve completed all the tests successfully!'];
            return json_encode($arr);
        }
        $result = 0;
        $repTopics = [];
        foreach ($request->answers as $answer) {
            $res = Answer::where('id', $answer)->first();
            if ($res->is_correct) {
                $result++;
            } else {
                $res->task->topics->each(function ($forRepeat) use (&$repTopics) {
                    $repTopics[] = $forRepeat->description;
                });
            }
        }

        $correct = $result;
        $incorrect = $request->amount - $result;

        $topRep = array_unique($repTopics);

        //dd($topRep);

        //$result = $result < 0 ? $result = 0 : $result;

        $result = round(($result / $request->amount) * 100, 0);

        if ($result >= 90 && $result <= 100) {
            $value = 'Відмінно';
            $ects = 'A';
            $natValue = 5;

            Auth::user()->updRes($request->topic_id, 1, $value, $ects, $natValue, $result,
                $request->answers, $request->start, $request->duration, $correct, $incorrect);
            Auth::user()->increaseLevel();

        } elseif ($result >= 82 && $result <= 89) {
            $value = 'Добре';
            $ects = 'B';
            $natValue = 4;

            Auth::user()->updRes($request->topic_id, Null, $value, $ects, $natValue, $result, $request->answers,
                $request->start, $request->duration, $correct, $incorrect);
            Auth::user()->reduceLevel();

        } elseif ($result >= 75 && $result <= 81) {
            $value = 'Добре';
            $ects = 'C';
            $natValue = 4;

            Auth::user()->updRes($request->topic_id, Null, $value, $ects, $natValue, $result, $request->answers,
                $request->start, $request->duration, $correct, $incorrect);
            Auth::user()->reduceLevel();

        } elseif ($result >= 67 && $result <= 74) {
            $value = 'Задовільно';
            $ects = 'D';
            $natValue = 3;

            Auth::user()->updRes($request->topic_id, Null, $value, $ects, $natValue, $result, $request->answers,
                $request->start, $request->duration, $correct, $incorrect);
            Auth::user()->reduceLevel();

        } elseif ($result >= 60 && $result <= 66) {
            $value = 'Задовільно';
            $ects = 'E';
            $natValue = 3;

            Auth::user()->updRes($request->topic_id, Null, $value, $ects, $natValue, $result, $request->answers,
                $request->start, $request->duration, $correct, $incorrect);
            Auth::user()->reduceLevel();

        } elseif ($result >= 35 && $result <= 59) {
            $value = 'Незадовільно';
            $ects = 'FX';
            $natValue = 1;

            Auth::user()->updRes($request->topic_id, Null, $value, $ects, $natValue, $result, $request->answers,
                $request->start, $request->duration, $correct, $incorrect);
            Auth::user()->reduceLevel();

        } elseif ($result >= 0 && $result <= 34) {
            $value = 'Незадовільно';
            $ects = 'F';
            $natValue = 0;

            Auth::user()->updRes($request->topic_id, Null, $value, $ects, $natValue, $result, $request->answers,
                $request->start, $request->duration, $correct, $incorrect);
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
            $arr = ['status' => $result, 'repeat' => $topRep];
        }

        return json_encode($arr);
    }


}
