<?php

namespace App\Http\Controllers\Admin;

use App\Models\Level;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('level')->get();

        return view('admin.users.show', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Level::all();
        return view('admin.users.add', compact('levels'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'min:10',
        ],
            [
                'name.required' => 'Пожалуйста, укажите имя пользователя',
                'name.max' => 'Имя пользователя не должно быть более 255 символов',
                'name.string' => 'Имя пользователя  должно быть текстом',
                'email.required' => 'Пожалуйста, укажите Email пользователя',
                'email.string' => 'Email пользователя  должен быть текстом',
                'email.email' => 'Email пользователя должен быть корректным адресом',
                'email.max' => 'Email пользователя не должен быть более 255 символов',
                'email.unique' => 'Пользователь с таким Email адресом уже существует',
                'password.required' => 'Пожалуйста, укажите пароль пользователя',
                'password.string' => 'Пароль пользователя  должен быть текстом',
                'password.min' => 'Пароль пользователя не должен быть менее 6 символов',
                'password.confirmed' => 'Введенные пароли не совпадают',
                'phone.min' => 'поле Телефон должно быть не менее 10 цифр',
            ]);
        $request['password'] = Hash::make($request->password);
        if (!isset($request['is_admin'])) $request['is_admin'] = 0;
        if (!isset($request['status'])) $request['status'] = 0;
        if (!isset($request['is_subscr'])) $request['is_subscr'] = 0;
        $user = User::create($request->all());
        return redirect(route('users.index'))->with('status', 'Пользователь успешно добавлен');
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
        $user = User::find($id);
        $levels = Level::all();
        return view('admin.users.edit', compact('user', 'levels'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'confirmed',
        ],
            [
                'name.required' => 'Пожалуйста, укажите имя пользователя',
                'name.max' => 'Имя пользователя не должно быть более 255 символов',
                'name.string' => 'Имя пользователя  должно быть текстом',
                'email.required' => 'Пожалуйста, укажите Email пользователя',
                'email.string' => 'Email пользователя  должен быть текстом',
                'email.email' => 'Email пользователя должен быть корректным адресом',
                'email.max' => 'Email пользователя не должен быть более 255 символов',
                'password.confirmed' => 'Введенные пароли не совпадают',
            ]);
        $user = User::find($id);
        if (!isset($request['is_admin'])) $request['is_admin'] = 0;
        if (!isset($request['status'])) $request['status'] = 0;
        if (!isset($request['is_subscr'])) $request['is_subscr'] = 0;
        if ($request->get('password') == '') {
            $user->update($request->except('password'));
        } else {
            $request['password'] = Hash::make($request->password);
            $user->update($request->all());
        }
        return redirect()->back()->with('status', 'Пользователь успешно изменен ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with('status', 'Пользователь успешно удален ');
    }
}
