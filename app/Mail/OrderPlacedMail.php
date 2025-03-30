<?php

// namespace App\Mail;

// use App\Models\Order;
// use Illuminate\Bus\Queueable;
// use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;

// class OrderPlacedMail extends Mailable
// {
//     use Queueable, SerializesModels;

//     public $order;

//     /**
//      * Create a new message instance.
//      */
//     public function __construct(Order $order)
//     {
//         $this->order = $order;
//     }

//     /**
//      * Build the message.
//      */
//     public function build()
//     {
//         return $this->subject('Your Order Has Been Placed')
//                     ->view('emails.order_placed');
//     }
// }

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlacedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('Your Order Confirmation')
                    ->view('emails.order_placed')
                    ->with([
                        'order' => $this->order
                    ]);
    }
}
