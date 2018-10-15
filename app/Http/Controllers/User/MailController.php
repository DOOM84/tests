<?php

namespace App\Http\Controllers\User;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendTable()
    {
        //dd($request->table);
        Mail::send(new SendMail());
    }
}
