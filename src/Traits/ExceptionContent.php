<?php
namespace Javelin\ExceptionNotification\Traits;

use Symfony\Component\ErrorHandler\ErrorRenderer\HtmlErrorRenderer;
use Symfony\Component\ErrorHandler\Exception\FlattenException;

trait ExceptionContent
{

    /**
    * Gets the message associated with the given exception.
    *
    * @param  FlattenException $exception
    *
    * @return mixed
    */
    protected function getSubject(FlattenException $exception)
    {
        $message = $this->escape($exception->getMessage());

        return view('exception-notification::subject', compact('message', 'exception'))->render();
    }

    /**
     * Gets the content associated with the given exception.
     *
     * @param  FlattenException $exception
     *
     * @return mixed
     */
    protected function getBody(FlattenException $exception)
    {
        $renderer = new HtmlErrorRenderer(true);

        $stylesheet = $renderer->getStylesheet();

        $content = $renderer->getBody($exception);

        $message = $this->escape($exception->getMessage());

        return  view('exception-notification::body', compact('content', 'stylesheet', 'message', 'exception'))->render();
    }

    /**
    * Convert special characters to HTML entities
    *
    * @param string $string
    *
    * @return string
    */
    protected function escape(string $string): string
    {
        return htmlspecialchars($string, ENT_COMPAT | ENT_SUBSTITUTE, 'UTF-8');
    }
}
