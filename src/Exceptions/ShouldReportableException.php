<?php

namespace Javelin\ExceptionNotification\Exceptions;

use Exception;

class ShouldReportableException extends Exception
{
    /**
     * @var string
     */
    protected $message = "The reportable exception.";
}
