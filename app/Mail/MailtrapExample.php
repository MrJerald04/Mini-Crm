<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailtrapExample extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fromEmail, $cmpnyName)
    {
        $this->frmMail = $fromEmail;
        $this->cn = $cmpnyName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = 'Admin';
        $companyName = $this->cn;
        return $this->from($this->frmMail, $name)
            ->subject('Mini-CRM Notification')
            ->markdown('emails.mail')
            ->with([
                'name' => 'Sir',
                'company' => $companyName
                // 'link' => 'https://mailtrap.io/inboxes'
            ]);
    }
}
