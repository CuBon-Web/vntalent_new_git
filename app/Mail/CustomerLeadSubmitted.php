<?php

namespace App\Mail;

use App\models\CustomerLead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerLeadSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\models\CustomerLead
     */
    public $lead;

    /**
     * Create a new message instance.
     *
     * @param  \App\models\CustomerLead  $lead
     * @return void
     */
    public function __construct(CustomerLead $lead)
    {
        $this->lead = $lead;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New customer registration')
            ->view('emails.customer-lead-submitted');
    }
}
