<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailTemplate extends Mailable
{
    use Queueable, SerializesModels;

    protected $emailMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailMessage)
    {
        $this->emailMessage = $emailMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.emailtemplate')
                    ->subject('Scheduled Email')
                    ->from($this->emailMessage->from_email, $this->emailMessage->from_name)
                    ->to($this->emailMessage->to_email, $this->emailMessage->to_name)
                    ->with('emailMessage', $this->emailMessage);
    }
}
