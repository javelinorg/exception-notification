<?php

namespace Javelin\ExceptionNotification;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExceptionMailer extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * The subject of the message.
     *
     * @var string
     */
    public $subject;

    /**
     * The body of the message.
     *
     * @var string
     */
    public $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $body)
    {
        $this->subject = $subject;

        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = (object) config('exception-notification.from');

        return $this->from($from->address, $from->name)
            ->view('exception-notification::exception')
            ->with('content', $this->body);
    }
}
