<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegisterEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $file;

    public function __construct($user, $file)
    {
        $this->user = $user;
        $this->file = $file;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Register Email',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.register',
        );
    }

    public function build()
    {
        // Build the email with attachment
        $email = $this->view('email.register')
                      ->subject('Register Email');

        // Attach file from MediaLibrary
        if ($this->file) {
            $email->attach($this->file->getPath(), [
                'as' => $this->file->file_name,  
                'mime' => $this->file->mime_type, 
            ]);
        }

        return $email;
    }
}


