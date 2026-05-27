<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminPasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    public string $resetUrl;

    public function __construct(string $resetUrl)
    {
        $this->resetUrl = $resetUrl;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                config('mail.from.address', 'onboarding@resend.dev'),
                config('mail.from.name', 'Mystic Mirror Salon')
            ),
            subject: '🔑 Reset Your Admin Password — Mystic Mirror',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-password-reset',
        );
    }
}
