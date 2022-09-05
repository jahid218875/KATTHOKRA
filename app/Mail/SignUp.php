<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SignUp extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $email;
    public $otp;
    public $subject;

    public function __construct($email, $otp, $subject)
    {
        $this->email = $email;
        $this->otp = $otp;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@katthokra.com', 'no-reply')
            ->subject($this->subject)
            ->view('visitor.verify-email')->with(['email' => $this->email, 'otp' => $this->otp]);
    }
}
