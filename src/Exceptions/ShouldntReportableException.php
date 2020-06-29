<?php

namespace Javelin\ExceptionNotification\Exceptions;

use Illuminate\Auth\AuthenticationException;

class ShouldntReportableException extends AuthenticationException
{
    /**
     * @var string
     */
    protected $message = 'The not reportable exception.';
}
