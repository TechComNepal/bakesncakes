<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use PDF;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mail_details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_details)
    {
        $this->mail_details=$mail_details;
        $this->pdf = PDF::loadView('emails.order_confirm', compact('mail_details'));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order Confirmation') ->attachData($this->pdf->output(), "invoice.pdf")->view('emails.order_confirm');
    }
}
