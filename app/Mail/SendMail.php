<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\Users;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
       
    }

    public function build(Request $request)
    {
       // $user = Users::find(1);
        return $this->view('mail', ['Name' => 'Dream Users'])->to('kelvonetics@gmail.com');
    }
}