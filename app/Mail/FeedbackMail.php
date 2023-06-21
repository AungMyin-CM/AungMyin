<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $recipient;
    public $fromEmail;
    public $fromName;
    public $subject;
    public $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $mailData)
    {
        $this->name = $mailData['name'];
        $this->recipient = $mailData['recipient'];
        $this->fromEmail = $mailData['fromEmail'];
        $this->fromName = $mailData['fromName'];
        $this->subject = $mailData['subject'];
        $this->body = $mailData['body'];
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
            ->view('feedback-email')
            ->with('name', $this->name)
            ->with('body', $this->body);
    }
}
