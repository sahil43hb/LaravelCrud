<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index($title, $desc)
    {
        $mailData = [
            'title' => $title,
            'body' => $desc,
        ];
        Mail::to('hbdeveloper.43@gmail.com')->send(new DemoMail($mailData));
    }
}