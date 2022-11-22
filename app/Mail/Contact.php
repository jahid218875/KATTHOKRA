<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name;
    public $email;
    public $my_message;

    public function __construct($name, $email, $my_message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->my_message = $my_message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('community@katthokra.com', 'Katthokra')
            ->subject('Contact Us Email')
            ->view('visitor.contact-email')->with(['name' => $this->name, 'email' => $this->email, 'my_message' => $this->my_message]);
    }
}
