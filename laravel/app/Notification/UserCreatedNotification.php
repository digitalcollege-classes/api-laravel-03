<?php

declare(strict_types=1);

namespace App\Notification;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserCreatedNotification extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public string $username
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nova conta criada',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: '_notification.mail.contaCriada'
        );
    }

    /** @return array<int, \Illuminate\Mail\Mailables\Attachment> */
    public function attachments(): array
    {
        return [];
    }
}
