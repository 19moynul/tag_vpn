<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailResetPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $otp;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $otp)
    {
        $this->subject = $subject;
        $this->otp =  $otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('tag-vpn@no-replay.com', 'TAG VPN')->subject($this->subject)->view('mail.reset-password-mail');
    }
}
