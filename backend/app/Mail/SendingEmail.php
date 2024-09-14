<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use PhpParser\Node\Expr\New_;
use Illuminate\Mail\Mailables\Address;
class SendingEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $mailMessage;
    public $subject;
    /**
     * Create a new message instance.
     */
    public function __construct($message, $subject)
    {
        $this->mailMessage = $message;
        $this->subject = $subject;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        
        return new Envelope(
            from: new Address('koemsran.phon@student.passerellesnumeriques.org', 'LMS'),
            replyTo:[
                new Address('koemsran.phon@student.passerellesnumeriques.org', 'LMS'),
            ],
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail-tampletes.sending-mail',
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
