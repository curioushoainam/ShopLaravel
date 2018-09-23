<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    function sendEmail(){
    	$objDemo = new \stdClass();				// create an standard object
        $objDemo->demo_one = 'Demo One Value';
        $objDemo->demo_two = 'Demo Two Value';
        $objDemo->sender = 'PHP Code 127';
        $objDemo->receiver = 'VHD';
 
        Mail::to("curiousnamhoaitruong@gmail.com")->send(new DemoEmail($objDemo));
    }
}
