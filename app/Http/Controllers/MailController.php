<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\Mail\DemoMail;

class MailController extends Controller
{
    //
    public function index(){
        $mailData = [
            'title' =>'mail title',
            'body'=>'mail body'
        ];

        Mail::to('moriyamayukio85@gmail.com')->send(
            new DemoMail($mailData)
        );
        dd('Email is sent successfully');
    }
}
