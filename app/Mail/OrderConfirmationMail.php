<?php

// App\Mail\OrderConfirmationMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $paymentUrl;

    public function __construct($order, $paymentUrl)
    {
        $this->order = $order;
        $this->paymentUrl = $paymentUrl;
    }

    public function build()
    {
        return $this->view('emails.order_confirmation')
            ->with([
                'order' => $this->order,
                'paymentUrl' => $this->paymentUrl,
            ]);
    }
}
