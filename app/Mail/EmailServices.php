<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PhpParser\Node\Expr\FuncCall;
use stdClass;

class EmailServices extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $this->subject('Teste');
        // $this->to($this->user->email, $this->user->name);

        // return $this->view('mail.email-send-code-recorver-password');
    }
    /**
     * emailNewAccount
     *
     * @param  mixed $array
     * @return void
     */
    public function emailNewAccount(array $array)
    {
        $this->subject($array['subject']);
        $this->to($array['email'], $array['name']);

        return $this->markdown('mail.email-send-confirmation')->with(['code' => $array['code']]);
    }
    public function sendEmailRecovery(array $array)
    {
        $this->subject($array['subject']);
        $this->to($array['email'], $array['name']);

        return $this->markdown('mail.email-send-code-recorver-password')->with(['code' => $array['code']]);
    }
}
