<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookModel extends Mailable
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
            ->subject($this->customer->subject)
            ->view('emails.book-model')
            ->with([
                'name' => $this->customer->name,
                'company' => $this->customer->company,
                'mobile' => $this->customer->mobile,
                'details' => $this->customer->details,
                'email' => $this->customer->email
            ]);
    }
}
