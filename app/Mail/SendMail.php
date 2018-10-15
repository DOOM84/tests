<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        /*return $this->view('SendMail.table', ['table' => $request->table])->subject('Результаты теста')
            ->to(Auth::user()->email, Auth::user()->name)->from(env('MAIL_MERCH'), env('APP_NAME'));*/

        return $this->markdown('SendMail.table', [
            'table' => $request->table,
            'email' => Auth::user()->email,
        ])->subject('Результаты теста')
            ->to(Auth::user()->email, Auth::user()->name)->from(env('MAIL_MERCH'), env('APP_NAME'));
    }
}
