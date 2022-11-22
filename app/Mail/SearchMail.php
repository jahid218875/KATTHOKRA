<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SearchMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $level;
    public $my_message;
    public $image;

    public function __construct($level, $my_message, $image)
    {
        $this->level = $level;
        $this->my_message = $my_message;
        $this->image = $image;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('community@katthokra.com', 'Katthokra')
            ->subject('Search Email')
            ->view('visitor.search-email')->with(['level' => $this->level, 'my_message' => $this->my_message, 'image' => $this->image]);
    }
}
