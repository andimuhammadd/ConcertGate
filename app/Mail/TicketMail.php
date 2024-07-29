<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $filePath;

    public function __construct(Order $order, $filePath)
    {
        $this->order = $order;
        $this->filePath = $filePath;
    }

    public function build()
    {
        return $this->view('emails.ticket')
            ->subject('Your Concert Ticket')
            ->attach($this->filePath);
    }
}
