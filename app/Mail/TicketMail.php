<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $ticketFilePath;

    public function __construct($order, $ticketFilePath)
    {
        $this->order = $order;
        $this->ticketFilePath = $ticketFilePath;
    }

    public function build()
    {
        return $this->view('emails.ticket')
            ->subject('Your Concert Ticket')
            ->attach($this->ticketFilePath, [
                'as' => 'Your_Ticket.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}
