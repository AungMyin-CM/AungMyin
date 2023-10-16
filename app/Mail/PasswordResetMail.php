<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $recipient;
    public $token;
    public $fromEmail;
    public $fromName;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $mailData)
    {
        $this->recipient = $mailData['recipient'];
        $this->token = $mailData['token'];
        $this->fromEmail = $mailData['fromEmail'];
        $this->fromName = $mailData['fromName'];
        $this->subject = $mailData['subject'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->fromEmail, $this->fromName)
            ->subject($this->subject)
            ->view('emails.forgot-password')
            ->with('email', $this->recipient)
            ->with('token', $this->token);
    }
}
