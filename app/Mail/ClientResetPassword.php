<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientResetPassword extends Mailable
{
    use Queueable, SerializesModels;
    private $code;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.client', ['code' => $this->code]);
    }
}
