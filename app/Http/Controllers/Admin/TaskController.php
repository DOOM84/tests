<?php

namespace App\Http\Controllers\Admin;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Level;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        //dd($tasks);


        return view('admin.tasks.show', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Level::all();

        $categories = Category::all();

        return view('admin.tasks.add', compact('levels', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'body' => 'required',
        ]);
        $task = Task::add($request->all());

        foreach ($request->answer as $answer) {
            if (empty($answer['body'])) continue;
            $task->answers()->create($answer);
        }

        return redirect(route('tasks.index'))->with('status', 'Тест успешно сохранен');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        $levels = Level::all();

        $categories = Category::all();

        return view('admin.tasks.edit', compact('levels', 'categories', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);
        $task = Task::find($id);
        $task->edit($request->all());
        $task->answers()->delete();
        foreach ($request->answer as $answer) {
            if (empty($answer['body'])) continue;
            $task->answers()->create($answer);
        }
        return redirect(route('tasks.index'))->with('status', 'Тест успешно изменен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->answers()->delete();
        $task->delete();
        return redirect(route('tasks.index'))->with('status', 'Тест успешно удален');
    }

    public function deleteAnswer($id)
    {
        $answer = Answer::find($id);
        $answer->delete();
        return redirect()->back()->with('status', 'Ответ успешно удален');
    }
}
