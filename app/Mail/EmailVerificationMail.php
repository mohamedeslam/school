<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\AuthController;
use App\Models\User;


class EmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;
    protected  $user;

    /**
     * Create a new message instance.
     *
     * @return void
     * @param  \App\Models\user  $user
     */
    public function __construct($user)
    {
        $this->user = $user;
        // dd($this->$user);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Email Verification Mail',
            
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        // dd($this->user);

        return new Content(
            markdown: 'emails.auth.email_verification_mail',
            with:['user' => $this->user]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
