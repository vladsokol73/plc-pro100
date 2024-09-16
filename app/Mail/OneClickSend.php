<?php

namespace App\Mail;

use App\Models\Oneclick;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OneClickSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        protected Oneclick $oneclick,
    ){}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'One Click Send',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.oneclick-email',
            with: [
                'oneClickNum' => $this->oneclick->id,
                'oneClickName' => $this->oneclick->name,
                'oneClickPhone' => $this->oneclick->phone,
                'oneClickMessage' => $this->oneclick->message,
                'oneClickProduct' => $this->oneclick->product_name,
                'oneClickDate' => $this->oneclick->created_at,
            ],
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
