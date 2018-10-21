<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;

class SendRes extends Mailable
{
    use Queueable, SerializesModels;
    protected $res2send;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($res2send)
    {
        $this->res2send = $res2send;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /*return $this->view('SendMail.table', ['table' => $request->table])->subject('Результаты теста')
            ->to(Auth::user()->email, Auth::user()->name)->from(env('MAIL_MERCH'), env('APP_NAME'));*/

        return $this->markdown('SendMail.res', [
            'res' => $this->res2send,
            'email' => Auth::user()->email,
        ])->subject(__('page.testRes'))
            ->to(Auth::user()->email, Auth::user()->name)->from(env('MAIL_MERCH'), env('APP_NAME'));
    }
}
