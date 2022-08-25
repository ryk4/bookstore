<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookReportMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public array $details;
    public $subject = "Book report received";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Book report email')->from($this->details['user_email'])->view('email.report');
    }
}
