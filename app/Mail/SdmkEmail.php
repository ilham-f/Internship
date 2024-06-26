<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SdmkEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;

    /**
     * Create a new message instance.
     */
    public function __construct($email)
    {
        // dd($email);
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->from($this->email['email'], 'Dinas Kesehatan Provinsi Jawa Timur')
            ->subject('Permohonan Magang Baru')
            ->view('sdmk.email');
    }
    
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Permohonan Magang',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'sdmk.email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
