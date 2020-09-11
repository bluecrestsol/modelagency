<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendContactForm extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer)
    {
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from($this->customer->email, $this->customer->name)
            ->view('emails.contact-form')
            ->subject('MPModelsBKK - Contact Form')
            ->with([
                'name' => $this->customer->name,
                'msg' => $this->customer->message,
                'email' => $this->customer->email,
                'subject' => $this->customer->subject
            ]);
    }
}
