<?php
namespace App\Models;

use Mail;

class MailClass
{
    //
    public function send($email,$title,$body)
    {
        Mail::send('emails.test', ['title'=>$title,'body'=>$body], function ($m) use ($email,$title) {
            $m->to($email, '123')->subject($title);
        });

    }
}