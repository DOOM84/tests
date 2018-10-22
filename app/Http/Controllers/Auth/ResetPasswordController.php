<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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

    protected function validationErrorMessages()
    {
        return [
            'email.required' => __('page.emailReq'),
            'email.email' => __('page.emailEm'),
            'password.required' => __('page.passwordReq'),
            'password.confirmed' => __('page.passwordConfirmed'),
            'password.min' => __('page.passwordMin'),
            'token.required' => __('passwords.token'),
        ];
    }
}
