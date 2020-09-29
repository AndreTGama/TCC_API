<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use App\Http\Controllers\Controller;
use App\Mail\EmailServices;
use Illuminate\Support\Facades\Mail;
use stdClass;

class MailController extends Controller {

//     public function sendEmail() {
//         $data = array('name'=>"Virat Gandhi");

//         Mail::send([], $data, function ($message) {
//             $message->to('andregama789@gmail.com', 'Tutorials Point')
//             ->subject('subject')
//             ->setBody('andre_gama789@hotmail.com', 'text/html');
//             $message->from('andre_gama789@hotmail.com','teste');
//         });

//         return ReturnMessage::messageReturn(false,'E-mail enviado',null,null, null);

//     }
//     public function html_email() {
//         $data = array('name'=>"Virat Gandhi");
//         Mail::send('mail', $data, function($message) {
//             $message->to('abc@gmail.com', 'Tutorials Point')->subject
//             ('Laravel HTML Testing Mail');
//             $message->from('xyz@gmail.com','Virat Gandhi');
//         });
//         echo "HTML Email Sent. Check your inbox.";
//     }

//    public function attachment_email() {
//       $data = array('name'=>"Virat Gandhi");
//       Mail::send('mail', $data, function($message) {
//          $message->to('abc@gmail.com', 'Tutorials Point')->subject
//             ('Laravel Testing Mail with Attachment');
//          $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
//          $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
//          $message->from('xyz@gmail.com','Virat Gandhi');
//       });
//       echo "Email Sent with attachment. Check your inbox.";
//    }

    public function sendEmail()
    {
        $user = new stdClass();
        $user->name = 'Andre';
        $user->email = 'andre_gama789@hotmail.com';

        Mail::send(new EmailServices($user));

        return ReturnMessage::messageReturn(false,'E-mail enviado',null,null, null);
    }
}
