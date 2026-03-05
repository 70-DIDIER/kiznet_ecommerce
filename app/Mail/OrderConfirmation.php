<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $items;

    public function __construct($order, array $items)
    {
        $this->order = $order;
        $this->items = $items;
    }

    public function build()
    {
        return $this->subject('Votre commande est confirmée')
            ->view('emails.order-confirmation');
    }
}
