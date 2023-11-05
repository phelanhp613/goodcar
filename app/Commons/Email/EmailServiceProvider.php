<?php

namespace App\Commons\Email;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobFailed;

class EmailServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind( EmailServiceInterface::class, function ($app) {
                return $app->make(EmailService::class);
            }
        );
    }

    public function boot()
    {
        Queue::failing(function (JobFailed $event)
        {
            $this->log($event->connectionName);
            $this->log($event->exception);
        });
        RateLimiter::for('send-email', function ($job)
        {
            return EmailSendLimit::perSeconds(1, config('queue.connections.database_send_mail.limit'));
        });
    }

    public function log($e)
    {
        Log::channel('email-worker')->error($e);
    }
}
