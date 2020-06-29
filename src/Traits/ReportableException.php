<?php

namespace Javelin\ExceptionNotification\Traits;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Jaybizzle\CrawlerDetect\CrawlerDetect;

trait ReportableException
{
    /**
     * Checks if Exception Notification is enabled.
     *
     * @return bool
     */
    protected function isEnabled(): bool
    {
        return config('exception-notification.enabled');
    }

    /**
     *  Check if the incoming entry is a reportable exception.
     *
     * @return bool
     */
    protected function isShouldReport($exception): bool
    {
        if (method_exists(ExceptionHandler::class, 'shouldReport')) {
            $handler = app(ExceptionHandler::class);

            return $handler->shouldReport($exception);
        }

        return true;
    }

    /**
     * Determine if the exception is from the bot.
     *
     * @return bool
     */
    protected function isExceptionFromBot(): bool
    {
        $ignored_bots = (array) config('exception-notification.ignored_bots');

        $agent = array_key_exists('HTTP_USER_AGENT', $_SERVER)
                    ? strtolower($_SERVER['HTTP_USER_AGENT'])
                    : null;

        if (is_null($agent)) {
            return false;
        }

        if (in_array('*', $ignored_bots)) {
            $detect = new CrawlerDetect();

            return $detect->isCrawler($agent);
        }

        foreach ($ignored_bots as $bot) {
            if ((strpos($agent, $bot) !== false)) {
                return true;
            }
        }

        return false;
    }
}
