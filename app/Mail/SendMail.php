<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $SendMail;
    /**
     * Create a new message instance.
     */
    public function __construct($SendMail)
    {
        //
        $this->SendMail = $SendMail;
    }

    public function build()
    {
        //เวลาใช้งานดึงการแสดงผลจาก View เหมือนกับ Controller ทั่วไป
        // $SendMail = $this->SendMail;
        // return $this->subject('แจ้งสถานะการใช้ระบบ IP2M')
        //             ->view('sendmail.sendmail', compact('SendMail') );
                    return $this->subject('แจ้งสถานะการใช้ระบบ IP 2M')
                    ->view('sendmail.sendmail' );
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'sendmail.sendmail',
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
