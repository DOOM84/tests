<?php

namespace App\Http\Controllers\Auth;

use App\Models\Group;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $groups = Group::with('institute')->get();
        return view('auth.register', compact('groups'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        /*return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'group_id' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);*/

        $messages = [
            'name.required' => __('page.nameReq'),
            'name.string' => __('page.nameStr'),
            'name.max' => __('page.nameMax'),
            'name.min' => __('page.nameMin'),
            'name.unique' => __('page.nameUnique'),
            'email.required' => __('page.emailReq'),
            'email.string' => __('page.emailStr'),
            'email.email' => __('page.emailEm'),
            'email.max' => __('page.emailMax'),
            'email.unique' => __('page.emailUnique'),
            'group_id.required' => __('page.groupIdReq'),
            'password.required' => __('page.passwordReq'),
            'password.string' => __('page.passwordStr'),
            'password.min' => __('page.passwordMin'),
            'password.confirmed' => __('page.passwordConfirmed'),
        ];

        return Validator::make($data, [
            'name' => 'required|string|min:2|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'group_id' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'group_id' => $data['group_id'],
            'password' => Hash::make($data['password']),
            'attempts' => 0
        ]);
    }
}
