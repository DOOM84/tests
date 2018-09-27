<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use App\Models\Group;
use App\Models\Institute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$groups = Group::all();
        $groups = Group::with('institute')->get();
        //dd($tasks);


        return view('admin.groups.show', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institutes = Institute::all();
        $branches = Branch::all();
        return view('admin.groups.add', compact('institutes', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $group = Group::add($request->all());

        return redirect(route('groups.index'))->with('status', 'Группа успешно сохранена');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::find($id);
        $institutes = Institute::all();
        $branches = Branch::all();
        return view('admin.groups.edit', compact('group', 'institutes', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $group = Group::find($id);
        $group->edit($request->all());

        return redirect(route('groups.index'))->with('status', 'Группа успешно изменена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::find($id);
        $group->delete();
        return redirect()->back()->with('status', 'Группа успешно удалена');
    }
}
