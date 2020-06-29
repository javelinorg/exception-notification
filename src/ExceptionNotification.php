<?php

namespace Javelin\ExceptionNotification;

use Javelin\ExceptionNotification\Traits\ReportableException;
use Symfony\Component\ErrorHandler\Exception\FlattenException;

class ExceptionNotification
{
    use ReportableException;

    protected $exception;

    protected $notify;

    public function __construct(SendNotification $notify)
    {
        $this->notify = $notify;
    }

    /**
     * Report an excepiton.
     *
     * @param \Exception $exception
     *
     * @return void
     */
    public function reportException($exception)
    {
        $this->exception = $exception;

        if (! $this->isEnabled()) {
            return;
        }

        if (! $this->isShouldReport($this->exception)) {
            return;
        }

        if ($this->isExceptionFromBot()) {
            return;
        }

        $this->report();
    }

    /**
     * send an exception.
     *
     * @return void
     */
    private function report()
    {
        $headers = ['Content-Type' => 'text/html; charset=UTF-8'];

        $flattenException = FlattenException::createFromThrowable($this->exception, null, $headers);

        $this->notify->setException($flattenException)
            ->setSubject()
            ->setBody()
            ->setMailableContent()
            ->send();
    }
}
