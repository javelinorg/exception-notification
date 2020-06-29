<?php

namespace Javelin\ExceptionNotification\Commands;

use Illuminate\Console\Command;
use Javelin\ExceptionNotification\Exceptions\ShouldReportableException;

class ExceptionNotificationTestCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'exception:throw';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if Exception is working.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        /** @psalm-suppress UndefinedClass **/
        app('exceptionNotification')->reportException(new ShouldReportableException());

        $this->info('Exception Notification is working');
    }
}
