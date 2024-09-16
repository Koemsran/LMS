<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class SendingEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $employeeName;
    public $leaveType;
    public $leaveDates;
    public $leaveReason;
    public $leaveId;
    public $subject;
    public $mailFrom;
    public $duration;

    /**
     * Create a new message instance.
     */
    public function __construct($employeeName, $leaveType, $leaveDates, $leaveReason, $leaveId, $subject, $mailFrom, $duration)
    {
        $this->employeeName = $employeeName;
        $this->leaveType = $leaveType;
        $this->leaveDates = $leaveDates;
        $this->leaveReason = $leaveReason;
        $this->leaveId = $leaveId;
        $this->subject = $subject;
        $this->mailFrom = $mailFrom;
        $this->duration = $duration;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->mailFrom, 'Leave Management'),
            replyTo: [
                new Address($this->mailFrom, 'Leave Management'),
            ],
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->view('mail-tampletes.sending-mail') // Adjusted to your template path
            ->subject($this->subject)
            ->with([
                'employeeName' => $this->employeeName,
                'leaveType' => $this->leaveType,
                'leaveDates' => $this->leaveDates,
                'leaveReason' => $this->leaveReason,
                'leaveId' => $this->leaveId,
                'duration' => $this->duration,
            ]);
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
