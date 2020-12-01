<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Users;
use App\Mail\sendemail;

class MailController extends Controller 
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    
    public function basic_email()
    {
       $data = array('name'=>"Kelvin O");
    
       Mail::send(['text'=>'mail'], $data, function($message) 
       {
          $message->to('kelvonetics@yahoo.com', 'Dream360')->subject
             ('Basic Email Notification Testing Mail');
          $message->from('kelvonetics@gmail.com','Kelvin O');
       });
       echo "Basic Email Sent. Check your inbox.";
    }
 
    public function html_email()
    {
       $data = array('name'=>"Kelvin O");
       Mail::send('mail', $data, function($message) 
       {
        $message->to('kelvonetics@yahoo.com', 'Dream360')->subject
             ('HTML Notification Testing Mail');
             $message->from('kelvonetics@gmail.com','Kelvin O');
       });
       echo "HTML Email Sent. Check your inbox.";
    }
    
    public function attachment_email()
    {
       $data = array('name'=>"Virat Gandhi");
       Mail::send('mail', $data, function($message) 
       {
        $message->to('kelvonetics@yahoo.com', 'Dream360')->subject
             ('Dream360 Testing Mail with Attachment');
          $message->attach('C:\xampp\htdocs\App\public\assets\img\invoice2.jpg');
          $message->attach('Desktop\lagos.txt');
          $message->from('kelvonetics@gmail.com','Kelvin O');
       });
       echo "Email Sent with attachment. Check your inbox.";
    }


    public function send()
    {
        $user = Users::find(1);
        Mail::to($user->email)->send(new sendemail());
        return response()->json($user->FirstName.' '.$user->LastName);
    }

 }
