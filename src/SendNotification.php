<?php
namespace Javelin\ExceptionNotification;

use Illuminate\Support\Facades\Mail;
use Javelin\ExceptionNotification\Traits\ExceptionContent;
use Symfony\Component\ErrorHandler\Exception\FlattenException;

class SendNotification
{
    use ExceptionContent;

    protected $exception;

    protected $subject;

    protected $body;

    protected $content;
    
    protected $toAddresses;

    protected $queueOptions;

    /**
     * Create and send a exception mail.
     */
    public function __construct()
    {
        $config = (object) config('exception-notification');

        $this->toAddresses = $config->toAddresses;

        $this->queueOptions = (object) $config->queueOptions;
    }

    /**
     * Set exception.
     *
     * @param FlattenException $exception
     * 
     * @return object
     */
    public function setException(FlattenException $exception) :object
    {
        $this->exception = $exception;

        return $this;
    }

    /**
     * Set the subject content.
     *
     * @return object
     */
    public function setSubject() :object
    {
        $this->subject = $this->getSubject($this->exception);

        return $this;
    }

    /**
     * Set the body content.
     *
     * @return object
     */
    public function setBody() : object
    {
        $this->body = $this->getBody($this->exception);

        return $this;
    }

    /**
     * Set the mailable notificaton content.
     *
     * @return object
     */
    public function setMailableContent() : object
    {
        $this->content = (new ExceptionMailer($this->subject, $this->body));

        return $this;
    }

    /**
     * Send the notification.
     *
     * @return void
     */
    public function send() : void
    {
        $mail = Mail::to($this->toAddresses);
        
        if (! $this->queueOptions->enabled) {
            $mail->send($this->content);

            return;
        }
        
        $message = $this->content->onConnection($this->queueOptions->connection);

        if ($this->queueOptions->queue !== 'default') {
            $message->onQueue($this->queueOptions->queue);
        }

        $mail->queue($message);
    }
}
