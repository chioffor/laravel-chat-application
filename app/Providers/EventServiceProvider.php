<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\ChatSent;
use App\Events\NewUserJoined;
use App\Listeners\SendToGroupMembers;
use App\Listeners\UpdateNewUserJoined;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [        
        ChatSent::class => [
            SendToGroupMembers::class,
        ],        
        NewUserJoined::class => [
            UpdateNewUserJoined::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
