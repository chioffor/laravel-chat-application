<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\ClickedFavorite;
use App\Events\ChatSent;
use App\Events\UserJoinedGroup;
use App\Events\UserLeftGroup;
use App\Events\ReadChatMessage;
use App\Listeners\SendToGroupMembers;
use App\Listeners\UpdateFavorites;
use App\Listeners\NotifyGroupMembers;
use App\Listeners\NotifyLeftGroupMembers;
use App\Listeners\ResetChatCount;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ClickedFavorite::class => [
            UpdateFavorites::class,
        ],
        ChatSent::class => [
            SendToGroupMembers::class,
        ],
        UserJoinedGroup::class => [
            NotifyGroupMembers::class,
        ],
        UserLeftGroup::class => [
            NotifyLeftGroupMembers::class,
        ],
        ReadChatMessage::class => [
            ResetChatCount::class,
        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
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
